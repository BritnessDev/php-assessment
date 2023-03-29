<?php

use App\Message;
use App\MessageType;
use PHPUnit\Framework\TestCase;
use App\User;
use App\Role;

class MessageTest extends TestCase
{
    private $_student;
    private $_parent;
    private $_teacher;
    private $_teachStudMsg;
    private $_teachParentMsg;
    private $_studTeachMsg;
    private $_parentTeachMsg;
    private $_invalidTextMessage;

    public function setUp(): void
    {
        $this->_student = new User(
            1, 
            "Marko", 
            "Vucen",
            "marko.vucen@gmail.com",
            Role::$STUDENT
        );

        $this->_parent = new User(
            2, 
            "Anthony", 
            "Araki",
            "anthony.araki@gmail.com",
            Role::$PARENT,
            "Miss"
        );

        $this->_teacher = new User(
            3, 
            "Olaf", 
            "Zenko",
            "olaf.zenko@gmail.com",
            Role::$TEACHER,
            "Miss"
        );

        $this->_invalidUser = new User(
            4, 
            "Kai", 
            "Wang",
            "kai.wang@gmail.com",
            Role::$STUDENT,
            "Miss",
            "kai.wang@gmail.com"
        );

        $this->_teachStudMsg = new Message(
            $this->_teacher,
            $this->_student,
            "Win!",
            MessageType::$SYSTEM
        );

        $this->_teachParentMsg = new Message(
            $this->_teacher,
            $this->_parent,
            "Win!",
            MessageType::$MANUAL
        );

        $this->_studTeachMsg = new Message(
            $this->_student,
            $this->_teacher,
            "Ok.",
            MessageType::$MANUAL
        );

        $this->_parentTeachMsg = new Message(
            $this->_parent,
            $this->_teacher,
            "Will be meeting!",
            MessageType::$MANUAL
        );

        $this->_invalidTextMessage = new Message(
            $this->_student,
            $this->_teacher,
            "Late for today!",
            MessageType::$SYSTEM
        );
    }

    public function testSystemMessagesFromTeachersToStudentsOnly()
    {
        $this->assertTrue($this->_teachStudMsg->sendTextMessage());
    }

    public function testSystemMessagesFromTeachersToParentsOnly()
    {
        $this->assertFalse($this->_teachParentMsg->sendTextMessage());
    }

    public function testSenderAndReceiverFullName()
    {
        $this->assertEquals(
            "Mr Olaf Zenko", 
            $this->_teachStudMsg->getSenderFullName()
        );

        $this->assertEquals(
            "Mark Jeans", 
            $this->_teachStudMsg->getReceiverFullName()
        );
    }

    public function testGetMessageText()
    {
        $this->assertEquals(
            "Ok. Thanks.", 
            $this->_studTeachMsg->getTextMessage()
        );
    }

    public function testGetTimeOfMessageInHumanReadableFormat()
    {
        $this->assertEquals(
            date('l jS \of F Y h:i:s A', time()), 
            $this->_parentTeachMsg->getCreatedAt()
        );
    }

    public function testMessageSave()
    {
        $this->assertEquals(false, $this->_invalidTextMessage->save());
        $this->assertEquals(true, $this->_teachStudMsg->save());
    }

}