<?php
class Admin extends Controller {
    private $adminModel; // Variable to hold the model

    public function __construct() {
        // 1. Run the Security Check
        // (Ensures only admins can see this page)
        ensureAdmin();
        
        // 2. Load the Model
        // We renamed the model to 'Dashboard', so we must call it 'Dashboard' here
        $this->adminModel = $this->model('Dashboard'); 
    }

    public function index() {
        // 3. Fetch Data for the Dashboard
        $data = [
            'revenue' => $this->adminModel->getTotalRevenue(),
            'total_orders' => $this->adminModel->getTotalOrders(),
            'total_users' => $this->adminModel->getTotalUsers(),
            'low_stock' => $this->adminModel->getLowStockProducts(),
            'recent_orders' => $this->adminModel->getRecentOrders()
        ];

        // 4. Load the View
        $this->view('admin/index', $data);
    }
    
    // Placeholder Pages (So the sidebar links don't crash)
    public function products() {
        echo "<h1>Product Management Page</h1>";
    }

    public function orders() {
        echo "<h1>Order Management Page</h1>";
    }

    public function delivery() {
        echo "<h1>Delivery Management Page</h1>";
    }
}