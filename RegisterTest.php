<?php

use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase
{
    protected $conn;

    protected function setUp(): void
    {
        // Connect to the database
        $this->conn = new mysqli('localhost', 'username', 'password', 'database');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    protected function tearDown(): void
    {
        // Close the database connection
        $this->conn->close();
    }

    public function testSuccessfulRegistration()
    {
        $_POST['submit'] = true;
        $_POST['first_name'] = 'Test';
        $_POST['last_name'] = 'User';
        $_POST['email'] = 'testuser@example.com';
        $_POST['phone'] = '123456789';
        $_POST['username'] = 'testuser';
        $_POST['password'] = 'password123';
        $_POST['password_confirmation'] = 'password123';

        // Capture the output
        ob_start();
        include '../register.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Đăng ký thành công', $output);

        // Check if the user was inserted into the database
        $result = $this->conn->query("SELECT * FROM tbl_register WHERE username = 'testuser'");
        $this->assertEquals(1, $result->num_rows);

        // Clean up the database
        $this->conn->query("DELETE FROM tbl_register WHERE username = 'testuser'");
    }

    public function testPasswordMismatch()
    {
        $_POST['submit'] = true;
        $_POST['first_name'] = 'Test';
        $_POST['last_name'] = 'User';
        $_POST['email'] = 'testuser@example.com';
        $_POST['phone'] = '123456789';
        $_POST['username'] = 'testuser';
        $_POST['password'] = 'password123';
        $_POST['password_confirmation'] = 'wrongpassword';

        // Capture the output
        ob_start();
        include '../register.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Đăng ký thất bại', $output);
    }
}
