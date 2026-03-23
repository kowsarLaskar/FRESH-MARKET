<?php
class Vendors extends Controller
{

    private $vendorModel;

    public function __construct()
    {
        // SECURITY CHECK: If not logged in, or not a vendor/admin, kick them out
        if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'vendor' && $_SESSION['user_role'] != 'admin')) {
            // Assuming you have a redirect helper function
            redirect('users/login');
        }

        // Load the Vendor database model (we will build this next!)
        $this->vendorModel = $this->model('Vendor');
    }

    // 1. Load the main Vendor Dashboard
    public function index()
    {
        $data = [
            'title' => 'Vendor Dashboard'
        ];

        $this->view('vendors/index', $data);
    }

    // 2. Load the Vendor's specific products
    public function products()
    {
        // Fetch only products belonging to the logged-in vendor
        $products = $this->vendorModel->getProductsByVendor($_SESSION['user_id']);

        $data = [
            'products' => $products
        ];

        $this->view('vendors/products', $data);
    }

    // 3. Load the Vendor's specific order items
    public function orders()
    {
        // Fetch only order items assigned to this specific vendor
        $orders = $this->vendorModel->getOrdersByVendor($_SESSION['user_id']);

        $data = [
            'orders' => $orders
        ];

        $this->view('vendors/orders', $data);
    }

    // 4. Handle the "Update Status" button click
    public function updateStatus($item_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $new_status = trim($_POST['vendor_status']);

            // Update the status in the order_items table
            if ($this->vendorModel->updateItemStatus($item_id, $new_status, $_SESSION['user_id'])) {
                // Success! Redirect back to their orders page
                redirect('vendors/orders');
            } else {
                die('Something went wrong updating the status.');
            }
        } else {
            // If they try to load this via URL instead of clicking a button, redirect
            redirect('vendors/orders');
        }
    }
    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Simple Image Upload Handling
            $image_name = $_FILES['image']['name'];
            $target_dir = dirname(dirname(dirname(__FILE__))) . '/public/assets/products/';
            $target_file = $target_dir . basename($image_name);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $data = [
                'vendor_id' => $_SESSION['user_id'], // Automatically attach the logged-in vendor
                'category_id' => trim($_POST['category_id']),
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'mrp' => trim($_POST['mrp']),
                'selling_price' => trim($_POST['selling_price']),
                'unit_value' => trim($_POST['unit_value']),
                'unit_type' => trim($_POST['unit_type']),
                'stock_qty' => trim($_POST['stock_qty']),
                'image' => $image_name
            ];

            if ($this->vendorModel->addProduct($data)) {
                // Redirect back to their product list on success
                redirect('vendors/products');
            } else {
                die('Something went wrong adding the product.');
            }
        } else {
            // If it's a GET request, load the form and pass the categories
            $categories = $this->vendorModel->getCategories();

            $data = [
                'categories' => $categories
            ];

            $this->view('vendors/add_product', $data);
        }
    }
}
