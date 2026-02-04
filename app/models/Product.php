<?php
class Product {
    private $db;
    public function __construct() { $this->db = new Database(); }

    public function getWeeklyDeals() {
        // Ensure you have a table named 'products' with these columns!
        $this->db->query("SELECT * FROM products WHERE status = 1 ORDER BY created_at DESC LIMIT 8");
        return $this->db->resultSet();
    }

    
    public function getGrabNGo() {
    // Get 4 random active products
    $this->db->query("SELECT * FROM products WHERE status = 1 ORDER BY RAND() LIMIT 4");
    return $this->db->resultSet();
    }


    public function getCategories() {
        $this->db->query("SELECT * FROM categories WHERE status = 1");
        return $this->db->resultSet();
    }

    // 2. Get all active products for the Shop Grid
    public function getShopProducts() {
        // We select all products that are active (status = 1)
        $this->db->query("SELECT * FROM products WHERE status = 1");
        return $this->db->resultSet();
    }

    // Find a single product by ID
    public function findProductById($id) {
        $this->db->query("SELECT * FROM products WHERE product_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}