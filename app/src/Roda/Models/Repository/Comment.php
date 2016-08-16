<?php

namespace Roda\Models\Repository;

use Roda\Models\Comment as CommentModel;

class Comment extends AbstractRepository
{
    /**
     * @param int|NULL $id
     * @return CommentModel
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     */

    public static function getOneById(int $id = NULL)
    {
        if($id==NULL){
            $comment = new CommentModel();
        }
        else {
            $conn = self::getConnection();
            $stm = $conn->query("SELECT * FROM comments WHERE id = " . $id . " LIMIT 1;");
            $comments = $stm->fetchAll();

            if (count($comments) == 0) {
                throw new \Exception("A comment with id = " . $id . " is not found");
            }
            $comment = new CommentModel($comments[0]);
        }
        return $comment;
    }

    /**
     * @param array $commentArray
     * @return CommentModel
     * @throws \Exception
     */
    public static function addOne(array $commentArray)
    {
        $commentData['user_id'] = htmlspecialchars($commentArray["user_id"]);
        $commentData['adv_id'] = htmlspecialchars($commentArray["adv_id"]);
        $commentData['text'] = htmlspecialchars($commentArray["text"]);

        $conn = self::getConnection();
        $conn->insert('comments', $commentData);
        $id=$conn->lastInsertId();
        $comment = self::getOneById($id);
        return $comment;
    }

    /**
     * @param array $commentArray
     * @return CommentModel
     * @throws \Exception
     */

    public static function editOne(array $commentArray)
    {
        $commentData['user_id'] = htmlspecialchars($commentArray["user_id"]);
        $commentData['adv_id'] = htmlspecialchars($commentArray["adv_id"]);
        $commentData['text'] = htmlspecialchars($commentArray["text"]);
        $id = htmlspecialchars($commentArray["commentId"]);
        $conn = self::getConnection();
        $conn->update('comments', $commentData,['id'=>$id]);

        $comment = self::getOneById($id);
        return $comment;
    }



    /**
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function getAll()
    {
        $conn = self::getConnection();
        $stm = $conn->query("SELECT * FROM comments;");
        $comments = $stm->fetchAll();

        foreach ($comments as $key => $comment) {
            $comments[$key] = new CommentModel($comment);
        }
        return $comments;
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
        $queryBuilder->select('*')->from('comments')->where(true);

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
        $comments = $statement->fetchAll();

        foreach ($comments as $key => $comment) {
            $comments[$key] = new CommentModel($comment);
        }
        return $comments;
    }

}
