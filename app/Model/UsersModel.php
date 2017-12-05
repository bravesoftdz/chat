<?php

namespace Dykyi\Model;

use Dykyi\Common\UserEntity;
use Dykyi\ModelAbstract;
use PDOException;

/**
 * Class Database
 */
class UsersModel extends ModelAbstract
{
    /**
     * @param $password
     * @return bool|string
     */
    private function passwordGenerate($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Add new user
     *
     * @param array $data
     * @return bool
     */
    public function save(array $data)
    {
        unset($data['g-recaptcha-response'],
            $data['confirm-password'],
            $data['register_form'],
            $data['register-submit']
        );
        $data['password'] = $this->passwordGenerate($data['password']);
        try {
            $sql  = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
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
     * @param string $email
     * @return bool|UserEntity
     */
    public function findByEmail($email)
    {
        try {
            $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user) {
                return new UserEntity($user);
            }
        } catch (PDOException $e) {
            var_dump($stmt->errorInfo());
        }

        return false;
    }

    public function updateActivity()
    {
        $sessionId = $this->session->get('id');
        $stmt      = $this->db->prepare('UPDATE users SET last_active = NOW() WHERE id = :id');
        $stmt->bindParam(":id", $sessionId);

        return $stmt->execute();
    }

    /**
     * Get All Users List
     *
     * @throws PDOException
     *
     * @return mixed
     */
    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM users');
        if ($stmt === false) {
            throw new PDOException('DB connection problem');
        }

        return $stmt->fetchAll();
    }

    /**
     * Get Users list from user id
     * @throws PDOException
     * @return mixed
     */
    public function getAllWithoutMe()
    {
        $sessionId = $this->session->get('id');
        $stmt      = $this->db->prepare(
            'SELECT users.*, request.accepted FROM users' .
            ' LEFT JOIN request ON recipient_id = users.id AND request.sender_id = :id' .
            ' WHERE users.id != :id AND users.id NOT IN ' .
            '(select friends.friend_id from friends WHERE friends.user_id = :id)');
        $stmt->bindParam(":id", $sessionId);
        $stmt->execute();

        if ($stmt === false) {
            throw new PDOException('DB connection problem');
        }

        return $stmt->fetchAll();
    }

    /**
     * @param string $email
     * @return bool
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
    public function getUserInfo()
    {
        $sessionId = $this->session->get('id');
        $stmt      = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(":id", $sessionId);
        $stmt->execute();

        return $stmt->fetch();
    }

}