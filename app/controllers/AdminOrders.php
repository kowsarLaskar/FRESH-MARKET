<?php
class AdminOrders extends Controller {
    private $orderModel;

    public function __construct() {
        // Security Gatekeeper
        if (!isLoggedIn() || $_SESSION['user_role'] != 'admin') {
            redirect('users/login');
        }

        // Load the Model
        $this->orderModel = $this->model('Order');
    }

    // 1. List All Orders
    public function index() {
        $orders = $this->orderModel->getAllOrders();
        
        $data = [
            'orders' => $orders
        ];

        $this->view('admin/orders/index', $data);
    }

    // 2. View Single Order & Update Status
    public function show($id) {
        // 1. Get Order Data
        $order = $this->orderModel->getOrderById($id);
        if (!$order) { redirect('adminOrders'); }

        // 2. Get Order Items
        $items = $this->orderModel->getOrderItems($id);

        // 3. Get List of Delivery Boys
        $deliveryBoys = $this->orderModel->getDeliveryBoys();
        
        // 4. Get Currently Assigned Boy
        $assignedBoy = $this->orderModel->getAssignedDeliveryBoy($id);

        // 5. Handle Form Submissions
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // A. Handle Status Update (Standard Admin Actions)
            if (isset($_POST['order_status'])) {
                $newStatus = trim($_POST['order_status']);
                if($this->orderModel->updateStatus($id, $newStatus)) {
                    redirect('adminOrders/show/' . $id);
                }
            }

            // B. Handle Delivery Staff Assignment / Broadcast
            if (isset($_POST['delivery_boy_id'])) {
                $boyId = trim($_POST['delivery_boy_id']);
                
                // --- NEW LOGIC FOR BROADCAST ---
                if ($boyId === 'broadcast') {
                    // 1. Set driver to NULL
                    $this->orderModel->assignDeliveryBoy($id, NULL);
                    // 2. Automatically push to processing so staff can see it
                    $this->orderModel->updateStatus($id, 'processing');
                    
                } else {
                    // --- SPECIFIC STAFF LOGIC ---
                    // 1. Assign to specific driver
                    $this->orderModel->assignDeliveryBoy($id, $boyId);
                    // 2. Automatically push to processing
                    $this->orderModel->updateStatus($id, 'processing');
                }

                redirect('adminOrders/show/' . $id);
            }
        }

        $data = [
            'nav' => 'dashboard',
            'order' => $order,
            'items' => $items,            
            'delivery_boys' => $deliveryBoys, 
            'assigned_boy' => $assignedBoy    
        ];

        $this->view('admin/orders/details', $data);
    }
}