<?php

namespace Roda\Models\Repository;

use Roda\Models\User as UserModel;

class User extends AbstractRepository
{
    /**
     * @param int|NULL $id
     * @return UserModel
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     */
    public static function getOneById($id = NULL)
    {
        if($id==NULL){
            $user = new UserModel();   
        }
        else{
        $conn = self::getConnection();
        $stm = $conn->query("SELECT * FROM users WHERE id = " . $id . " LIMIT 1;");
        $users = $stm->fetchAll();

        if (count($users) == 0) {
            throw new \Exception("A user with id = ".$id." is not found");
        }

        $userArray = $users[0];
        
        $user = new UserModel($userArray);
        }
        return $user;
    }

    /**
     * @param array $userArray
     * @return UserModel
     * @throws \Exception
     */
    public static function addOne(array $userArray)
    {
        $userData['name'] = htmlspecialchars($userArray["name"]);
        $userData['middlename'] = htmlspecialchars($userArray["middlename"]);
        $userData['surname'] = htmlspecialchars($userArray["surname"]);
        $userData['nic'] = htmlspecialchars($userArray["nic"]);
        $userData['email'] = htmlspecialchars($userArray["email"]);
        $userData['passwd'] = md5(htmlspecialchars($userArray["passwd"]));
        
        $conn = self::getConnection();
        $conn->insert('users', $userData);
        $id=$conn->lastInsertId();
        $user = self::getOneById($id);
        return $user;
    }

    /**
     * @param array $userArray
     * @return UserModel
     * @throws \Exception
     */
    public static function editOne(array $userArray)
    {
        $userData['name'] = htmlspecialchars($userArray["name"]);
        $userData['middlename'] = htmlspecialchars($userArray["middlename"]);
        $userData['surname'] = htmlspecialchars($userArray["surname"]);
        $userData['nic'] = htmlspecialchars($userArray["nic"]);
        $userData['email'] = htmlspecialchars($userArray["email"]);
        $userData['passwd'] = md5((htmlspecialchars($userArray["passwd"]).(htmlspecialchars($userArray["surname"]))));

        $id = htmlspecialchars($userArray["userId"]);
        $conn = self::getConnection();
        $conn->update('users', $userData,['id'=>$id]);
       // $id=$conn->lastInsertId();
        $user = self::getOneById($id);
        return $user;
    }
    /**
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function getAll()
    {
        $conn = self::getConnection();
        $stm = $conn->query("SELECT * FROM users ;");
        $users = $stm->fetchAll();

        foreach ($users as $key => $userArray) {
            $users[$key] = new UserModel($userArray);
        }
        return $users;
    }

    /**
     * @param array $where
     * @param int|NULL $limit
     * @param int|NULL $offset
     * @param string $sort
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function get(array $where = [], int $limit = NULL, int $offset = 0)
    {
        $conn = self::getConnection();
        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('*')->from('users')->where(true);

        foreach ($where as $key => $value) {
            $queryBuilder->andWhere($key . ' = ' . $value);
        }

        if (!$limit == NULL) {
            $queryBuilder->setMaxResults($limit);
        }

        $queryBuilder->setFirstResult($offset);

       

        $sql = $queryBuilder->getSQL();
        $statement = $conn->query($sql);
        $users = $statement->fetchAll();

        foreach ($users as $key => $userArray) {
            $users[$key] = new UserModel($userArray);
        }
        return $users;
    }

}
