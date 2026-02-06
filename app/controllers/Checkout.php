<?php
class Checkout extends Controller {
    private $orderModel;

    public function __construct() {
        // 1. Security: Must be logged in
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        
        $this->orderModel = $this->model('Order');

        // 2. Cart Security: Cart cannot be empty
        // FIX: We skip this check if the user is visiting the 'success' page
        $currentMethod = trim($_SERVER['REQUEST_URI'], '/');
        // Check if URL ends with 'success'
        if (strpos($currentMethod, 'success') === false) {
            if (empty($_SESSION['cart'])) {
                redirect('pages/cart');
            }
        }
    }

    public function index() {
        $total = 0;
        if(isset($_SESSION['cart'])){
            foreach ($_SESSION['cart'] as $item) {
                $total += $item['selling_price'] * $item['qty'];
            }
        }

        $data = [
            'cart_items' => $_SESSION['cart'] ?? [],
            'total' => $total
        ];

        $this->view('checkout/index', $data);
    }

    public function placeOrder() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $total = 0;
            if(isset($_SESSION['cart'])){
                foreach ($_SESSION['cart'] as $item) {
                    $total += $item['selling_price'] * $item['qty'];
                }
            }

            // Prepare Data for 'orders' table
            $data = [
                'user_id' => $_SESSION['user_id'],
                'total_amount' => $total,
                'payment_mode' => trim($_POST['payment_mode']),
                'address' => trim($_POST['address']) . ', ' . trim($_POST['city']) . ', ' . trim($_POST['zip'])
            ];

            // Create the Order Header
            $order_id = $this->orderModel->createOrder($data);

            if ($order_id) {
                // Create Order Items
                if ($this->orderModel->addOrderItems($order_id, $_SESSION['cart'])) {
                    
                    // SUCCESS: Clear Cart and Redirect
                    unset($_SESSION['cart']); 
                    redirect('checkout/success'); 
                } else {
                    die('Failed to save order items');
                }
            } else {
                die('Failed to create order');
            }

        } else {
            redirect('checkout');
        }
    }

    // The "Thank You" page
    public function success() {
        $this->view('checkout/order_success');
    }
}