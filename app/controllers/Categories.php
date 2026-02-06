<?php
class Categories extends Controller {
    private $categoryModel;
    public function __construct() {
        // 1. Security: Only Admins can manage categories
        if (!isLoggedIn() || $_SESSION['user_role'] != 'admin') {
            redirect('users/login');
        }

        $this->categoryModel = $this->model('Category');
    }

    public function index() {
        $categories = $this->categoryModel->getCategories();
        $data = [
            'categories' => $categories
        ];
        $this->view('admin/categories', $data);
    }

    public function add() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description'])
            ];

            if(!empty($data['name'])) {
                if($this->categoryModel->addCategory($data)) {
                    redirect('categories');
                } else {
                    die('Something went wrong');
                }
            }
        }
    }

    public function delete($id) {
        if($this->categoryModel->deleteCategory($id)) {
            redirect('categories');
        } else {
            die('Something went wrong');
        }
    }
}