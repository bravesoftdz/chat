<?php

namespace Dykyi\Model;

use Dykyi\Model;
use PDOException;

/**
 * Class Database
 */
final class FriendsModel extends Model
{
    const TABLE_NAME = 'friends';

    /**
     * Add new user
     *
     * @param $friend_id
     * @return bool
     */
    public function add($friend_id)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO " . self::TABLE_NAME . " (user_id, friend_id) VALUES (:user_id, :friend_id)");
            $stmt->bindParam(":user_id", $this->session->get('id'));
            $stmt->bindParam(":friend_id", $friend_id);
            return $stmt->execute();
        } catch (PDOException $e) {
            var_dump($stmt->errorInfo());
        }

        return true;
    }

    /**
     * Get All User friends
     *
     * @return mixed
     */
    public function getUserFriends()
    {
        $stmt = $this->db->prepare("SELECT users.* FROM users WHERE users.id IN (select friends.friend_id from friends WHERE friends.user_id = :user_id )");
        $stmt->bindParam(":user_id", $this->session->get('id'));
        $stmt->execute();
        return $stmt->fetchAll();
    }

}