<?php
class Categories extends Controller
{
    private $categoryModel;
    public function __construct()
    {
        // 1. Security: Only Admins can manage categories
        if (!isLoggedIn() || $_SESSION['user_role'] != 'admin') {
            redirect('users/login');
        }

        $this->categoryModel = $this->model('Category');
    }

    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        $data = [
            'categories' => $categories
        ];
        $this->view('admin/categories', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // 1. Sanitize
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // 2. Default Image Name
            $imageName = 'default_cat.jpg';

            // 3. Handle Image Upload
            if (!empty($_FILES['image']['name'])) {
                $fileName = $_FILES['image']['name'];
                $fileTmp  = $_FILES['image']['tmp_name'];

                // Create unique name to prevent overwriting: e.g., 1708934_apple.jpg
                $imageName = time() . '_' . $fileName;

                // Define upload path (Ensure this folder exists!)
                $uploadPath = 'assets/products/' . $imageName; // <--- FIXED PATH
                // Move the file
                move_uploaded_file($fileTmp, $uploadPath);
            }

            // 4. Prepare Data
            $data = [
                'name'        => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'image'       => $imageName,
                'status'      => trim($_POST['status'])
            ];

            // 5. Validation & Insert
            if (empty($data['name'])) {
                die('Please enter a category name');
            }

            if ($this->categoryModel->addCategory($data)) {
                redirect('categories');
            } else {
                die('Something went wrong');
            }
        } else {
            // If they try to access /add directly without POST
            redirect('categories');
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // 1. Get existing category first (to retrieve the old image name)
            $existingCategory = $this->categoryModel->getCategoryById($id);

            // Default to the old image
            $imageToSave = $existingCategory->image;

            // 2. Check if a NEW image was uploaded
            if (!empty($_FILES['image']['name'])) {
                $imgName = $_FILES['image']['name'];
                $imgTmp  = $_FILES['image']['tmp_name'];


                $uploadPath = 'assets/products/' . $imgName; // <--- FIXED PATH

                // Upload file
                move_uploaded_file($imgTmp, $uploadPath);

                // Update variable to the new name
                $imageToSave = $imgName;
            }

            // 3. Prepare Data
            $data = [
                'category_id' => $id,
                'name'        => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'status'      => trim($_POST['status']),
                'image'       => $imageToSave // Pass the image name
            ];

            // 4. Update Database
            if ($this->categoryModel->updateCategory($data)) {
                redirect('categories');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('categories');
        }
    }

    public function delete($id)
    {
        if ($this->categoryModel->deleteCategory($id)) {
            redirect('categories');
        } else {
            die('Something went wrong');
        }
    }
}