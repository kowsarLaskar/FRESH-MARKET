<?php
class Orders extends Controller {
    private $orderModel;
    public function __construct() {
        // 1. Security: Must be logged in
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        // Load the Unified Model
        $this->orderModel = $this->model('Order');
    }

    // List all orders for the logged-in user
    public function index() {
        // Fetch orders ONLY for this user
        $orders = $this->orderModel->getOrdersByUserId($_SESSION['user_id']);
        
        $data = [
            'orders' => $orders
        ];

        $this->view('orders/index', $data);
    }

    // Show details of one specific order
    public function show($id) {
        // Get Order Details
        $order = $this->orderModel->getOrderById($id);

        // Security Check 1: Does order exist?
        if (!$order) {
            redirect('orders');
        }

        // Security Check 2: Does this order belong to the logged-in user?
        if ($order->user_id != $_SESSION['user_id']) {
            redirect('orders'); // Kick them out if they try to spy on others
        }

        // Get Items inside the order
        $items = $this->orderModel->getOrderItems($id);

        $data = [
            'order' => $order,
            'items' => $items
        ];

        $this->view('orders/details', $data);
    }
}