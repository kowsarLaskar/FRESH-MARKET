<?php
require_once '../app/config/config.php';
require_once '../app/views/includes/header.php';
?>

<style>
    /* Hero Styles */
    .hero-caption {
        position: absolute; top: 50%; left: 6%; transform: translateY(-50%);
        max-width: 550px; z-index: 2; text-align: left;
    }
    .hero-subtitle {
        color: #2A6049; font-weight: 700; font-size: 0.9rem; text-transform: uppercase;
        letter-spacing: 2px; margin-bottom: 10px; display: block;
        background: rgba(255, 255, 255, 0.8); display: inline-block; padding: 2px 8px; border-radius: 4px;
    }
    .hero-title {
        font-size: 3rem; font-weight: 400; color: #1F4D3C; line-height: 1.1;
        margin-bottom: 25px; text-shadow: 2px 2px 0px #ffffff;
    }
    .btn-hero {
        background-color: #5ba534; color: white; padding: 12px 35px;
        font-weight: 600; text-transform: uppercase; letter-spacing: 1px;
        border: none; text-decoration: none; transition: background 0.3s;
    }
    .btn-hero:hover { background-color: #4a8a2a; color: white; }
    .hero-img { width: 100%; height: 500px; object-fit: cover; object-position: center; }
    @media (max-width: 768px) {
        .hero-title { font-size: 2rem; }
        .hero-img { height: 350px; }
    }
</style>

<div class="container my-5"> <div id="heroCarousel" class="carousel slide overflow-hidden shadow" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo URLROOT; ?>/assets/hero_images/hero_img_01.jpg" class="d-block hero-img" alt="Healthy Lunch">
                <div class="hero-caption">
                    <span class="hero-subtitle">FRESH MARKET</span>
                    <h1 class="hero-title">WE'LL DELIVER<br>EVERYTHING<br>YOU NEED</h1>
                    <a href="<?php echo URLROOT; ?>/shop" class="btn-hero">SHOP ONLINE</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo URLROOT; ?>/assets/hero_images/hero_image_02.jpg" class="d-block hero-img" alt="Daily Groceries">
            </div>
            <div class="carousel-item">
                <img src="<?php echo URLROOT; ?>/assets/hero_images/hero_img_03.jpg" class="d-block hero-img" alt="Fresh Fruits">
            </div>
            <div class="carousel-item">
                <img src="<?php echo URLROOT; ?>/assets/hero_images/hero_img_04.jpg" class="d-block hero-img" alt="Always Fresh">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    @import url('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');

    .product-card { border: none; background: #fff; padding: 10px; transition: transform 0.2s; }
    .badge-special {
        background-color: #2A6049; color: white; font-size: 0.8rem;
        padding: 4px 12px; position: absolute; top: 0; left: 0; z-index: 10; border-radius: 0;
    }
    .product-img-wrapper {
        height: 180px; display: flex; align-items: center; justify-content: center;
        overflow: hidden; margin-bottom: 15px;
    }
    .product-img-wrapper img { max-height: 100%; max-width: 100%; object-fit: contain; }
    .product-title { font-size: 1rem; color: #333; font-weight: 400; margin-bottom: 5px; }
    .price-wrap { font-size: 1rem; margin-bottom: 15px; }
    .old-price { text-decoration: line-through; color: #999; margin-right: 8px; font-size: 0.9rem; }
    .new-price { color: #333; font-weight: 600; }
    
    .qty-input-group { border: 1px solid #ddd; display: flex; width: 100%; height: 35px; }
    .qty-btn { background: white; border: none; width: 30px; font-size: 1.2rem; color: #333; cursor: pointer; }
    .qty-btn:hover { background-color: #f8f9fa; }
    .qty-value { border: none; text-align: center; width: 100%; font-size: 0.9rem; -moz-appearance: textfield; }

    .owl-prev, .owl-next {
        position: absolute; top: 40%; transform: translateY(-50%);
        font-size: 3rem !important; color: #333 !important; opacity: 0.5; transition: opacity 0.3s;
    }
    .owl-prev:hover, .owl-next:hover { opacity: 1; }
    .owl-prev { left: -40px; }
    .owl-next { right: -40px; }

    .btn-add-cart {
        background-color: #2A6049;
        color: white;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        border: none;
        padding: 8px 0;
        width: 100%;
        margin-top: 10px;
        transition: all 0.3s ease;
    }
    .btn-add-cart:hover {
        background-color: #000000;
        color: white;
        text-decoration: underline;
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #2A6049;">Weekly Deals</h2>
        <p class="text-muted">Discover our best offers of the week!. You can save up to 50% on selected items.</p>
    </div>
    
    <div class="owl-carousel owl-theme" id="weeklyDealsSlider">
        <?php if(!empty($data['deals'])): ?>
            <?php foreach($data['deals'] as $product): ?>
            <div class="item">
                <div class="product-card position-relative text-center">
                    <form action="<?php echo URLROOT; ?>/cart/add" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
                        <div class="badge-special">Special Price</div>
                        <a href="<?php echo URLROOT; ?>/shop/product/<?php echo $product->product_id; ?>" class="product-img-wrapper">
                            <img src="<?php echo URLROOT; ?>/assets/products/<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>">
                        </a>
                        <h5 class="product-title"><?php echo $product->name; ?></h5>
                        <div class="price-wrap">
                            <span class="old-price"><?php echo CURRENCY . $product->mrp; ?></span>
                            <span class="new-price"><?php echo CURRENCY . $product->selling_price; ?></span>
                        </div>
                        <div class="qty-input-group">
                            <button class="qty-btn" type="button" onclick="decreaseQty(this)">-</button>
                            <input type="number" name="qty" class="qty-value" value="1" min="1" readonly>
                            <button class="qty-btn" type="button" onclick="increaseQty(this)">+</button>
                        </div>
                        <button type="submit" class="btn-add-cart">ADD TO CART</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No weekly deals available at the moment.</p>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <hr style="border-top: 1px solid #aaa; opacity: 0.5; margin: 40px 0;">
</div>


<style>
    .grab-go-img-wrapper {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    .grab-go-img-wrapper:hover { transform: scale(1.05); }
    .grab-go-img { max-height: 100%; max-width: 100%; object-fit: contain; }
</style>

<div class="w-100 py-5" style="background-color: #ffffff;"> 
    <div class="container">
        
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #2A6049;">Grab 'N Go</h2>
            <p class="text-muted">Grab all your favorite items in one convenient place.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <?php if(!empty($data['grab_n_go'])): ?>
                <?php foreach($data['grab_n_go'] as $product): ?>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="product-card position-relative text-center ">
                        <form action="<?php echo URLROOT; ?>/cart/add" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
                            <a href="<?php echo URLROOT; ?>/shop/product/<?php echo $product->product_id; ?>" class="product-img-wrapper">
                                <img src="<?php echo URLROOT; ?>/assets/products/<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>">
                            </a>
                            <h5 class="product-title"><?php echo $product->name; ?></h5>
                            <div class="price-wrap">
                                <span class="new-price"><?php echo CURRENCY . $product->selling_price; ?></span>
                            </div>
                            <div class="qty-input-group">
                                <button class="qty-btn" type="button" onclick="decreaseQty(this)">-</button>
                                <input type="number" name="qty" class="qty-value" value="1" min="1" readonly>
                                <button class="qty-btn" type="button" onclick="increaseQty(this)">+</button>
                            </div>
                            <button type="submit" class="btn-add-cart">ADD TO CART</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No products available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .feature-icon {
        font-size: 3rem;
        color: #2A6049; /* Primary Green */
        margin-bottom: 20px;
    }
    .feature-title {
        color: #1F4D3C;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .feature-text {
        font-weight: 300;
        font-size: 0.95rem;
        line-height: 1.6;
    }
    /* Vertical Divider Logic */
    .feature-col {
        padding: 0 30px;
    }
    /* Add border to right of columns on Desktop only */
    @media (min-width: 992px) {
        .feature-col.border-end-lg {
            border-right: 1px solid #ccc;
        }
    }
</style>

<div class="container py-5 my-5">
    <div class="row text-center justify-content-center">
        
        <div class="col-lg-4 feature-col border-end-lg mb-4 mb-lg-0">
            <div class="feature-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <h4 class="feature-title">Pick Up Options</h4>
            <p class="feature-text text-muted">
                safely picking up your order from the store or curbside.
            </p>
        </div>

        <div class="col-lg-4 feature-col border-end-lg mb-4 mb-lg-0">
            <div class="feature-icon">
                <i class="fas fa-truck"></i>
            </div>
            <h4 class="feature-title">Same Day Delivery</h4>
            <p class="feature-text text-muted">
               Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam perferendis asperiores nemo, obcaecati libero aliquam fugiat debitis provident unde soluta vel labore dolorem id, sint recusandae
            </p>
        </div>

        <div class="col-lg-4 feature-col">
            <div class="feature-icon">
                <i class="fas fa-head-side-mask"></i>
            </div>
            <h4 class="feature-title">Health & Safety Rules</h4>
            <p class="feature-text text-muted">
                We follow strict health and safety protocols to ensure your safety and well-being.
            </p>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(document).ready(function(){
        $("#weeklyDealsSlider").owlCarousel({
            loop: true, margin: 20, nav: true, dots: false,
            navText: ["<", ">"],
            responsive: { 0: { items: 1 }, 600: { items: 2 }, 1000: { items: 4 } }
        });
    });

    function increaseQty(btn) {
        let input = btn.previousElementSibling;
        input.value = parseInt(input.value) + 1;
    }
    function decreaseQty(btn) {
        let input = btn.nextElementSibling;
        if(parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>

<?php require_once '../app/views/includes/footer.php'; ?>