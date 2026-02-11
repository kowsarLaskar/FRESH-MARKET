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
    // Update Order Status (and record Driver Fee if Delivered)
    public function updateStatus($id, $status) {
        
        // 1. If status is 'delivered', we record the commission
        if ($status == 'delivered') {
            $this->db->query("UPDATE orders SET order_status = :status, driver_fee = :fee WHERE order_id = :id");
            $this->db->bind(':status', $status);
            $this->db->bind(':fee', DRIVER_COMMISSION); // Uses the constant from config
            $this->db->bind(':id', $id);
        } else {
            // 2. Standard update for other statuses (processing, out_for_delivery, etc.)
            $this->db->query("UPDATE orders SET order_status = :status WHERE order_id = :id");
            $this->db->bind(':status', $status);
            $this->db->bind(':id', $id);
        }

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // =========================================================
    // SHARED FUNCTIONS (Details & Items)
    // =========================================================

    // 6. Get Single Order Details (Used by both Admin & Customer)
    // 6. Get Single Order Details (Updated to fetch Delivery Boy Name)
    public function getOrderById($id) {
        $this->db->query("SELECT orders.*, 
                                 users.full_name, users.email, users.phone,
                                 db.full_name as db_name, db.phone as db_phone
                          FROM orders 
                          JOIN users ON orders.user_id = users.user_id 
                          LEFT JOIN users as db ON orders.delivery_boy_id = db.user_id 
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
    // =========================================================
    // DELIVERY BOY FUNCTIONS
    // =========================================================

    // 8. Get Orders by Specific Status (For Delivery Dashboard)
    public function getOrdersByStatus($status) {
        $this->db->query("SELECT orders.*, users.full_name, users.phone 
                          FROM orders 
                          JOIN users ON orders.user_id = users.user_id 
                          WHERE orders.order_status = :status 
                          ORDER BY orders.order_date ASC"); // Oldest orders first (priority)
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    // =========================================================
    // ASSIGNMENT FUNCTIONS
    // =========================================================

    // 9. Get List of All Delivery Boys
    public function getDeliveryBoys() {
        $this->db->query("SELECT * FROM users WHERE role = 'delivery_boy'");
        return $this->db->resultSet();
    }

    // 10. Assign a Delivery Boy to an Order
    public function assignDeliveryBoy($order_id, $delivery_boy_id) {
        $this->db->query("UPDATE orders SET delivery_boy_id = :db_id WHERE order_id = :order_id");
        $this->db->bind(':db_id', $delivery_boy_id);
        $this->db->bind(':order_id', $order_id);
        return $this->db->execute();
    }
    
    // 11. Get Assigned Delivery Boy Name (Optional helper)
    public function getAssignedDeliveryBoy($order_id) {
        $this->db->query("SELECT users.full_name, users.phone 
                          FROM orders 
                          JOIN users ON orders.delivery_boy_id = users.user_id 
                          WHERE orders.order_id = :id");
        $this->db->bind(':id', $order_id);
        return $this->db->single();
    }

    // 12. Get Delivery History with Filters
    public function getDeliveryHistory($driver_id = null, $from = null, $to = null) {
        $sql = "SELECT orders.*, users.full_name as driver_name 
                FROM orders 
                JOIN users ON orders.delivery_boy_id = users.user_id 
                WHERE orders.order_status = 'delivered'";

        // Apply Filters
        if (!empty($driver_id)) {
            $sql .= " AND orders.delivery_boy_id = :driver_id";
        }
        if (!empty($from) && !empty($to)) {
            // We add 1 day to 'to' date to include the end date fully
            $sql .= " AND orders.order_date BETWEEN :from AND :to_end";
        }

        $sql .= " ORDER BY orders.order_date DESC";

        $this->db->query($sql);

        if (!empty($driver_id)) {
            $this->db->bind(':driver_id', $driver_id);
        }
        if (!empty($from) && !empty($to)) {
            $this->db->bind(':from', $from . ' 00:00:00');
            $this->db->bind(':to_end', $to . ' 23:59:59');
        }

        return $this->db->resultSet();
    }

    // 13. Mark filtered orders as PAID
    public function markDeliveriesAsPaid($driver_id, $from, $to) {
        $this->db->query("UPDATE orders SET driver_paid_status = 'paid' 
                          WHERE delivery_boy_id = :driver_id 
                          AND order_status = 'delivered' 
                          AND driver_paid_status = 'pending'
                          AND order_date BETWEEN :from AND :to_end");

        $this->db->bind(':driver_id', $driver_id);
        $this->db->bind(':from', $from . ' 00:00:00');
        $this->db->bind(':to_end', $to . ' 23:59:59');

        return $this->db->execute();
    }

    // 14. Get ALL orders that are 'processing' but have NO driver yet (The Pool)
    public function getOpenOrders() {
        // We JOIN the users table to get the customer's full_name and phone
        $this->db->query("SELECT orders.*, users.full_name, users.phone 
                          FROM orders 
                          JOIN users ON orders.user_id = users.user_id 
                          WHERE orders.order_status = 'processing' 
                          AND orders.delivery_boy_id IS NULL 
                          ORDER BY orders.order_date ASC");
        return $this->db->resultSet();
    }

    // 15. Get orders assigned specifically to this driver
    public function getAssignedOrders($driver_id) {
        // We JOIN the users table to get the customer's full_name and phone
        $this->db->query("SELECT orders.*, users.full_name, users.phone 
                          FROM orders 
                          JOIN users ON orders.user_id = users.user_id 
                          WHERE orders.delivery_boy_id = :did 
                          AND orders.order_status IN ('processing', 'out_for_delivery') 
                          ORDER BY orders.order_date DESC");
        
        $this->db->bind(':did', $driver_id);
        return $this->db->resultSet();
    }

    // 16. Atomic Accept (Prevents Race Condition)
    public function acceptOrder($order_id, $driver_id) {
        // We only update IF delivery_boy_id IS NULL. This is the lock.
        $this->db->query("UPDATE orders SET delivery_boy_id = :did, order_status = 'out_for_delivery' 
                          WHERE order_id = :oid AND delivery_boy_id IS NULL");
        
        $this->db->bind(':did', $driver_id);
        $this->db->bind(':oid', $order_id);
        
        if ($this->db->execute()) {
            return ($this->db->rowCount() > 0); // Returns true only if YOU won the race
        }
        return false;
    }

    // 17. Complete Delivery
    public function completeDelivery($order_id, $driver_id) {
        // Mark as delivered and set the fee
        $this->db->query("UPDATE orders SET order_status = 'delivered', driver_fee = :fee 
                          WHERE order_id = :oid AND delivery_boy_id = :did");
        
        $this->db->bind(':fee', DRIVER_COMMISSION); // Uses your config constant (e.g., 40)
        $this->db->bind(':oid', $order_id);
        $this->db->bind(':did', $driver_id);
        
        return $this->db->execute();
    }

    // Get all completed deliveries for a specific driver
    public function getDeliveredOrdersByDriver($driver_id) {
        $this->db->query("SELECT orders.*, users.full_name, users.phone 
                          FROM orders 
                          JOIN users ON orders.user_id = users.user_id 
                          WHERE orders.delivery_boy_id = :did 
                          AND orders.order_status = 'delivered'
                          ORDER BY orders.order_date DESC");
        $this->db->bind(':did', $driver_id);
        return $this->db->resultSet();
    }

    // Cancel Delivery with Reason
    public function cancelDelivery($order_id, $driver_id, $reason) {
        // We set status to 'cancelled' and save the reason.
        $this->db->query("UPDATE orders SET order_status = 'cancelled', cancellation_reason = :reason 
                          WHERE order_id = :oid AND delivery_boy_id = :did");
        
        $this->db->bind(':reason', $reason);
        $this->db->bind(':oid', $order_id);
        $this->db->bind(':did', $driver_id);
        
        return $this->db->execute();
    }
}