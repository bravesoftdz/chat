<?php

namespace Dykyi\Model;

use Dykyi\Common\User;
use Dykyi\Model;
use PDOException;

/**
 * Class Database
 */
class UsersModel extends Model
{
    const TABLE_NAME = 'users';

    /**
     * Add new user
     *
     * @param $data
     * @return bool
     */
    public function save($data)
    {
        unset($data['g-recaptcha-response'],
            $data['confirm-password'],
            $data['register_form'],
            $data['register-submit']
        );
        $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
        if ($password_hash) {
            $data['password'] = $password_hash;
        }

        try {
            $sql  = "INSERT INTO " . self::TABLE_NAME . " (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":name", $data['username']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":password", $data['password']);
            $stmt->execute();
        } catch (PDOException $e) {
            var_dump($stmt->errorInfo());
        }

        return true;
    }

    /**
     * find user by email
     *
     * @param $email
     * @return bool|User
     */
    public function findByEmail($email)
    {
        try {
            $stmt = $this->db->prepare('SELECT * FROM ' . self::TABLE_NAME . ' WHERE email = :email');
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user) {
                return new User($user);
            }
        } catch (PDOException $e) {
            var_dump($stmt->errorInfo());
            return false;
        }
        return false;
    }

    public function updateActivity()
    {
        $stmt = $this->db->prepare('UPDATE users SET last_active = NOW() WHERE id = :id');
        $stmt->bindParam(":id", $this->session->get('id'));
        return $stmt->execute();
    }

    /**
     * Get All Users List
     *
     * @return mixed
     */
    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM ' . self::TABLE_NAME);
        return $stmt->fetchAll();
    }

    /**
     * Get Users list from user id
     *
     * @return mixed
     */
    public function getAllWithoutMe()
    {
        $stmt = $this->db->prepare(
            'SELECT users.*, request.accepted FROM ' . self::TABLE_NAME .
            ' LEFT JOIN request ON recipient_id = users.id AND request.sender_id = :id' .
            ' WHERE users.id != :id AND users.id NOT IN (select friends.friend_id from friends WHERE friends.user_id = :id)');
        $stmt->bindParam(":id", $this->session->get('id'));
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $email
     */
    public function logoutByEmail($email)
    {
        $stmt = $this->db->prepare('UPDATE users SET online_state = 0 WHERE email = :email');
        $stmt->bindParam(":email", $email);
        return $stmt->execute();
    }

    /**
     * Change User Status
     *
     * @param $status
     * @return mixed
     */
    public function changeUserStatus($status)
    {
        $stmt = $this->db->prepare('UPDATE users SET status_id = :status WHERE id = :id');
        $stmt->bindParam(":id", $this->session->get('id'));
        $stmt->bindParam(":status", $status);
        return $stmt->execute();
    }

    /**
     * @return mixed
     */
    public function getUserInfo(){
        $stmt = $this->db->prepare('SELECT * FROM ' . self::TABLE_NAME . ' WHERE id = :id');
        $stmt->bindParam(":id", $this->session->get('id'));
        $stmt->execute();
        return $stmt->fetch();
    }

}