<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - Fresh Market</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FBF9F1; }
        
        /* Sidebar Styling (Same as Dashboard) */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #1F4D3C;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding-top: 20px;
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
        <h2 class="fw-bold mb-4" style="color:#1F4D3C;">Manage Categories</h2>

        <div class="row">
            
            <div class="col-md-8">
                <div class="card border-0 shadow-sm p-3">
                    <h5 class="mb-3">Existing Categories</h5>
                    
                    <?php if(empty($data['categories'])): ?>
                        <div class="alert alert-info">No categories found. Add one!</div>
                    <?php else: ?>
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['categories'] as $cat): ?>
                                <tr>
                                    <td class="fw-bold"><?php echo $cat->name; ?></td>
                                    <td class="text-muted small"><?php echo $cat->description; ?></td>
                                    <td>
                                        <a href="<?php echo URLROOT; ?>/categories/delete/<?php echo $cat->category_id; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4" style="background-color: #e8f5e9;">
                    <h5 class="mb-3 text-success"><i class="fas fa-plus-circle me-2"></i>Add New</h5>
                    
                    <form action="<?php echo URLROOT; ?>/categories/add" method="post">
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Fruits" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Short description..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Create Category</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</body>
</html>