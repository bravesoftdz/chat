<?php

namespace Dykyi\Model;

use Dykyi\Model;

/**
 * Class Database
 */
final class RequestModel extends Model
{
    const TABLE_NAME = 'request';

    /**
     * Get All User friends
     *
     * @return mixed
     */
    public function getUserRequest()
    {
        $stmt = $this->db->prepare('SELECT users.*, request.sender_id FROM ' . self::TABLE_NAME . ' LEFT JOIN users ON users.id = recipient_id WHERE recipient_id = :user_id');
        $stmt->bindParam(":user_id", $this->session->get('id'));
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Request counter
     *
     * @return mixed
     */
    public function getUserRequestCount()
    {
        $stmt = $this->db->prepare('SELECT count(*) FROM ' . self::TABLE_NAME . ' WHERE recipient_id = :user_id');
        $stmt->bindParam(":user_id", $this->session->get('id'));
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * Send Request to user
     *
     * @param $recipient_id
     * @return mixed
     */
    public function sendRequest($recipient_id)
    {
        $stmt        = $this->db->prepare('INSERT INTO request (sender_id, recipient_id, accepted) VALUES (:sender_id, :recipient_id, 0)');
        $stmt->bindParam(":sender_id", $this->session->get('id'));
        $stmt->bindParam(":recipient_id", $recipient_id);
        return $stmt->execute();
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function accepted($user_id)
    {
        $stmt = $this->db->prepare('');
        $stmt->bindParam(":sender_id", $this->session->get('id'));
        return $stmt->execute();
    }

    /**
     * @param $sender_id
     * @return mixed
     */
    public function decline($sender_id)
    {
        $stmt = $this->db->prepare('DELETE FROM request WHERE recipient_id = :recipient_id AND sender_id = :sender_id');
        $stmt->bindParam(":sender_id", $sender_id);
        $stmt->bindParam(":recipient_id", $this->session->get('id'));
        return $stmt->execute();
    }


}