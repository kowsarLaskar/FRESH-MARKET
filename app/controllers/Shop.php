<?php
class Shop extends Controller {
    private $productModel;

    public function __construct() {
        // 1. Load the Product Model so we can use database functions
        $this->productModel = $this->model('Product');
    }

    public function index() {
        // 2. Fetch Real Data from the Database
        $categories = $this->productModel->getCategories();
        $products = $this->productModel->getShopProducts();

        // 3. Prepare the Data Array
        $data = [
            'title' => 'Shop All',
            'categories' => $categories, // Real categories for Sidebar
            'products' => $products      // Real products for Grid
        ];

        // 4. Load the View
        $this->view('shop/index', $data);
    }
}