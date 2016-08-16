<?php

namespace Roda\Models\Repository;

use Roda\Models\Adv as AdvModel;
use Roda\Services\Img;

class Adv extends AbstractRepository
{
    /**
     * @param array $advArray
     * @return AdvModel
     * @throws \Exception
     */
    public static function addOne(array $advArray)
    {
        $advData['user_id'] = $advArray["user_id"];
        $advData['title'] = $advArray["title"];
        $advData['content'] = $advArray["content"];
        $advData['price'] = $advArray["price"];
        $advData['img_id'] = $advArray["img_id"];
        $conn = self::getConnection();
        $conn->insert('advs', $advData);
        $id=$conn->lastInsertId();
        $adv = self::getOneById($id);
        return $adv;
    }

    /**
     * @param array $advArray
     * @return AdvModel
     * @throws \Exception
     */
    public static function editOne(array $advArray)
    {
        $advData['user_id'] = htmlspecialchars($advArray["user_id"]);
        $advData['title'] = htmlspecialchars($advArray["title"]);
        $advData['content'] = htmlspecialchars($advArray["content"]);
        $advData['price'] = htmlspecialchars($advArray["price"]);
        $id = htmlspecialchars($advArray["advId"]);
        $conn = self::getConnection();
        $conn->update('advs', $advData,['id'=>$id]);
        // $id=$conn->lastInsertId();
        $user = self::getOneById($id);
        return $user;
    }
  
    /**
     * @param int $id
     * @return AdvModel
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     */
   
   public static function getOneById(int $id = NULL)
   {
       if($id==NULL){
           $adv = new AdvModel();
       }
       else{
       $conn = self::getConnection();
       $stm = $conn->query("SELECT * FROM advs WHERE id = " . $id . " LIMIT 1;");
       $advs = $stm->fetchAll();

       if (count($advs) == 0) {
           throw new \Exception("A adv with id = ".$id." is not found");
       }

       $adv = new AdvModel($advs[0]);
       $ImgName = Img::getImg($adv->getImgId())['name'];
          
       $adv->setImgName($ImgName);
       }
       return $adv;

   }

   /**
    * @return array
    * @throws \Doctrine\DBAL\DBALException
    */
    public static function getAll()
    {
        $conn = self::getConnection();
        $stm = $conn->query("SELECT * FROM advs;");
        $advs = $stm->fetchAll();

        foreach ($advs as $key => $adv) {
            $advs[$key] = new AdvModel($adv);
        }
        return $advs;
    }

    /**
     * @param array $where
     * @param int|NULL $limit
     * @param int|NULL $offset
     * @param string $sort
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
     
    public static function get(array $where = [], int $limit = NULL, int $offset = NULL)
    {
        $conn = self::getConnection();
        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('*')->from('$advs')->where(true);

        foreach ($where as $key => $value) {
            $queryBuilder->andWhere($key . ' = ' . $value);
        }

        if (!$limit == NULL) {
            $queryBuilder->setMaxResults($limit);
        }

        if (!$offset == NULL) {
            $queryBuilder->setFirstResult($offset);
        }


        $sql = $queryBuilder->getSQL();
        $statement = $conn->query($sql);
        $advs = $statement->fetchAll();

        foreach ($advs as $key => $adv) {
            $advs[$key] = new AdvModel($adv);
        }
        return $advs;
    }

}
