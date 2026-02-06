<?php
class Category {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Get all categories
    // Get all categories
    public function getCategories() {
        // CHANGED: Sort by 'category_id' because 'created_at' does not exist
        $this->db->query("SELECT * FROM categories ORDER BY category_id DESC");
        return $this->db->resultSet();
    }

    // Add a new category
    public function addCategory($data) {
        $this->db->query("INSERT INTO categories (name, description) VALUES (:name, :description)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete a category
    public function deleteCategory($id) {
        $this->db->query("DELETE FROM categories WHERE category_id = :id");
        $this->db->bind(':id', $id);
        
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}