<?php require_once '../app/views/includes/header.php'; ?>

<style>
  body {
    background-color: #FBF9F1;
  }

  /* --- STICKY SIDEBAR --- */
  .sticky-sidebar {
    position: -webkit-sticky;
    /* For Safari */
    position: sticky;
    top: 100px;
    /* Adjust based on your navbar height */
    height: fit-content;
    z-index: 100;
    padding-right: 20px;
  }

  .sidebar-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 1.1rem;
    color: #1F4D3C;
    border-bottom: 2px solid #e0e0e0;
    padding-bottom: 10px;
    margin-bottom: 20px;
  }

  .cat-link {
    display: block;
    color: #555;
    font-weight: 400;
    text-decoration: none;
    padding: 8px 10px;
    font-size: 0.95rem;
    transition: all 0.2s;
    border-radius: 5px;
  }

  .cat-link:hover {
    background-color: #e8f5e9;
    color: #1F4D3C;
  }

  .cat-link.active {
    background-color: #1F4D3C;
    color: white;
    font-weight: 600;
  }

  /* --- BANNER STYLES --- */
  .shop-banner-container {
    width: 100%;
    height: 300px;
    background-color: #e0e0e0;
    margin-bottom: 30px;
    overflow: hidden;
    border-radius: 12px;
    position: relative;
  }

  .shop-banner-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
  }

  .shop-banner-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
    padding: 20px;
    color: white;
  }

  /* --- PRODUCT CARD (AMUL STYLE) --- */
  .product-card-clean {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    padding: 10px;
    text-align: left;
    position: relative;
    height: 100%;
    transition: box-shadow 0.2s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .product-card-clean:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border-color: transparent;
  }

  .pc-img-wrap {
    height: 130px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    overflow: hidden;
  }

  .pc-img-wrap img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
    transition: transform 0.3s;
  }

  .product-card-clean:hover .pc-img-wrap img {
    transform: scale(1.05);
  }

  .pc-time-badge {
    background: #F1F4F6;
    color: #333;
    font-size: 0.6rem;
    font-weight: 700;
    padding: 2px 6px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    width: fit-content;
    margin-bottom: 8px;
  }

  .pc-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #1c1c1c;
    margin-bottom: 4px;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 2.6em;
  }

  .pc-unit {
    color: #888;
    font-size: 0.8rem;
    margin-bottom: 10px;
  }

  .pc-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
  }

  .pc-price-box {
    display: flex;
    flex-direction: column;
  }

  .pc-price {
    font-size: 0.9rem;
    font-weight: 600;
    color: #1c1c1c;
  }

  .pc-old-price {
    font-size: 0.75rem;
    text-decoration: line-through;
    color: #999;
  }

  .btn-add-outline {
    background-color: #fff;
    color: #2A6049;
    border: 1px solid #2A6049;
    padding: 5px 18px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-add-outline:hover {
    background-color: #2A6049;
    color: #fff;
  }

  .btn-go-cart {
    background-color: #2A6049 !important;
    color: #fff !important;
    border: 1px solid #2A6049 !important;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    padding: 5px 10px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.75rem;
    width: 100%;
    white-space: nowrap;
  }

  /* Price Slider */
  .price-slider {
    -webkit-appearance: none;
    width: 100%;
    background: transparent;
  }

  .price-slider::-webkit-slider-runnable-track {
    width: 100%;
    height: 4px;
    background: #ccc;
    border-radius: 2px;
  }

  .price-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    background: #1F4D3C;
    margin-top: -6px;
    cursor: pointer;
  }
</style>

<div class="container py-2">

  <div class="mb-2 breadcrumb small text-muted">
    <a href="<?php echo URLROOT; ?>" class="text-decoration-none text-muted">Home</a>
    <span class="mx-2">&gt;</span>
    <span class="fw-bold text-dark">Shop</span>
  </div>

  <div class="row">

    <div class="col-lg-3 d-none d-lg-block">
      <div class="sticky-sidebar">
        <div class="mb-5">
          <h3 class="sidebar-title">Categories</h3>
          <nav>
            <a href="<?php echo URLROOT; ?>/shop"
              class="cat-link <?php echo (!isset($data['current_category'])) ? 'active' : ''; ?>">
              All Products
            </a>

            <?php if (!empty($data['categories'])): ?>
              <?php foreach ($data['categories'] as $cat): ?>
                <a href="<?php echo URLROOT; ?>/shop/category/<?php echo $cat->category_id; ?>"
                  class="cat-link <?php echo (isset($data['current_category']) && $data['current_category']->category_id == $cat->category_id) ? 'active' : ''; ?>">
                  <?php echo $cat->name; ?>
                </a>
              <?php endforeach; ?>
            <?php endif; ?>
          </nav>
        </div>

        <div class="mb-5">
          <h3 class="sidebar-title">Filter by Price</h3>
          <input type="range" class="form-range price-slider" min="0" max="1000" id="priceRange">
          <div class="d-flex justify-content-between mt-2 small fw-bold text-muted">
            <span>₹0</span>
            <span>₹1000+</span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-9">

      <div class="shop-banner-container">
        <?php
        // 1. Define your Default Local Image
        // This is used for "All Products" OR if a category has no image.
        $defaultBanner = URLROOT . '/assets/products/shop_banner.jpg';

        // 2. Check if we are on a specific Category Page
        if (isset($data['current_category'])) {

          // We are on a specific Category Page -> Use Category Name & Desc
          $bannerTitle = $data['current_category']->name;
          $bannerDesc = $data['current_category']->description;

          // Check if THIS category has a custom image uploaded
          if (!empty($data['current_category']->image)) {
            $bannerImg = URLROOT . '/assets/products/' . $data['current_category']->image;
          } else {
            // Category exists, but has NO image -> Use Default
            $bannerImg = $defaultBanner;
          }
        } else {
          // We are on the "All Products" (Shop Home) Page
          $bannerTitle = "All Products";
          $bannerDesc = "Explore our wide selection of fresh produce and essentials.";
          $bannerImg = $defaultBanner;
        }
        ?>

        <img src="<?php echo $bannerImg; ?>" alt="Category Banner" class="shop-banner-img">

        <div class="shop-banner-overlay">
          <h1 class="fw-bold mb-1"><?php echo $bannerTitle; ?></h1>
          <p class="mb-0 opacity-75"><?php echo $bannerDesc; ?></p>
        </div>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <span class="text-muted small fw-bold"><?php echo count($data['products']); ?> Items found</span>
        <div class="dropdown">
          <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            Sort by: Relevance
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
            <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
            <li><a class="dropdown-item" href="#">Newest First</a></li>
          </ul>
        </div>
      </div>

      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">

        <?php if (!empty($data['products'])): ?>
          <?php foreach ($data['products'] as $product): ?>
            <div class="col">
              <?php require '../app/views/includes/product_card_template.php'; ?>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="col-12 text-center py-5">
            <h4 class="text-muted">No products found in this category.</h4>
            <a href="<?php echo URLROOT; ?>/shop" class="btn btn-primary mt-3">View All Products</a>
          </div>
        <?php endif; ?>

      </div>

      <div class="d-flex justify-content-center mt-5">
        <nav>
          <ul class="pagination pagination-sm">
            <li class="page-item disabled"><a class="page-link border-0" href="#">&lt;</a></li>
            <li class="page-item active"><a class="page-link border-0 bg-success" href="#">1</a></li>
            <li class="page-item"><a class="page-link border-0 text-dark" href="#">2</a></li>
            <li class="page-item"><a class="page-link border-0 text-dark" href="#">&gt;</a></li>
          </ul>
        </nav>
      </div>

    </div>
  </div>
</div>

<script>
  // AJAX Add to Cart Logic
  document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.add-cart-form-clean');

    forms.forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        const button = form.querySelector('button[type="submit"]');

        // Loading State
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        button.disabled = true;
        button.style.borderColor = "#ccc";
        button.style.color = "#ccc";

        const headers = {
          'X-Requested-With': 'XMLHttpRequest'
        };
        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            headers: headers,
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            // Update Header Cart Counts
            const desktopBadge = document.getElementById('cart-count');
            const mobileBadge = document.getElementById('mobile-cart-count');
            if (desktopBadge) desktopBadge.innerText = data.new_count;
            if (mobileBadge) mobileBadge.innerText = data.new_count;

            // Change Button to "GO TO CART"
            const cartLink = document.createElement('a');
            cartLink.href = "<?php echo URLROOT; ?>/cart";
            cartLink.className = "btn-go-cart";
            cartLink.innerHTML = "GO TO CART";
            button.replaceWith(cartLink);
          })
          .catch(error => {
            console.error('Error:', error);
            button.innerHTML = "ADD";
            button.disabled = false;
            button.style.borderColor = "";
            button.style.color = "";
          });
      });
    });
  });
</script>

<?php require_once '../app/views/includes/footer.php'; ?>