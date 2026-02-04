<?php
class Pages extends Controller {
    private $productModel;

    public function __construct() {
        // Load the Product Model to get access to database methods
        $this->productModel = $this->model('Product');
    }

    public function index() {
    // 1. Get Weekly Deals
    $deals = $this->productModel->getWeeklyDeals();
    
    // 2. NEW: Get Grab 'N Go Products
    $grabNGo = $this->productModel->getGrabNGo();

    // 3. Pass both to the view
    $data = [
        'title' => 'Welcome',
        'deals' => $deals,
        'grab_n_go' => $grabNGo // <--- Added this
    ];

    $this->view('pages/index', $data);
}


}