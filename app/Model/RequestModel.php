<?php

namespace Dykyi\Model;

use Dykyi\ModelAbstract;

/**
 * Class Database
 */
class RequestModel extends ModelAbstract
{
    /**
     * Get All User friends
     *
     * @return mixed
     */
    public function getUserRequest()
    {
        $stmt = $this->db->prepare('SELECT users.*, request.sender_id '.
            'FROM request LEFT JOIN users ON users.id = sender_id '.
            'WHERE recipient_id = :user_id');
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
        $sessionId = $this->session->get('id');
        $stmt      = $this->db->prepare('SELECT count(*) FROM request WHERE recipient_id = :user_id AND accepted = 0');
        $stmt->bindParam(":user_id", $sessionId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * Send Request to user
     *
     * @param $recipientId
     * @return mixed
     */
    public function sendRequest($recipientId)
    {
        $stmt = $this->db->prepare('INSERT INTO request (sender_id, recipient_id, accepted) '.
            'VALUES (:sender_id, :recipient_id, 0)');
        $stmt->bindParam(":sender_id", $this->session->get('id'));
        $stmt->bindParam(":recipient_id", $recipientId);
        return $stmt->execute();
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function accept($userId)
    {
        $stmt = $this->db->prepare('INSERT INTO friends (user_id, friend_id) '.
            'VALUES (:user_id, :friend_id), (:friend_id, :user_id)');
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":friend_id", $this->session->get('id'));
        $result = $stmt->execute();
        if ($result) {
            $stmt = $this->db->prepare('DELETE FROM request '.
                'WHERE recipient_id = :recipient_id AND sender_id = :sender_id');
            $stmt->bindParam(":sender_id", $userId);
            $stmt->bindParam(":recipient_id", $this->session->get('id'));
            $result = $stmt->execute();
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public function viewed()
    {
        $stmt = $this->db->prepare('UPDATE request SET accepted = 1 WHERE recipient_id = :recipient_id');
        $stmt->bindParam(":recipient_id", $this->session->get('id'));
        return $stmt->execute();
    }

    /**
     * @param $senderId
     * @return mixed
     */
    public function decline($senderId)
    {
        $stmt = $this->db->prepare('DELETE FROM request WHERE recipient_id = :recipient_id AND sender_id = :sender_id');
        $stmt->bindParam(":sender_id", $senderId);
        $stmt->bindParam(":recipient_id", $this->session->get('id'));
        return $stmt->execute();
    }


}