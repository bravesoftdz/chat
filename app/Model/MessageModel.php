<?php

namespace Dykyi\Model;

use Dykyi\ModelAbstract;

/**
 * Class Database
 */
class MessageModel extends ModelAbstract
{
    const TABLE_NAME = 'messages';

    /**
     * @param $recipient_id
     * @param $message
     * @return mixed
     */
    public function sendMessage($recipient_id, $message)
    {
        $stmt = $this->db->prepare('INSERT INTO messages (sender_id, recipient_id, message) VALUES (:sender_id, :recipient_id, :message)');
        $stmt->bindParam(":sender_id", $this->session->get('id'));
        $stmt->bindParam(":recipient_id", $recipient_id);
        $stmt->bindParam(":message", $message);
        return $stmt->execute();
    }

    /**
     * Update read attribute
     *
     * @param $message_id
     * @return mixed
     */
    private function _setReadMessage($message_id)
    {
        $stmt = $this->db->prepare('UPDATE messages SET is_read = 1 WHERE id = :message_id');
        $stmt->bindParam(":message_id", $message_id);
        return $stmt->execute();
    }

    /**
     * Read message
     *
     * @return bool
     */
    public function readMessage()
    {
        $stmt = $this->db->prepare('SELECT id, message, created_at FROM messages WHERE recipient_id = :recipient_id AND messages.is_read = 0 order by created_at ASC LIMIT 1');
        $stmt->bindParam(":recipient_id", $this->session->get('id'));
        $stmt->execute();
        $message = $stmt->fetch();
        if ($message) {
            if ($this->_setReadMessage($message['id'])) {
                return $message['message'];
            }
        }
        return false;
    }

    /**
     * Get message history
     *
     * @param $user_id
     * @return bool
     */
    public function getMessageHistory($user_id)
    {
        $stmt = $this->db->prepare('SELECT * FROM messages WHERE ((recipient_id = :user_1 AND sender_id = :user_2) OR (recipient_id = :user_2 AND sender_id = :user_1)) ORDER BY created_at ASC');
        $stmt->bindParam(":user_1", $user_id);
        $stmt->bindParam(":user_2", $this->session->get('id'));
        $stmt->execute();
        $messages = $stmt->fetchAll();
        if ($messages) {
            return $messages;
        }
        return false;
    }


}