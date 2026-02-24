<div class="product-card-clean h-100 position-relative">
  <a href="<?php echo URLROOT; ?>/shop/product/<?php echo $product->product_id; ?>" class="pc-img-wrap stretched-link">
    <img src="<?php echo URLROOT; ?>/assets/products/<?php echo $product->image; ?>"
      alt="<?php echo $product->name; ?>">
  </a>

  <div class="pc-time-badge"><i class="fas fa-clock me-1"></i> 15 MINS</div>

  <div class="pc-title" title="<?php echo $product->name; ?>">
    <?php echo $product->name; ?>
  </div>

  <div class="pc-unit">
    <?php echo isset($product->unit_value) ? $product->unit_value . ' ' . $product->unit_type : '1 Unit'; ?>
  </div>

  <div class="pc-footer">
    <div class="pc-price-box">
      <span class="pc-price"><?php echo CURRENCY . $product->selling_price; ?></span>
      <?php if ($product->mrp > $product->selling_price): ?>
        <span class="pc-old-price"><?php echo CURRENCY . $product->mrp; ?></span>
      <?php endif; ?>
    </div>

    <form action="<?php echo URLROOT; ?>/cart/add" method="POST" class="add-cart-form-clean" style="position: relative; z-index: 2;">
      <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
      <input type="hidden" name="qty" value="1">
      <button type="submit" class="btn-add-outline">ADD</button>
    </form>
  </div>
</div>