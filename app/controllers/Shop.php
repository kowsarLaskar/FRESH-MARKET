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

    // This method handles URLs like /shop/product/5
    public function product($id = null)
    {
        if ($id == null) redirect('shop');

        // 1. Fetch current product
        $product = $this->productModel->getProductById($id);

        if (!$product) redirect('shop');

        // 2. Fetch Similar Products (Same Category, Exclude Current ID)
        // You might need to add a 'limit' to your model method if you only want 4 items
        // For now, let's assume getProductsByCategory takes an optional limit or we slice it here
        $similarProducts = $this->productModel->getProductsByCategory($product->category_id);

        // Filter out the current product from the list
        $similarProducts = array_filter($similarProducts, function ($p) use ($id) {
            return $p->product_id != $id;
        });

        // Limit to 4 items for the display
        $similarProducts = array_slice($similarProducts, 0, 5);

        $data = [
            'title' => $product->name,
            'product' => $product,
            'similar_products' => $similarProducts // Pass this to the view
        ];

        $this->view('shop/product_display', $data);
    }
}
