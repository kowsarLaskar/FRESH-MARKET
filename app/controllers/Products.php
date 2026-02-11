<?php
class Products extends Controller {
    private $productModel;
    private $categoryModel;
    public function __construct() {
        // 1. Security Check
        if (!isLoggedIn() || $_SESSION['user_role'] != 'admin') {
            redirect('users/login');
        }

        // 2. Load the RENAMED Model
        $this->productModel = $this->model('admin_Product'); // <--- UPDATED
        $this->categoryModel = $this->model('Category'); 
    }

    // LIST PAGE: Shows the table
    public function index() {
        $products = $this->productModel->getProducts();
        $data = ['products' => $products];
        
        // This looks for app/views/admin/products/index.php
        $this->view('admin/products/index', $data); 
    }

    // ADD PAGE: Shows the form
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // ... (Your image upload logic stays the same) ...
            $imageName = '';
            if(!empty($_FILES['image']['name'])){
                $imageName = time() . '_' . $_FILES['image']['name'];
                $target = "../public/assets/products/" . $imageName;
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            }

            $data = [
                'nav' => 'dashboard',
                'category_id' => trim($_POST['category_id']),
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'mrp' => trim($_POST['mrp']),
                'selling_price' => trim($_POST['selling_price']),
                'unit_value' => trim($_POST['unit_value']),
                'unit_type' => trim($_POST['unit_type']),
                'stock_qty' => trim($_POST['stock_qty']),
                'image' => $imageName,
                'is_organic' => isset($_POST['is_organic']) ? 1 : 0,
                'is_featured' => isset($_POST['is_featured']) ? 1 : 0
            ];

            if ($this->productModel->addProduct($data)) {
                redirect('products'); 
            } else {
                die('Something went wrong');
            }

        } else {
            // LOAD VIEW FOR ADDING
            $categories = $this->categoryModel->getCategories();
            $data = ['categories' => $categories];
            
            // This looks for app/views/admin/products/add.php
            $this->view('admin/products/add', $data);
        }
    }

    // EDIT PRODUCT
    public function edit($id) {
        // 1. Get existing product data to check if it exists
        $product = $this->productModel->getProductById($id);
        if(!$product){
            redirect('products');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // IMAGE HANDLING LOGIC
            // Default to the old image
            $imageName = $product->image; 

            // If user uploaded a NEW image
            if(!empty($_FILES['image']['name'])){
                $imageName = time() . '_' . $_FILES['image']['name'];
                $target = "../public/assets/products/" . $imageName;
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                
                // Optional: Delete old image to save space
                if(file_exists("../public/assets/products/" . $product->image)){
                    unlink("../public/assets/products/" . $product->image);
                }
            }

            // Prepare Data
            $data = [
                'id' => $id,
                'category_id' => trim($_POST['category_id']),
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'mrp' => trim($_POST['mrp']),
                'selling_price' => trim($_POST['selling_price']),
                'unit_value' => trim($_POST['unit_value']),
                'unit_type' => trim($_POST['unit_type']),
                'stock_qty' => trim($_POST['stock_qty']),
                'image' => $imageName, // Uses new or old name
                'is_organic' => isset($_POST['is_organic']) ? 1 : 0,
                'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
                'status' => isset($_POST['status']) ? 1 : 0
            ];

            if ($this->productModel->updateProduct($data)) {
                redirect('products');
            } else {
                die('Something went wrong');
            }

        } else {
            // GET REQUEST: Load the View with Data
            $categories = $this->categoryModel->getCategories();
            
            $data = [
                'product' => $product,
                'categories' => $categories
            ];
            $this->view('admin/products/edit', $data);
        }
    }

    // DELETE PRODUCT
    public function delete($id) {
        // Get product to find image name
        $product = $this->productModel->getProductById($id);
        
        if($this->productModel->deleteProduct($id)){
            // Remove image file from server
            if(!empty($product->image) && file_exists("../public/assets/products/" . $product->image)){
                unlink("../public/assets/products/" . $product->image);
            }
            redirect('products');
        } else {
            die('Something went wrong');
        }
    }
}