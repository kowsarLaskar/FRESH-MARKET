<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Fresh Market</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FBF9F1; }
        
        /* Sidebar Styling */
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
            color: rgba(255,255,255,0.8);
            padding: 15px 25px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
            text-decoration: none;
        }
        .nav-link i { width: 25px; }

        /* Main Content Area */
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
    </style>
</head>
<body>

   <?php require APPROOT . '/views/includes/admin_sidebar.php'; ?>
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold" style="color:#1F4D3C;">Products</h2>
            <a href="<?php echo URLROOT; ?>/products/add" class="btn btn-success">
                <i class="fas fa-plus-circle me-2"></i>Add New Product
            </a>
        </div>

        <div class="card border-0 shadow-sm p-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['products'])): ?>
                            <tr><td colspan="6" class="text-center py-4">No products found. Click "Add New" to create one!</td></tr>
                        <?php else: ?>
                            <?php foreach($data['products'] as $product): ?>
                            <tr>
                                <td>
                                    <?php if(!empty($product->image)): ?>
                                        <img src="<?php echo URLROOT; ?>/assets/products/<?php echo $product->image; ?>" width="50" height="50" style="object-fit:cover; border-radius:5px;">
                                    <?php else: ?>
                                        <span class="text-muted small">No Img</span>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-bold"><?php echo $product->name; ?></td>
                                <td><span class="badge bg-secondary"><?php echo $product->category_name; ?></span></td>
                                <td>
                                    <span class="text-decoration-line-through text-muted small">₹<?php echo $product->mrp; ?></span>
                                    <span class="fw-bold text-success">₹<?php echo $product->selling_price; ?></span>
                                </td>
                                <td>
                                    <?php if($product->stock_qty < 10): ?>
                                        <span class="text-danger fw-bold"><?php echo $product->stock_qty; ?> (Low)</span>
                                    <?php else: ?>
                                        <span class="text-dark"><?php echo $product->stock_qty; ?></span>
                                    <?php endif; ?>
                                </td>
                               <td>
    <a href="<?php echo URLROOT; ?>/products/edit/<?php echo $product->product_id; ?>" class="btn btn-sm btn-light border">
        <i class="fas fa-edit text-primary"></i>
    </a>
    <a href="<?php echo URLROOT; ?>/products/delete/<?php echo $product->product_id; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this product?');">
        <i class="fas fa-trash"></i>
    </a>
</td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>