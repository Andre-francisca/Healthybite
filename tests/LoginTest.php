<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Validation.php';

class LoginTest extends TestCase {

    public function testLoginWithValidCredentials() {
        $email = "flad7938@gmail.com";     // Use real email from your DB
        $password = "1234";          // Use matching password

        $login = Validation::login($email, $password);
        $this->assertTrue($login, "Login should succeed for valid credentials");
    }

    // public function testLoginWithInvalidPassword() {
    //     $email = "jchinwor@gmail.com";     // Same email as above
    //     $wrongPassword = "wrong_password";       // Intentionally wrong

    //     $login = Validation::login($email, $wrongPassword);
    //     $this->assertFalse($login, "Login should fail for wrong password");
    // }

    // public function testLoginWithNonExistingEmail() {
    //     $email = "nonexistent@example.com";
    //     $password = "anyPassword";

    //     $login = Validation::login($email, $password);
    //     $this->assertFalse($login, "Login should fail for nonexistent user");
    // }
}
