<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - Fresh Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #FBF9F1; padding: 30px; }
        .form-card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 800px; margin: auto; }
    </style>
</head>
<body>

<div class="container">
    <div class="form-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-success">Edit Product</h3>
            <a href="<?php echo URLROOT; ?>/products" class="btn btn-outline-secondary">Back</a>
        </div>

        <form action="<?php echo URLROOT; ?>/products/edit/<?php echo $data['product']->product_id; ?>" method="post" enctype="multipart/form-data">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $data['product']->name; ?>" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <?php foreach($data['categories'] as $cat): ?>
                            <option value="<?php echo $cat->category_id; ?>" 
                                <?php echo ($data['product']->category_id == $cat->category_id) ? 'selected' : ''; ?>>
                                <?php echo $cat->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"><?php echo $data['product']->description; ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">MRP</label>
                    <input type="number" step="0.01" name="mrp" class="form-control" value="<?php echo $data['product']->mrp; ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label text-success fw-bold">Selling Price</label>
                    <input type="number" step="0.01" name="selling_price" class="form-control" value="<?php echo $data['product']->selling_price; ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Unit Value</label>
                    <input type="text" name="unit_value" class="form-control" value="<?php echo $data['product']->unit_value; ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Unit Type</label>
                    <select name="unit_type" class="form-select">
                        <option value="kg" <?php echo ($data['product']->unit_type == 'kg') ? 'selected' : ''; ?>>kg</option>
                        <option value="gm" <?php echo ($data['product']->unit_type == 'gm') ? 'selected' : ''; ?>>gm</option>
                        <option value="pcs" <?php echo ($data['product']->unit_type == 'pcs') ? 'selected' : ''; ?>>pcs</option>
                        <option value="L" <?php echo ($data['product']->unit_type == 'L') ? 'selected' : ''; ?>>L</option>
                        <option value="ml" <?php echo ($data['product']->unit_type == 'ml') ? 'selected' : ''; ?>>ml</option>
                    </select>
                </div>
            </div>

            <div class="row align-items-end">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Stock Quantity</label>
                    <input type="number" name="stock_qty" class="form-control" value="<?php echo $data['product']->stock_qty; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Update Image (Leave empty to keep current)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="col-md-2 mb-3">
                    <?php if(!empty($data['product']->image)): ?>
                        <img src="<?php echo URLROOT; ?>/img/products/<?php echo $data['product']->image; ?>" width="60" class="rounded">
                    <?php endif; ?>
                </div>
            </div>

            <div class="d-flex gap-4 mb-4 mt-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_organic" id="organicCheck" 
                        <?php echo ($data['product']->is_organic) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="organicCheck">Is Organic?</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_featured" id="featuredCheck" 
                        <?php echo ($data['product']->is_featured) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="featuredCheck">Featured?</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="status" id="statusCheck" 
                        <?php echo ($data['product']->status) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="statusCheck">Active?</label>
                </div>
            </div>

            <button type="submit" class="btn btn-warning w-100 py-2 fw-bold text-dark">Update Product</button>
        </form>
    </div>
</div>

</body>
</html>