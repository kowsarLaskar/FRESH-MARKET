<?php
class admin_Product {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Add New Product
    public function addProduct($data) {
        $this->db->query('INSERT INTO products (category_id, name, description, mrp, selling_price, unit_value, unit_type, stock_qty, image, is_organic, is_featured, status) 
                          VALUES (:category_id, :name, :description, :mrp, :selling_price, :unit_value, :unit_type, :stock_qty, :image, :is_organic, :is_featured, :status)');

        // Bind values
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':mrp', $data['mrp']);
        $this->db->bind(':selling_price', $data['selling_price']);
        $this->db->bind(':unit_value', $data['unit_value']); // e.g., "1" or "500"
        $this->db->bind(':unit_type', $data['unit_type']);   // e.g., "kg" or "gm"
        $this->db->bind(':stock_qty', $data['stock_qty']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':is_organic', $data['is_organic']);
        $this->db->bind(':is_featured', $data['is_featured']);
        $this->db->bind(':status', 1); // Default to Active

        return $this->db->execute();
    }

    // Get All Products (For the list page later)
    public function getProducts() {
        $this->db->query('SELECT products.*, categories.name as category_name 
                          FROM products 
                          JOIN categories ON products.category_id = categories.category_id 
                          ORDER BY products.product_id DESC');
        return $this->db->resultSet();
    }

    // 1. Get Single Product (For filling the Edit Form)
    public function getProductById($id) {
        $this->db->query("SELECT * FROM products WHERE product_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // 2. Update Product
    public function updateProduct($data) {
        $this->db->query('UPDATE products SET 
                            category_id = :category_id,
                            name = :name,
                            description = :description,
                            mrp = :mrp,
                            selling_price = :selling_price,
                            unit_value = :unit_value,
                            unit_type = :unit_type,
                            stock_qty = :stock_qty,
                            image = :image,
                            is_organic = :is_organic,
                            is_featured = :is_featured,
                            status = :status
                          WHERE product_id = :id');

        // Bind all values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':mrp', $data['mrp']);
        $this->db->bind(':selling_price', $data['selling_price']);
        $this->db->bind(':unit_value', $data['unit_value']);
        $this->db->bind(':unit_type', $data['unit_type']);
        $this->db->bind(':stock_qty', $data['stock_qty']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':is_organic', $data['is_organic']);
        $this->db->bind(':is_featured', $data['is_featured']);
        $this->db->bind(':status', $data['status']);

        return $this->db->execute();
    }

    // 3. Delete Product
    public function deleteProduct($id) {
        $this->db->query("DELETE FROM products WHERE product_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}