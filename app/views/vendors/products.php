<?php require APPROOT . '/views/includes/vendor_header.php'; ?>

<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-tags text-primary"></i> My Inventory</h2>
    <a href="<?php echo URLROOT; ?>/vendors/addProduct" class="btn btn-success shadow-sm">
      <i class="fas fa-plus"></i> Add New Product
    </a>
  </div>

  <?php if (empty($data['products'])) : ?>
  <div class="card shadow-sm border-0 mt-4 text-center py-5">
    <div class="card-body">
      <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
      <h4 class="text-muted">Your inventory is currently empty.</h4>
      <p class="text-muted">Start adding products to your store to get sales!</p>
      <a href="<?php echo URLROOT; ?>/vendors/addProduct" class="btn btn-primary mt-2">Add Your First Product</a>
    </div>
  </div>
  <?php else : ?>
  <div class="card shadow-sm border-0">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Image</th>
              <th>Product Name</th>
              <th>Pricing (<?php echo CURRENCY; ?>)</th>
              <th>Unit Size</th>
              <th>Stock Left</th>
              <th>Status</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['products'] as $product) : ?>
            <tr>
              <td style="width: 80px;">
                <img src="<?php echo URLROOT; ?>/assets/products/<?php echo $product->image; ?>" alt="Product"
                  class="img-fluid rounded" style="max-height: 50px; object-fit: cover;">
              </td>

              <td class="fw-bold text-dark">
                <?php echo $product->name; ?>
              </td>

              <td>
                <span class="text-success fw-bold"><?php echo $product->selling_price; ?></span><br>
                <small class="text-muted text-decoration-line-through"><?php echo $product->mrp; ?></small>
              </td>

              <td>
                <?php echo $product->unit_value . ' ' . $product->unit_type; ?>
              </td>

              <td>
                <?php if ($product->stock_qty > 10) : ?>
                <span class="badge bg-success rounded-pill px-3"><?php echo $product->stock_qty; ?> in stock</span>
                <?php elseif ($product->stock_qty > 0) : ?>
                <span class="badge bg-warning text-dark rounded-pill px-3"><?php echo $product->stock_qty; ?> Low
                  Stock</span>
                <?php else : ?>
                <span class="badge bg-danger rounded-pill px-3">Out of Stock</span>
                <?php endif; ?>
              </td>

              <td>
                <?php if ($product->status == 1) : ?>
                <span class="badge bg-info">Active</span>
                <?php else : ?>
                <span class="badge bg-secondary">Draft</span>
                <?php endif; ?>
              </td>

              <td class="text-center">
                <a href="<?php echo URLROOT; ?>/vendors/editProduct/<?php echo $product->product_id; ?>"
                  class="btn btn-sm btn-outline-primary" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="<?php echo URLROOT; ?>/vendors/deleteProduct/<?php echo $product->product_id; ?>"
                  class="btn btn-sm btn-outline-danger"
                  onclick="return confirm('Are you sure you want to delete this item?');" title="Delete">
                  <i class="fas fa-trash-alt"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>

<?php require APPROOT . '/views/includes/vendor_footer.php'; ?>