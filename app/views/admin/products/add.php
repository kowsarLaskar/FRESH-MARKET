<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Fresh Market</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FBF9F1;
            margin: 0;
            padding: 0;
        }

        /* --- Sidebar Styling (Copied from index.php) --- */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #1F4D3C;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding-top: 20px;
            z-index: 1000;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            display: block;
            color: white;
            text-decoration: none;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 15px 25px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            text-decoration: none;
        }

        .nav-link i {
            width: 25px;
        }

        /* --- Main Content Area --- */
        .main-content {
            margin-left: 250px;
            /* Pushes content past the 250px sidebar */
            padding: 30px;
        }

        /* Form Specific Styling */
        .form-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: auto;
            /* Centers the card inside the main-content area */
        }
    </style>
</head>

<body>

    <?php require APPROOT . '/views/includes/admin_sidebar.php'; ?>

    <div class="main-content">
        <div class="form-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-success">Add New Product</h3>
                <a href="<?php echo URLROOT; ?>/products" class="btn btn-outline-secondary">Back to List</a>
            </div>

            <form action="<?php echo URLROOT; ?>/products/add" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category...</option>
                            <?php foreach ($data['categories'] as $cat): ?>
                                <option value="<?php echo $cat->category_id; ?>"><?php echo $cat->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">MRP (₹)</label>
                        <input type="number" step="0.01" name="mrp" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label text-success fw-bold">Selling Price (₹)</label>
                        <input type="number" step="0.01" name="selling_price" class="form-control" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Unit Value</label>
                        <input type="text" name="unit_value" class="form-control" placeholder="e.g. 1" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Unit Type</label>
                        <select name="unit_type" class="form-select">
                            <option value="kg">kg</option>
                            <option value="gm">gm</option>
                            <option value="pcs">pcs</option>
                            <option value="L">L</option>
                            <option value="ml">ml</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" name="stock_qty" class="form-control" value="100" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                </div>

                <div class="d-flex gap-4 mb-4 mt-2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_organic" id="organicCheck">
                        <label class="form-check-label" for="organicCheck">Is Organic?</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="featuredCheck">
                        <label class="form-check-label" for="featuredCheck">Show in "Featured"?</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2 fw-bold">Save Product</button>
            </form>
        </div>
    </div>

</body>

</html>