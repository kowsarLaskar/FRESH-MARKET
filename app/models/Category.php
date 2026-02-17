<?php
class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Get all categories
    // Get all categories
    public function getCategories()
    {
        // CHANGED: Sort by 'category_id' because 'created_at' does not exist
        $this->db->query("SELECT * FROM categories ORDER BY category_id DESC");
        return $this->db->resultSet();
    }


    // Add New Category
    public function addCategory($data)
    {
        $this->db->query('INSERT INTO categories (name, description, image, status) VALUES (:name, :description, :image, :status)');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':status', $data['status']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Update Category
    public function updateCategory($data)
    {
        // Added 'image = :image' to the query
        $this->db->query('UPDATE categories SET name = :name, description = :description, status = :status, image = :image WHERE category_id = :id');

        $this->db->bind(':id', $data['category_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':image', $data['image']); // Bind the image

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Get single category by ID
    public function getCategoryById($id)
    {
        $this->db->query("SELECT * FROM categories WHERE category_id = :id");
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
    // Delete a category
    public function deleteCategory($id)
    {
        $this->db->query("DELETE FROM categories WHERE category_id = :id");
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}