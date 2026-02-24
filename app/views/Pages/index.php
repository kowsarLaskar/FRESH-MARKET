<?php require_once '../app/config/config.php'; ?>
<?php require_once '../app/views/includes/header.php'; ?>

<style>
  /* --- GENERAL STYLES --- */
  body {
    background-color: #FBF9F1;
  }

  /* --- BANNER & CATEGORY STYLES --- */
  .banner-container {
    width: 100%;
    margin-bottom: 30px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    mix-blend-mode: multiply;
  }

  .banner-img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
  }

  .category-card {
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    background: #fff;
    height: 100%;
  }

  .category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  }

  .category-img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
  }

  /* --- PRODUCT CARD STYLES (Amul Design) --- */
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

  /* --- HORIZONTAL SCROLL STYLES --- */
  .scrolling-wrapper {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    padding-bottom: 20px;
    scrollbar-width: none;
  }

  .scrolling-wrapper::-webkit-scrollbar {
    display: none;
  }

  .scrolling-card {
    flex: 0 0 auto;
    width: 220px;
    margin-right: 15px;
  }

  /* --- FEATURE CARD STYLES --- */
  .feature-card {
    border-radius: 16px;
    padding: 40px 30px;
    text-align: center;
    height: 100%;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid transparent;
  }

  .feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
  }

  .card-pickup {
    background-color: #F5EBE0;
    color: #5D4037;
  }

  .card-pickup .icon-circle {
    background-color: #D7CCC8;
    color: #5D4037;
  }

  .card-delivery {
    background-color: #D3E0EA;
    color: #00695C;
  }

  .card-delivery .icon-circle {
    background-color: #B4C6D4;
    color: #2C3E50;
  }

  .card-delivery .feature-title,
  .card-delivery p {
    color: #2C3E50;
  }

  .card-safety {
    background-color: #E6EAD6;
    color: #33691E;
  }

  .card-safety .icon-circle {
    background-color: #C9D6B8;
    color: #3E4E38;
  }

  .card-safety .feature-title,
  .card-safety p {
    color: #3E4E38;
  }

  .icon-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px auto;
    font-size: 2rem;
    transition: transform 0.3s ease;
  }

  .feature-card:hover .icon-circle {
    transform: scale(1.1) rotate(5deg);
  }

  .feature-title {
    font-weight: 700;
    font-size: 1.25rem;
    margin-bottom: 12px;
  }

  .feature-text {
    font-weight: 500;
    font-size: 0.95rem;
    line-height: 1.6;
    opacity: 0.85;
    margin-bottom: 0;
  }
</style>

<div class="container my-5">
  <div class="banner-container">
    <a href="<?php echo URLROOT; ?>/shop">
      <img
        src="https://cdn.grofers.com/cdn-cgi/image/f=auto,fit=scale-down,q=70,metadata=none,w=2700/layout-engine/2026-01/Frame-1437256605-2-2.jpg"
        alt="Fresh Market Banner" class="banner-img">
    </a>
  </div>

  <div class="row g-4 mb-5">
    <div class="col-md-4">
      <div class="category-card">
        <a href="<?php echo URLROOT; ?>/shop/category/10"><img
            src="https://cdn.grofers.com/cdn-cgi/image/f=auto,fit=scale-down,q=70,metadata=none,w=720/layout-engine/2023-07/pharmacy-WEB.jpg"
            alt="Pharmacy" class="category-img"></a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="category-card">
        <a href="<?php echo URLROOT; ?>/shop/category/12"><img
            src="https://cdn.grofers.com/cdn-cgi/image/f=auto,fit=scale-down,q=70,metadata=none,w=720/layout-engine/2026-01/pet_crystal_WEB-1.png"
            alt="Pet Supplies" class="category-img"></a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="category-card">
        <a href="<?php echo URLROOT; ?>/shop/category/11"><img
            src="https://cdn.grofers.com/cdn-cgi/image/f=auto,fit=scale-down,q=70,metadata=none,w=720/layout-engine/2026-01/baby_crystal_WEB-1.png"
            alt="Baby Care" class="category-img"></a>
      </div>
    </div>
  </div>
</div>

<div class="container py-4">
  <div class="mb-4">
    <h3 class="fw-bold" style="color: #1c1c1c;">Weekly Deals</h3>
    <p class="text-muted small">Save up to 50% on selected items.</p>
  </div>
  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">
    <?php if (!empty($data['deals'])): ?>
      <?php foreach ($data['deals'] as $product): ?>
        <div class="col">
          <?php include '../app/views/includes/product_card_template.php'; ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <p class="text-center">No deals available.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="container">
  <hr style="border-top: 1px solid #e0e0e0; margin: 30px 0;">
</div>

<div class="w-100 py-4" style="background-color: #FBF9F1;">
  <div class="container">
    <div class="mb-4">
      <h3 class="fw-bold" style="color: #1c1c1c;">Grab 'N Go</h3>
      <p class="text-muted small">Quick snacks and ready-to-eat items.</p>
    </div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">
      <?php if (!empty($data['grab_n_go'])): ?>
        <?php foreach ($data['grab_n_go'] as $product): ?>
          <div class="col">
            <?php include '../app/views/includes/product_card_template.php'; ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <p class="text-center w-100">No products available.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="container py-4 position-relative">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h3 class="fw-bold" style="color: #1c1c1c;">Bread & Grains</h3>
      <p class="text-muted small mb-0">Fresh bakery items.</p>
    </div>
    <div>
      <button class="btn btn-sm btn-outline-secondary rounded-circle me-1"
        onclick="scrollContainer('bread-scroll', -300)"><i class="fas fa-chevron-left"></i></button>
      <button class="btn btn-sm btn-outline-secondary rounded-circle" onclick="scrollContainer('bread-scroll', 300)"><i
          class="fas fa-chevron-right"></i></button>
    </div>
  </div>
  <div class="scrolling-wrapper" id="bread-scroll">
    <?php if (!empty($data['bread_grains'])): ?>
      <?php foreach ($data['bread_grains'] as $product): ?>
        <div class="scrolling-card">
          <?php include '../app/views/includes/product_card_template.php'; ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?><p class="text-muted ms-2">No products available.</p><?php endif; ?>
  </div>
</div>

<div class="w-100 py-4" style="background-color: #FBF9F1;">
  <div class="container position-relative">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <h3 class="fw-bold" style="color: #1c1c1c;">Dairy & Eggs</h3>
        <p class="text-muted small mb-0">Farm fresh milk, cheese, and eggs.</p>
      </div>
      <div>
        <button class="btn btn-sm btn-outline-secondary rounded-circle me-1"
          onclick="scrollContainer('dairy-scroll', -300)"><i class="fas fa-chevron-left"></i></button>
        <button class="btn btn-sm btn-outline-secondary rounded-circle"
          onclick="scrollContainer('dairy-scroll', 300)"><i class="fas fa-chevron-right"></i></button>
      </div>
    </div>
    <div class="scrolling-wrapper" id="dairy-scroll">
      <?php if (!empty($data['dairy_eggs'])): ?>
        <?php foreach ($data['dairy_eggs'] as $product): ?>
          <div class="scrolling-card">
            <?php include '../app/views/includes/product_card_template.php'; ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?><p class="text-muted ms-2">No products available.</p><?php endif; ?>
    </div>
  </div>
</div>

<div class="container py-4 position-relative">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h3 class="fw-bold" style="color: #1c1c1c;">Household Goods</h3>
      <p class="text-muted small mb-0">Essentials for your home.</p>
    </div>
    <div>
      <button class="btn btn-sm btn-outline-secondary rounded-circle me-1"
        onclick="scrollContainer('household-scroll', -300)"><i class="fas fa-chevron-left"></i></button>
      <button class="btn btn-sm btn-outline-secondary rounded-circle"
        onclick="scrollContainer('household-scroll', 300)"><i class="fas fa-chevron-right"></i></button>
    </div>
  </div>
  <div class="scrolling-wrapper" id="household-scroll">
    <?php if (!empty($data['household'])): ?>
      <?php foreach ($data['household'] as $product): ?>
        <div class="scrolling-card">
          <?php include '../app/views/includes/product_card_template.php'; ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?><p class="text-muted ms-2">No products available.</p><?php endif; ?>
  </div>
</div>

<div class="container py-5 mb-5">
  <div class="row g-4 justify-content-center">
    <div class="col-md-6 col-lg-4">
      <div class="feature-card card-pickup">
        <div class="icon-circle"><i class="fas fa-shopping-basket"></i></div>
        <h4 class="feature-title">Store Pickup</h4>
        <p class="feature-text">Order online and collect your fresh groceries curbside or in-store at your convenience.
        </p>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="feature-card card-delivery">
        <div class="icon-circle"><i class="fas fa-truck-fast"></i></div>
        <h4 class="feature-title">Express Delivery</h4>
        <p class="feature-text">Get your essentials delivered to your doorstep the very same day with our rapid fleet.
        </p>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="feature-card card-safety">
        <div class="icon-circle"><i class="fas fa-shield-heart"></i></div>
        <h4 class="feature-title">Hygiene Guaranteed</h4>
        <p class="feature-text">We follow strict handling and safety protocols to ensure your well-being with every
          order.</p>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  function scrollContainer(id, amount) {
    document.getElementById(id).scrollBy({
      left: amount,
      behavior: 'smooth'
    });
  }

  // AJAX ADD TO CART
  document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.add-cart-form-clean');
    forms.forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        const button = form.querySelector('button[type="submit"]');
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
            const desktopBadge = document.getElementById('cart-count');
            const mobileBadge = document.getElementById('mobile-cart-count');
            if (desktopBadge) desktopBadge.innerText = data.new_count;
            if (mobileBadge) mobileBadge.innerText = data.new_count;

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