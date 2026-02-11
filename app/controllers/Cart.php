<?php
class Cart extends Controller {
    private $productModel;
    
    public function __construct() {
        $this->productModel = $this->model('Product');
    }

    public function index() {
        $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        $subtotal = 0;
        foreach($cartItems as $item) {
            $subtotal += ($item['selling_price'] * $item['qty']);
        }

        $data = [
            'title' => 'My Cart',
            'cart_items' => $cartItems,
            'subtotal' => $subtotal
        ];

        $this->view('cart/index', $data);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 1. Get Form Data
            $product_id = (int)$_POST['product_id'];
            $qty = isset($_POST['qty']) ? (int)$_POST['qty'] : 1; // Default to 1 if not sent

            // 2. Fetch Product
            $product = $this->productModel->findProductById($product_id);

            if ($product) {
                // Initialize Cart if empty
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                // Add or Update Item in Cart
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['qty'] += $qty;
                } else {
                    $_SESSION['cart'][$product_id] = [
                        'product_id' => $product->product_id,
                        'name' => $product->name,
                        'selling_price' => $product->selling_price,
                        'image' => $product->image,
                        'qty' => $qty
                    ];
                }

                // 3. Calculate New Total Count (For the Badge)
                $totalQty = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $totalQty += $item['qty'];
                }

                // 4. CHECK FOR AJAX (This is the new part)
                // If JavaScript sent this request, return JSON and STOP.
                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'new_count' => $totalQty]);
                    exit; // Stop here so the page doesn't reload
                }
            }
        }

        // 5. Fallback: Redirect back (For non-JS users)
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : URLROOT . '/shop';
        header('location: ' . $referer);
    }

    // NEW: Function to Increase Qty
    public function increase($id) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty']++;
        }
        header('location: ' . URLROOT . '/cart');
    }

    // NEW: Function to Decrease Qty
    public function decrease($id) {
        if (isset($_SESSION['cart'][$id])) {
            if ($_SESSION['cart'][$id]['qty'] > 1) {
                $_SESSION['cart'][$id]['qty']--;
            }
        }
        header('location: ' . URLROOT . '/cart');
    }

    public function remove($id) {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header('location: ' . URLROOT . '/cart');
    }
}