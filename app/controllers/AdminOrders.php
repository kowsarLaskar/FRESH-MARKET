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
        // Handle Status Update Submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newStatus = trim($_POST['order_status']);
            if($this->orderModel->updateStatus($id, $newStatus)) {
                // Refresh page to show new status
                redirect('adminOrders/show/' . $id);
            } else {
                die('Something went wrong');
            }
        }

        // Get Order Data
        $order = $this->orderModel->getOrderById($id);

        if (!$order) {
            redirect('adminOrders');
        }

        $data = [
            'order' => $order
        ];

        $this->view('admin/orders/details', $data);
    }
}