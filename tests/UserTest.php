<?php

use PHPUnit\Framework\TestCase;
use App\User;
use App\Role;

class UserTest extends TestCase
{
    private $_student;
    private $_parent;
    private $_teacher;
    private $_invalidUser;

    public function setUp(): void
    {
        $this->_student = new User(
            1, 
            "Anthony", 
            "Araki",
            "mark.jeans@gmail.com",
            Role::$STUDENT
        );

        $this->_parent = new User(
            2, 
            "Luke", 
            "Jeans",
            "luke.jeans@gmail.com",
            Role::$PARENT,
            "Mr"
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
            "Jane", 
            "Doe",
            "jane.doegmail",
            Role::$STUDENT,
            "Miss",
            "jane.me"
        );
    }

    public function testUserFullName()
    {
        $this->assertEquals("Mr Olaf Zenko", $this->_teacher->getFullName());
        $this->assertEquals("Anthony Araki", $this->_student->getFullName());
    }

    public function testUserEmail()
    {
        $this->assertEquals("olaf.zenko@gmail.com", $this->_teacher->getEmail());
    }

    public function testUserId()
    {
        $this->assertEquals(2, $this->_parent->getUserId());
    }

    public function testUserSave()
    {
        $this->assertEquals(false, $this->_invalidUser->save());
        $this->assertEquals(true, $this->_teacher->save());
    }

}