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
        $stmt = $this->db->prepare('SELECT count(*) FROM ' . self::TABLE_NAME . ' WHERE recipient_id = :user_id');
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

}