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
            $product_id = (int)$_POST['product_id'];
            $qty = (int)$_POST['qty'];

            $product = $this->productModel->findProductById($product_id);

            if ($product) {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

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
            }
        }
        // FIX: Redirect back to the previous page (Shop) instead of Cart
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