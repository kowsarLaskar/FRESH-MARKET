<?php require APPROOT . '/views/includes/vendor_header.php'; ?>

<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plus-circle text-success"></i> Add New Product</h2>
    <a href="<?php echo URLROOT; ?>/vendors/products" class="btn btn-outline-secondary">
      <i class="fas fa-arrow-left"></i> Back to Inventory
    </a>
  </div>

  <div class="card shadow-sm border-0">
    <div class="card-body p-4">
      <form action="<?php echo URLROOT; ?>/vendors/addProduct" method="POST" enctype="multipart/form-data">

        <div class="row">
          <div class="col-md-8">
            <div class="form-group mb-3">
              <label for="name" class="form-label fw-bold">Product Name: <span class="text-danger">*</span></label>
              <input type="text" name="name" class="form-control form-control-lg bg-light"
                placeholder="e.g., Organic Gala Apples" required>
            </div>

            <div class="form-group mb-3">
              <label for="description" class="form-label fw-bold">Description:</label>
              <textarea name="description" class="form-control bg-light" rows="5"
                placeholder="Write a detailed description of your product..."></textarea>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group mb-3">
              <label for="category_id" class="form-label fw-bold">Category: <span class="text-danger">*</span></label>
              <select name="category_id" class="form-select form-select-lg bg-light" required>
                <option value="" disabled selected>Select a Category</option>
                <?php foreach ($data['categories'] as $category) : ?>
                  <option value="<?php echo $category->category_id; ?>"><?php echo $category->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group mb-3">
              <label for="mrp" class="form-label fw-bold">Original Price / MRP (<?php echo CURRENCY; ?>): <span
                  class="text-danger">*</span></label>
              <input type="number" step="0.01" name="mrp" class="form-control bg-light" required>
            </div>

            <div class="form-group mb-3">
              <label for="selling_price" class="form-label fw-bold">Your Selling Price (<?php echo CURRENCY; ?>): <span
                  class="text-danger">*</span></label>
              <input type="number" step="0.01" name="selling_price" class="form-control bg-light border-success"
                required>
            </div>
          </div>
        </div>

        <hr class="my-4">

        <div class="row">
          <div class="col-md-3 form-group mb-3">
            <label for="unit_value" class="form-label fw-bold">Unit Value: <span class="text-danger">*</span></label>
            <input type="text" name="unit_value" class="form-control bg-light" placeholder="e.g., 500" required>
          </div>

          <div class="col-md-3 form-group mb-3">
            <label for="unit_type" class="form-label fw-bold">Unit Type: <span class="text-danger">*</span></label>
            <select name="unit_type" class="form-select bg-light" required>
              <option value="kg">Kilogram (kg)</option>
              <option value="gm">Gram (gm)</option>
              <option value="L">Liter (L)</option>
              <option value="ml">Milliliter (ml)</option>
              <option value="pcs">Pieces (pcs)</option>
              <option value="packet">Packet</option>
            </select>
          </div>

          <div class="col-md-3 form-group mb-3">
            <label for="stock_qty" class="form-label fw-bold">Stock Quantity: <span class="text-danger">*</span></label>
            <input type="number" name="stock_qty" class="form-control bg-light" placeholder="How many do you have?"
              required>
          </div>

          <div class="col-md-3 form-group mb-4">
            <label for="image" class="form-label fw-bold">Product Image: <span class="text-danger">*</span></label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
          </div>
        </div>

        <div class="d-grid mt-3">
          <button type="submit" class="btn btn-success btn-lg">
            <i class="fas fa-save"></i> Publish Product
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/includes/vendor_footer.php'; ?>