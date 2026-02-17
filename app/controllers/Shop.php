<?php
class Shop extends Controller
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = $this->model('Product');
    }

    // 1. Show All Products (Default)
    public function index()
    {
        $categories = $this->productModel->getCategories();
        $products = $this->productModel->getShopProducts(); // Assumes getting all active products

        $data = [
            'title' => 'Shop All',
            'categories' => $categories,
            'products' => $products,
            'current_category' => null // No specific category selected
        ];

        $this->view('shop/index', $data);
    }

    // 2. Show Products by Category
    public function category($id)
    {
        $categories = $this->productModel->getCategories(); // Still need list for sidebar
        $products = $this->productModel->getProductsByCategory($id); // Filtered products
        $currentCategory = $this->productModel->getCategoryById($id); // Get banner/name info

        $data = [
            'title' => $currentCategory->name,
            'categories' => $categories,
            'products' => $products,
            'current_category' => $currentCategory // Pass specific category data
        ];

        $this->view('shop/index', $data);
    }
}