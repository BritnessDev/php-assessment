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
  

}

?>