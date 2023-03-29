<?php
// Message Class

namespace App;
class Message
{
    protected User $sender;
    protected User $receiver;
    protected string $messageText;
    protected int $messageType;
    protected int $createdAt;

    public function __construct(
        User $sender, 
        User $receiver,
        string $messageText,
        int $messageType
    )
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->messageText = $messageText;
        $this->messageType = $messageType;
        $this->createdAt = time();
    }

    /**
     * Get Sender Full Name
     */
    public function getSenderFullName(): string
    {
        return $this->sender->getFullName();
    }

    /**
     * Get Receiver Full Name
     */
    public function getReceiverFullName(): string
    {
        return $this->receiver->getFullName();
    }

    /**
     * Get Text Message
     */
    public function getTextMessage(): string
    {
        return $this->messageText;
    }

    /**
     * Ger Created Date Time with Formatter
     */
    public function getCreatedAt(): string
    {
        return date('l jS \of F Y h:i:s A', $this->createdAt);
    }

    /**
     * Send Text Message
     */
    public function sendTextMessage(): bool 
    {
        if (($this->sender->getRole() == Role::$TEACHER ) 
            && ($this->messageType == MessageType::$SYSTEM)
        ) {
            if ($this->receiver->getRole() != Role::$STUDENT) {
                echo "\r\nSend failed! System message not allowed for
                 this User type!";
                return false;
            }
        }

        if (($this->sender->getRole() == Role::$STUDENT 
            || $this->sender->getRole() == Role::$PARENT) 
            && ($this->receiver->getRole() == Role::$PARENT 
            || $this->sender->getRole() == Role::$STUDENT)
        ) {
            echo (
            "\r\nSend failed! These users are not allowed 
            to message each other."
            );
            return false;
        }

        echo "\r\nMessage sent successfully!";
        return true;
    }

    /**
     * Save Message
     */
    public function save(): bool
    {
        if (($this->sender->getRole() != Role::$TEACHER ) 
            && ($this->messageType == MessageType::$SYSTEM)
        ) {
            echo "\r\nSave message failed! Action not allowed.";
            return false;
        }

        echo "\r\nSaved message successfully.";
        return true;
    }

}

?>