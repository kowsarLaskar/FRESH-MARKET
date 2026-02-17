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
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FBF9F1;
        }

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

                    <?php if (empty($data['categories'])): ?>
                        <div class="alert alert-info">No categories found. Add one!</div>
                    <?php else: ?>
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['categories'] as $cat): ?>
                                    <tr>
                                        <td class="fw-bold"><?php echo $cat->name; ?></td>
                                        <td class="text-muted small"><?php echo $cat->description; ?></td>
                                        <td>
                                            <?php if ($cat->status == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Hidden</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1" onclick="openEditModal('<?php echo $cat->category_id; ?>', 
                               '<?php echo addslashes($cat->name); ?>', 
                               '<?php echo addslashes($cat->description); ?>', 
                               '<?php echo $cat->status; ?>',
                               '<?php echo $cat->image; ?>')"> <i class="fas fa-edit"></i>
                                            </button>

                                            <a href="<?php echo URLROOT; ?>/categories/delete/<?php echo $cat->category_id; ?>"
                                                class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?');">
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

                    <form action="<?php echo URLROOT; ?>/categories/add" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Fruits" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Short description..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category Image</label>
                            <input type="file" name="image" class="form-control" required>
                            <small class="text-muted" style="font-size: 0.75rem;">Format: JPG, PNG</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Hidden</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Create Category</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title fw-bold">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Update Image</label>
                            <input type="file" name="image" class="form-control">
                            <div class="form-text text-muted">
                                Current: <span id="current_image_name" class="fw-bold text-dark"></span>
                                <br>(Leave empty to keep current image)
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" id="edit_status" class="form-select">
                                <option value="1">Active (Visible)</option>
                                <option value="0">Hidden</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Javascript function to fill the modal
        function openEditModal(id, name, description, status, image) {
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_status').value = status;

            // Show the current image name so user knows what is there
            document.getElementById('current_image_name').innerText = image;

            var form = document.getElementById('editForm');
            form.action = "<?php echo URLROOT; ?>/categories/edit/" + id;

            var myModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
            myModal.show();
        }
    </script>

</body>

</html>