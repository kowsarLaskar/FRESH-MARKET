<?php require_once APPROOT . '/views/includes/header.php'; ?>

<style>
  /* --- PRODUCT GALLERY GRID --- */
  .product-gallery-container {
    position: sticky;
    top: 100px;
  }

  .main-image-frame {
    width: 100%;
    height: 450px;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
  }

  .main-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
  }

  .main-image:hover {
    transform: scale(1.05);
  }

  .thumb-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
  }

  .thumb-frame {
    height: 80px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    opacity: 0.6;
    transition: all 0.2s;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .thumb-frame:hover,
  .thumb-frame.active {
    opacity: 1;
    border-color: #1F4D3C;
    box-shadow: 0 0 0 2px rgba(31, 77, 60, 0.2);
  }

  .thumb-img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
  }

  /* --- INDIVIDUAL FEATURE CARDS --- */
  .features-grid-container {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 30px;
  }

  .feature-card {
    flex: 1;
    background: #fff;
    border-radius: 12px;
    padding: 15px 10px;
    text-align: center;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .feature-card:hover {
    border-color: #1F4D3C;
    box-shadow: 0 5px 15px rgba(31, 77, 60, 0.1);
    transform: translateY(-3px);
  }

  .feature-icon-box {
    width: 40px;
    height: 40px;
    background: #FBF9F1;
    color: #1F4D3C;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    margin-bottom: 10px;
    transition: background 0.3s, color 0.3s;
  }

  .feature-card:hover .feature-icon-box {
    background: #1F4D3C;
    color: #fff;
  }

  .feature-text {
    font-size: 0.75rem;
    font-weight: 600;
    color: #555;
    line-height: 1.3;
    text-transform: uppercase;
  }

  /* --- MINIMAL QUANTITY SELECTOR --- */
  .qty-minimal-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
  }

  .qty-btn-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: 1px solid #ced4da;
    background: #fff;
    color: #333;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
  }

  .qty-btn-circle:hover {
    border-color: #1F4D3C;
    color: #1F4D3C;
    background: #e8f5e9;
  }

  .qty-display-text {
    font-weight: 600;
    font-size: 1.1rem;
    width: 30px;
    text-align: center;
    border: none;
    background: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  /* --- ADD TO CART BUTTON --- */
  .btn-add-cart {
    background-color: #1F4D3C;
    color: white;
    font-weight: 600;
    padding: 12px 20px;
    border-radius: 8px;
    border: none;
    transition: all 0.3s ease;
    font-size: 1.1rem;
    width: 100%;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 10px rgba(31, 77, 60, 0.2);
  }

  .btn-add-cart:hover {
    background-color: #143629;
    box-shadow: 0 6px 15px rgba(31, 77, 60, 0.3);
    transform: translateY(-2px);
  }

  /* --- [NEW] PRODUCT CARD STYLES (Required for your template) --- */
  .product-card-clean {
    position: relative;
    /* Essential for stretched-link */
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px;
    background: #fff;
    transition: transform 0.2s, box-shadow 0.2s;
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .product-card-clean:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  /* This makes the image link cover the whole card */
  .stretched-link::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1;
    content: "";
  }

  /* Bring the form ABOVE the link so 'ADD' still works */
  .add-cart-form-clean {
    position: relative;
    z-index: 2;
  }

  .pc-img-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 180px;
    /* Adjust height as needed */
    overflow: hidden;
    margin-bottom: 10px;
  }

  .pc-img-wrap img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
  }

  .pc-time-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #f0f0f0;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 0.7rem;
    font-weight: 600;
    color: #555;
    z-index: 2;
  }

  .pc-title {
    font-weight: bold;
    color: #333;
    font-size: 0.95rem;
    margin-bottom: 4px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 2.8em;
  }

  .pc-unit {
    font-size: 0.8rem;
    color: #888;
    margin-bottom: 8px;
  }

  .pc-footer {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: auto;
  }

  .pc-price {
    font-weight: bold;
    color: #1c1c1c;
  }

  .pc-old-price {
    text-decoration: line-through;
    color: #999;
    font-size: 0.8rem;
    margin-left: 5px;
  }

  .btn-add-outline {
    border: 1px solid #1F4D3C;
    color: #1F4D3C;
    background: transparent;
    padding: 4px 12px;
    font-weight: bold;
    font-size: 0.85rem;
    border-radius: 4px;
    transition: all 0.2s;
  }

  .btn-add-outline:hover {
    background: #1F4D3C;
    color: #fff;
  }
</style>

<div class="container py-5">
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/shop" class="text-muted text-decoration-none">Shop</a>
      </li>
      <li class="breadcrumb-item active text-dark fw-bold" aria-current="page"><?php echo $data['product']->name; ?>
      </li>
    </ol>
  </nav>

  <div class="row gx-5">

    <div class="col-md-6 mb-5 mb-md-0">
      <div class="product-gallery-container">
        <div class="main-image-frame">
          <?php
          $imgFile = APPROOT . '/../public/assets/products/' . $data['product']->image;
          $imgSrc = (file_exists($imgFile) && !empty($data['product']->image))
            ? URLROOT . '/assets/products/' . $data['product']->image
            : 'https://via.placeholder.com/500?text=No+Image';
          ?>
          <img id="mainImage" src="<?php echo $imgSrc; ?>" class="main-image"
            alt="<?php echo $data['product']->name; ?>">
        </div>
        <div class="thumb-grid">
          <div class="thumb-frame active" onclick="changeImage(this, '<?php echo $imgSrc; ?>')">
            <img src="<?php echo $imgSrc; ?>" class="thumb-img">
          </div>
          <div class="thumb-frame" onclick="changeImage(this, '<?php echo $imgSrc; ?>')"><img
              src="<?php echo $imgSrc; ?>" class="thumb-img"></div>
          <div class="thumb-frame" onclick="changeImage(this, '<?php echo $imgSrc; ?>')"><img
              src="<?php echo $imgSrc; ?>" class="thumb-img"></div>
          <div class="thumb-frame" onclick="changeImage(this, '<?php echo $imgSrc; ?>')"><img
              src="<?php echo $imgSrc; ?>" class="thumb-img"></div>
        </div>
      </div>
    </div>

    <div class="col-md-6 d-flex flex-column">

      <h1 class="fw-bold mb-2" style="color: #1c1c1c;"><?php echo $data['product']->name; ?></h1>
      <div class="mb-3">
        <span class="badge bg-success"><i class="fas fa-star me-1"></i> 4.5</span>
        <span class="text-muted small ms-2">1,254 Ratings & reviews</span>
      </div>

      <div class="mb-4">
        <h2 class="d-inline fw-bold" style="color: #1c1c1c;">
          <?php echo CURRENCY . $data['product']->selling_price; ?>

          <span class="text-muted fs-5 fw-normal">
            /
            <?php
            // Unit Logic
            echo ($data['product']->unit_value > 1 ? $data['product']->unit_value . ' ' : '') . $data['product']->unit_type;
            ?>
          </span>
        </h2>

        <?php if ($data['product']->mrp > $data['product']->selling_price): ?>
          <span
            class="text-muted text-decoration-line-through fs-5 ms-2"><?php echo CURRENCY . $data['product']->mrp; ?></span>
          <?php $discount = round((($data['product']->mrp - $data['product']->selling_price) / $data['product']->mrp) * 100); ?>
          <span class="fw-bold text-success ms-2"><?php echo $discount; ?>% OFF</span>
        <?php endif; ?>

        <div class="text-muted small mt-1"><i class="fas fa-info-circle me-1" style="font-size: 0.8rem;"></i> Inclusive
          of all taxes</div>
      </div>

      <hr class="mb-4 mt-0" style="border-color: #e0e0e0;">

      <div class="mb-4">
        <h5 class="fw-bold" style="color:#1c1c1c;">Product Highlights</h5>
        <p class="text-muted" style="line-height: 1.6;">
          <?php echo nl2br($data['product']->description); ?>
        </p>
      </div>

      <div class="features-grid-container">
        <div class="feature-card">
          <div class="feature-icon-box"><i class="fas fa-leaf"></i></div>
          <div class="feature-text">Freshness<br>Guaranteed</div>
        </div>
        <div class="feature-card">
          <div class="feature-icon-box"><i class="fas fa-wallet"></i></div>
          <div class="feature-text">Cash on<br>Delivery</div>
        </div>
        <div class="feature-card">
          <div class="feature-icon-box"><i class="fas fa-shield-alt"></i></div>
          <div class="feature-text">Fresh Market<br>Assured</div>
        </div>
      </div>

      <div class="mt-auto">
        <form id="addToCartForm" action="<?php echo URLROOT; ?>/cart/add" method="POST">
          <input type="hidden" name="product_id" value="<?php echo $data['product']->product_id; ?>">

          <div class="row align-items-center g-3">
            <div class="col-auto">
              <div class="qty-minimal-container">
                <button type="button" class="qty-btn-circle" onclick="updateQty(-1)">-</button>
                <input type="number" id="qtyDisplay" name="qty" value="1" min="1" class="qty-display-text" readonly>
                <button type="button" class="qty-btn-circle" onclick="updateQty(1)">+</button>
              </div>
            </div>
            <div class="col">
              <button type="submit" id="btnSubmit" class="btn-add-cart">
                <i class="fas fa-shopping-basket me-2"></i> Add to Cart
              </button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>

  <div class="mt-5 pt-4 border-top">
    <h4 class="fw-bold mb-4" style="color: #1c1c1c;">Similar Products</h4>

    <?php if (!empty($data['similar_products'])): ?>
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">

        <?php foreach ($data['similar_products'] as $simProduct): ?>
          <div class="col">

            <div class="product-card-clean h-100 position-relative">

              <a href="<?php echo URLROOT; ?>/shop/product/<?php echo $simProduct->product_id; ?>"
                class="pc-img-wrap stretched-link">
                <img src="<?php echo URLROOT; ?>/assets/products/<?php echo $simProduct->image; ?>"
                  alt="<?php echo $simProduct->name; ?>">
              </a>

              <div class="pc-time-badge"><i class="fas fa-clock me-1"></i> 15 MINS</div>

              <div class="pc-title" title="<?php echo $simProduct->name; ?>">
                <?php echo $simProduct->name; ?>
              </div>

              <div class="pc-unit">
                <?php echo isset($simProduct->unit_value) ? $simProduct->unit_value . ' ' . $simProduct->unit_type : '1 Unit'; ?>
              </div>

              <div class="pc-footer">
                <div class="pc-price-box">
                  <span class="pc-price"><?php echo CURRENCY . $simProduct->selling_price; ?></span>
                  <?php if ($simProduct->mrp > $simProduct->selling_price): ?>
                    <span class="pc-old-price"><?php echo CURRENCY . $simProduct->mrp; ?></span>
                  <?php endif; ?>
                </div>

                <form action="<?php echo URLROOT; ?>/cart/add" method="POST" class="add-cart-form-clean"
                  style="position: relative; z-index: 2;">
                  <input type="hidden" name="product_id" value="<?php echo $simProduct->product_id; ?>">
                  <input type="hidden" name="qty" value="1">
                  <button type="submit" class="btn-add-outline">ADD</button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    <?php else: ?>
      <p class="text-muted">No similar products found.</p>
    <?php endif; ?>
  </div>
</div>

<script>
  // 1. Quantity Logic
  function updateQty(change) {
    const qtyInput = document.getElementById('qtyDisplay');
    let currentQty = parseInt(qtyInput.value);
    let newQty = currentQty + change;
    if (newQty < 1) newQty = 1;
    qtyInput.value = newQty;
  }

  // 2. Image Gallery Logic
  function changeImage(element, src) {
    document.getElementById('mainImage').src = src;
    const thumbs = document.querySelectorAll('.thumb-frame');
    thumbs.forEach(thumb => thumb.classList.remove('active'));
    element.classList.add('active');
  }

  // 3. AJAX ADD TO CART LOGIC
  document.getElementById('addToCartForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const button = document.getElementById('btnSubmit');

    // Show Loading
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
    button.disabled = true;
    button.style.opacity = "0.7";

    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json())
      .then(data => {
        // Update Header Cart Count
        const cartCountEl = document.getElementById('cart-count');
        if (cartCountEl) cartCountEl.innerText = data.new_count;

        // Change Button to "Go to Cart"
        const goToCartBtn = document.createElement('a');
        goToCartBtn.href = "<?php echo URLROOT; ?>/cart"; // Link to cart page
        goToCartBtn.className = "btn-add-cart"; // Keep same style class

        goToCartBtn.style.backgroundColor = "#1F4D3C";
        goToCartBtn.style.textAlign = "center";
        goToCartBtn.style.display = "block";
        goToCartBtn.style.textDecoration = "none";
        goToCartBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i> Go to Cart';

        button.replaceWith(goToCartBtn);
      })
      .catch(error => {
        console.error('Error:', error);
        button.innerHTML = 'Error';
        button.disabled = false;
      });
  });
</script>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>