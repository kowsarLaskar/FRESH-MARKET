<?php
class Vendor
{
  private $db;

  public function __construct()
  {
    // Initialize your custom database PDO wrapper
    $this->db = new Database();
  }

  // ---------------------------------------------------------
  // 1. Fetch only the products owned by the logged-in vendor
  // ---------------------------------------------------------
  public function getProductsByVendor($vendor_id)
  {
    $this->db->query('SELECT * FROM products WHERE vendor_id = :vendor_id ORDER BY created_at DESC');

    // Bind the session ID to the query for security
    $this->db->bind(':vendor_id', $vendor_id);

    return $this->db->resultSet();
  }

  // ---------------------------------------------------------
  // 2. Fetch the specific order items assigned to the vendor
  // ---------------------------------------------------------
  public function getOrdersByVendor($vendor_id)
  {
    // This is a complex JOIN query! We need the item details, the product name, 
    // the master order's delivery address, and the customer's name.
    $this->db->query('
            SELECT 
                oi.item_id, 
                oi.quantity, 
                oi.price, 
                oi.vendor_status,
                p.name AS product_name,
                p.image AS product_image,
                o.order_id,
                o.order_date,
                o.delivery_address,
                o.payment_mode,
                u.full_name AS customer_name,
                u.phone AS customer_phone
            FROM order_items oi
            INNER JOIN products p ON oi.product_id = p.product_id
            INNER JOIN orders o ON oi.order_id = o.order_id
            INNER JOIN users u ON o.user_id = u.user_id
            WHERE oi.vendor_id = :vendor_id
            ORDER BY o.order_date DESC
        ');

    $this->db->bind(':vendor_id', $vendor_id);

    return $this->db->resultSet();
  }

  // ---------------------------------------------------------
  // 3. Update the fulfillment status of a specific item
  // ---------------------------------------------------------
  public function updateItemStatus($item_id, $new_status, $vendor_id)
  {
    // Notice we check BOTH the item_id AND the vendor_id.
    // This prevents a hacker from guessing an item_id and changing someone else's order!
    $this->db->query('
            UPDATE order_items 
            SET vendor_status = :vendor_status 
            WHERE item_id = :item_id AND vendor_id = :vendor_id
        ');

    $this->db->bind(':vendor_status', $new_status);
    $this->db->bind(':item_id', $item_id);
    $this->db->bind(':vendor_id', $vendor_id);

    // Execute the update. Returns true if successful.
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Fetch categories for the Add Product dropdown
  public function getCategories()
  {
    $this->db->query('SELECT * FROM categories');
    return $this->db->resultSet();
  }

  // Insert a new product into the database
  public function addProduct($data)
  {
    $this->db->query('INSERT INTO products (vendor_id, category_id, name, description, mrp, selling_price, unit_value, unit_type, stock_qty, image, status) 
                          VALUES (:vendor_id, :category_id, :name, :description, :mrp, :selling_price, :unit_value, :unit_type, :stock_qty, :image, 1)');

    $this->db->bind(':vendor_id', $data['vendor_id']);
    $this->db->bind(':category_id', $data['category_id']);
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':description', $data['description']);
    $this->db->bind(':mrp', $data['mrp']);
    $this->db->bind(':selling_price', $data['selling_price']);
    $this->db->bind(':unit_value', $data['unit_value']);
    $this->db->bind(':unit_type', $data['unit_type']);
    $this->db->bind(':stock_qty', $data['stock_qty']);
    $this->db->bind(':image', $data['image']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
