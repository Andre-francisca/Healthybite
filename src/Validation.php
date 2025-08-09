<?php
require_once __DIR__ . '/Database.php';

class Validation {

    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validatePassword($password) {
        return strlen($password) >= 6;
    }

    public static function register($username, $email, $password, $phone, $condition) {
        $conn = Database::connect();

        // Check if email already exists
        $stmt = $conn->prepare("SELECT user_email FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->close();
            $conn->close();
            return false; // Email already exists
        }
        $stmt->close();

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password, user_phone, healthcondition) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $hashedPassword, $phone, $condition);
        $result = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $result;
    }

    public static function login($email, $password) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT user_password FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            // Match plain-text for now (hash if needed)
            if (password_verify($password,$hashedPassword)) {
                return true;
            }
        }

        return false;
    }
    public static function restaurantLogin($email, $password) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT password FROM restaurants WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            // Match plain-text for now (hash if needed)
            if (password_verify($password,$hashedPassword)) {
                return true;
            }
        }

        return false;
    }
}
