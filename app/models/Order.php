<?php
class Order {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

   
    // 1. Create the Main Order (Header)
    public function createOrder($data) {
        $this->db->query('INSERT INTO orders (user_id, total_amount, payment_mode, payment_status, order_status, delivery_address) 
                          VALUES (:user_id, :total_amount, :payment_mode, :payment_status, :order_status, :delivery_address)');

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':total_amount', $data['total_amount']);
        $this->db->bind(':payment_mode', $data['payment_mode']);
        $this->db->bind(':payment_status', 'pending'); // Default to pending
        $this->db->bind(':order_status', 'pending');   // Default to pending
        $this->db->bind(':delivery_address', $data['address']);

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // 2. Add Items to the Order
    public function addOrderItems($order_id, $cart_items) {
        $this->db->query('INSERT INTO order_items (order_id, product_id, quantity, price) 
                          VALUES (:order_id, :product_id, :quantity, :price)');

        foreach ($cart_items as $id => $item) {
            $this->db->bind(':order_id', $order_id);
            $this->db->bind(':product_id', $id);
            $this->db->bind(':quantity', $item['qty']);
            $this->db->bind(':price', $item['selling_price']); // Ensure key matches session

            if (!$this->db->execute()) {
                return false;
            }
        }
        return true;
    }

    // 3. Get Orders for a Specific User (For "My Orders" Page)
    public function getOrdersByUserId($user_id) {
        $this->db->query("SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_date DESC");
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    // =========================================================
    // ADMIN FUNCTIONS (Manage Orders)
    // =========================================================

    // 4. Get All Orders (Joined with Users to see who bought what)
    public function getAllOrders() {
        $this->db->query("SELECT orders.*, users.full_name, users.phone 
                          FROM orders 
                          JOIN users ON orders.user_id = users.user_id 
                          ORDER BY orders.order_date DESC");
        return $this->db->resultSet();
    }

    // 5. Update Order Status
    public function updateStatus($id, $status) {
        $this->db->query("UPDATE orders SET order_status = :status WHERE order_id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // =========================================================
    // SHARED FUNCTIONS (Details & Items)
    // =========================================================

    // 6. Get Single Order Details (Used by both Admin & Customer)
    public function getOrderById($id) {
        $this->db->query("SELECT orders.*, users.full_name, users.email, users.phone 
                          FROM orders 
                          JOIN users ON orders.user_id = users.user_id 
                          WHERE orders.order_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // 7. Get Items inside an Order (Used by both Admin & Customer)
    public function getOrderItems($order_id) {
        $this->db->query("SELECT order_items.*, products.name, products.image, products.unit_value, products.unit_type
                          FROM order_items 
                          JOIN products ON order_items.product_id = products.product_id 
                          WHERE order_id = :id");
        $this->db->bind(':id', $order_id);
        return $this->db->resultSet();
    }
}