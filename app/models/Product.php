<?php
class Product
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getWeeklyDeals()
    {
        // Ensure you have a table named 'products' with these columns!
        $this->db->query("SELECT * FROM products WHERE status = 1 ORDER BY created_at DESC LIMIT 8");
        return $this->db->resultSet();
    }


    public function getGrabNGo()
    {
        // Get 4 random active products
        $this->db->query("SELECT * FROM products WHERE status = 1 ORDER BY RAND() LIMIT 4");
        return $this->db->resultSet();
    }


    public function getCategories()
    {
        $this->db->query("SELECT * FROM categories WHERE status = 1");
        return $this->db->resultSet();
    }

    // 2. Get all active products for the Shop Grid
    public function getShopProducts()
    {
        // We select all products that are active (status = 1)
        $this->db->query("SELECT * FROM products WHERE status = 1");
        return $this->db->resultSet();
    }

    // Find a single product by ID
    public function findProductById($id)
    {
        $this->db->query("SELECT * FROM products WHERE product_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get single category details (for the banner and title)
    public function getCategoryById($id)
    {
        $this->db->query("SELECT * FROM categories WHERE category_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get products specific to a category
    public function getProductsByCategory($id)
    {
        $this->db->query("SELECT * FROM products WHERE category_id = :id AND status = 1");
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }
    // Get a single product by its ID
    public function getProductById($id)
    {
        // Prepare SQL statement to find product by ID and ensure it's active (status=1)
        $this->db->query("SELECT * FROM products WHERE product_id = :id AND status = '1'");
        // Bind the ID parameter
        $this->db->bind(':id', $id);

        // Fetch a single row object
        $row = $this->db->single();

        // Check if row was found
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
    // NEW FUNCTION: Handles categories, max price, and sorting dynamically
    public function getFilteredProducts($categoryId = null, $maxPrice = null, $sortBy = 'relevance')
    {
        $sql = "SELECT * FROM products WHERE status = 1";
        $bindParams = [];

        if ($categoryId != null) {
            $sql .= " AND category_id = :category_id";
            $bindParams[':category_id'] = $categoryId;
        }

        if ($maxPrice != null && $maxPrice > 0) {
            $sql .= " AND selling_price <= :max_price";
            $bindParams[':max_price'] = $maxPrice;
        }

        switch ($sortBy) {
            case 'price_asc':
                $sql .= " ORDER BY selling_price ASC";
                break;
            case 'price_desc':
                $sql .= " ORDER BY selling_price DESC";
                break;
            case 'newest':
                $sql .= " ORDER BY created_at DESC";
                break;
            default:
                $sql .= " ORDER BY product_id DESC";
                break;
        }

        $this->db->query($sql);

        foreach ($bindParams as $param => $value) {
            $this->db->bind($param, $value);
        }

        return $this->db->resultSet();
    }
}
