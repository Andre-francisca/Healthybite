<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Validation.php';

class RegisterTest extends TestCase {

    public function testUserRegistrationSuccess() {
        $username = "RegisterUser_" . uniqid();
        $email = "register_" . uniqid() . "@example.com";
        $password = "StrongPass123";
        $phone = "0550000000";
        $condition = "None";

        $result = Validation::register($username, $email, $password, $phone, $condition);
        $this->assertTrue($result);
    }

    
}
