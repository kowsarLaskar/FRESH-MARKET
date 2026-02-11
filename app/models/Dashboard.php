<?php
class Dashboard {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // 1. Get Total Revenue
    // Calculate Net Revenue (Total Sales - Driver Fees)
    public function getTotalRevenue() {
        // We only count DELIVERED orders
        $this->db->query("SELECT SUM(total_amount - driver_fee) as net_revenue FROM orders WHERE order_status = 'delivered'");
        
        $row = $this->db->single();
        
        return $row->net_revenue ? $row->net_revenue : 0;
    }

    // 2. Get Total Orders Count
    public function getTotalOrders() {
        $this->db->query("SELECT COUNT(*) as count FROM orders");
        $row = $this->db->single();
        return $row->count;
    }

    // 3. Get Total Users Count (Customers only)
    public function getTotalUsers() {
        // Matches 'role' enum in 'users' table
        $this->db->query("SELECT COUNT(*) as count FROM users WHERE role = 'customer'");
        $row = $this->db->single();
        return $row->count;
    }

    // 4. Get Low Stock Products (Alerts)
    public function getLowStockProducts() {
        // Matches 'stock_qty' in 'products' table
        $this->db->query("SELECT * FROM products WHERE stock_qty < 10 LIMIT 5");
        return $this->db->resultSet();
    }

    // 5. Get Recent Orders (For the table)
    public function getRecentOrders() {
        // UPDATED: Uses 'order_date' and 'order_status' and 'full_name'
        $this->db->query("SELECT orders.order_id, orders.total_amount, orders.order_status, orders.order_date, users.full_name 
                          FROM orders 
                          JOIN users ON orders.user_id = users.user_id 
                          ORDER BY orders.order_date DESC 
                          LIMIT 5");
        return $this->db->resultSet();
    }
    // Get count of users by specific role (e.g., 'delivery_boy')
    public function countUsersByRole($role) {
        $this->db->query("SELECT COUNT(*) as count FROM users WHERE role = :role");
        $this->db->bind(':role', $role);
        $row = $this->db->single();
        return $row->count;
    }
}