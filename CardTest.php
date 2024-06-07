<?php

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        // Mock database connection (you can adjust to your actual configuration)
        $this->conn = new mysqli('localhost', 'username', 'password', 'test_db');
        
        // Ensure connection is successful
        if ($this->conn->connect_error) {
            $this->fail('Connection failed: ' . $this->conn->connect_error);
        }

        // Create a test table and insert test data
        $this->conn->query("CREATE TABLE IF NOT EXISTS tbl_products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            price FLOAT NOT NULL,
            image_name VARCHAR(255)
        )");

        $this->conn->query("INSERT INTO tbl_products (title, price, image_name) VALUES 
            ('Test Product 1', 1000, 'image1.jpg')
        ");
    }

    protected function tearDown(): void
    {
        // Drop the test table
        $this->conn->query("DROP TABLE tbl_products");
        $this->conn->close();
    }

    public function testAddToCart()
    {
        // Initialize session
        $_SESSION = [];
        
        $id = 1; // ID of the test product
        $action = 'add';
        $quantity = 1;

        $sql = "SELECT * FROM tbl_products WHERE id = $id"; 
        $res = $this->conn->query($sql);
        $this->assertTrue($res->num_rows > 0);

        $row = $res->fetch_assoc();
        $item = [
            'id' => $row['id'], 
            'title' => $row['title'], 
            'image_name' => $row['image_name'], 
            'price' => $row['price'], 
            'qty' => $quantity
        ];

        if($action == 'add'){
            if(isset($_SESSION['cart'][$id])){
                $_SESSION['cart'][$id]['qty'] = (int)$_SESSION['cart'][$id]['qty'] + $quantity;
            }else{
                $_SESSION['cart'][$id] = $item; 
            }
        }

        $this->assertEquals(1, $_SESSION['cart'][$id]['qty']);
        $this->assertEquals($row['title'], $_SESSION['cart'][$id]['title']);
    }

    public function testUpdateCart()
    {
        // Initialize session
        $_SESSION = [
            'cart' => [
                1 => [
                    'id' => 1, 
                    'title' => 'Test Product 1', 
                    'image_name' => 'image1.jpg', 
                    'price' => 1000, 
                    'qty' => 1
                ]
            ]
        ];

        $id = 1;
        $action = 'update';
        $quantity = 3;

        if($action == 'update'){
            $_SESSION['cart'][$id]['qty'] = $quantity;
        }

        $this->assertEquals($quantity, $_SESSION['cart'][$id]['qty']);
    }

    public function testDeleteFromCart()
    {
        // Initialize session
        $_SESSION = [
            'cart' => [
                1 => [
                    'id' => 1, 
                    'title' => 'Test Product 1', 
                    'image_name' => 'image1.jpg', 
                    'price' => 1000, 
                    'qty' => 1
                ]
            ]
        ];

        $id = 1;
        $action = 'delete';

        if($action == 'delete'){
            unset($_SESSION['cart'][$id]);
        }

        $this->assertArrayNotHasKey($id, $_SESSION['cart']);
    }
}
