<?php
namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserGettersAndSetters()
    {
        $user = new User();
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setEmail('john@example.com');
        $user->setPhone('0601020304');
        $user->setBirthDate(new \DateTime('2000-01-01'));
        $user->setGender('male');
        $user->setAddress('123 rue de Paris');
        $user->setAvatar('avatar.jpg');
        $user->setPassword('hashed_password');

        $this->assertEquals('John', $user->getFirstName());
        $this->assertEquals('Doe', $user->getLastName());
        $this->assertEquals('john@example.com', $user->getEmail());
        $this->assertEquals('0601020304', $user->getPhone());
        $this->assertEquals('2000-01-01', $user->getBirthDate()->format('Y-m-d'));
        $this->assertEquals('male', $user->getGender());
        $this->assertEquals('123 rue de Paris', $user->getAddress());
        $this->assertEquals('avatar.jpg', $user->getAvatar());
        $this->assertEquals('hashed_password', $user->getPassword());
    }

    public function testUserRoles()
    {
        $user = new User();
        $this->assertContains('ROLE_USER', $user->getRoles());
        $user->setRoles(['ROLE_ADMIN']);
        $this->assertContains('ROLE_ADMIN', $user->getRoles());
    }
} 