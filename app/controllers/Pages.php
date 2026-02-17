<?php
class Pages extends Controller
{
    private $productModel;

    public function __construct()
    {
        // Load the Product Model to get access to database methods
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        // Fetch specific categories by their ID
        $deals = $this->productModel->getProductsByCategory(7);       // Weekly Deals
        $grabNGo = $this->productModel->getProductsByCategory(4);     // Grab 'N Go
        $breadGrains = $this->productModel->getProductsByCategory(2); // Bread & Grains
        $dairyEggs = $this->productModel->getProductsByCategory(3);   // Dairy & Eggs
        $household = $this->productModel->getProductsByCategory(5);   // Household Goods

        $data = [
            'title' => 'Fresh Market',
            'deals' => $deals,
            'grab_n_go' => $grabNGo,
            'bread_grains' => $breadGrains,
            'dairy_eggs' => $dairyEggs,
            'household' => $household
        ];

        $this->view('pages/index', $data);
    }
}