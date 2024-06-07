<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = new mysqli('localhost', 'username', 'password', 'database');
    }

    protected function tearDown(): void
    {
        $this->conn->close();
    }

    public function testValidLogin()
    {
        $username = 'valid_user';
        $password = md5('valid_password'); // Use md5 or the hash function used in your application
        
        $sql = "SELECT * FROM tbl_register WHERE username = '$username' AND password = '$password'";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);
        
        $this->assertEquals(1, $count);
    }

    public function testInvalidLogin()
    {
        $username = 'invalid_user';
        $password = md5('invalid_password');
        
        $sql = "SELECT * FROM tbl_register WHERE username = '$username' AND password = '$password'";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);
        
        $this->assertEquals(0, $count);
    }
}
