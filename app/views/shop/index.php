<?php require_once '../app/views/includes/header.php'; ?>

<style>
    /* --- SHOP PAGE STYLING --- */
    body { background-color: #FBF9F1; }

    /* Sidebar Styles */
    .sidebar-title {
        font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 1.1rem;
        color: #1F4D3C; border-bottom: 1px solid #000; padding-bottom: 10px; margin-bottom: 20px;
    }
    .cat-link {
        display: block; color: #333; font-weight: 300; text-decoration: none;
        padding: 8px 0; font-size: 0.95rem; transition: color 0.2s;
    }
    .cat-link:hover { color: #5ba534; }
    .cat-link.active { font-weight: 600; color: #1F4D3C; }

    /* Price Filter Slider */
    .price-slider {
        -webkit-appearance: none; width: 100%; background: transparent; margin-top: 10px;
    }
    .price-slider::-webkit-slider-runnable-track {
        width: 100%; height: 4px; background: #000000; border-radius: 2px; cursor: pointer;
    }
    .price-slider::-webkit-slider-thumb {
        -webkit-appearance: none; height: 18px; width: 18px; border-radius: 50%;
        background: #5ba534; cursor: pointer; margin-top: -7px;
    }
    .price-slider::-moz-range-track {
        width: 100%; height: 4px; background: #000000; border-radius: 2px; cursor: pointer;
    }
    .price-slider::-moz-range-thumb {
        height: 18px; width: 18px; border: none; border-radius: 50%; background: #5ba534; cursor: pointer;
    }

    /* Main Content Styles */
    .shop-banner-container {
        width: 100%; height: 300px; background-color: #e0e0e0; margin-bottom: 30px; overflow: hidden;
    }
    .shop-banner-img { width: 100%; height: 100%; object-fit: cover; object-position: center; }
    .category-header h1 { font-weight: 700; color: #1F4D3C; }

    /* Product Card Styles */
    .shop-card { background: transparent; border: none; text-align: center; margin-bottom: 40px; }
    .shop-img-wrapper {
        height: 200px; width: 100%; display: flex; align-items: center; justify-content: center;
        overflow: hidden; margin-bottom: 15px; background-color: white; transition: opacity 0.3s;
    }
    .shop-img-wrapper:hover { opacity: 0.8; }
    .shop-img { max-height: 100%; max-width: 100%; object-fit: contain; }
    .shop-title { font-size: 1rem; color: #555; font-weight: 300; margin-bottom: 5px; }
    .shop-price { font-size: 1rem; color: #555; font-weight: 300; margin-bottom: 15px; }

    /* Qty Group */
    .shop-qty-group {
        display: flex; justify-content: center; align-items: center; border: 1px solid #999;
        width: 120px; margin: 0 auto 15px auto; height: 35px;
    }
    .shop-qty-btn { background: transparent; border: none; color: #333; font-size: 1.2rem; width: 30px; cursor: pointer; }
    .shop-qty-val { border: none; background: transparent; text-align: center; width: 40px; font-size: 0.9rem; -moz-appearance: textfield; }

    /* Add to Cart Button */
    .btn-shop-add {
        width: 100%; border: 1px solid #333; background-color: transparent; color: #333;
        padding: 8px 0; font-size: 0.9rem; transition: all 0.3s;
    }
    .btn-shop-add:hover { background-color: #333; color: white; }

    /* Breadcrumb */
    .breadcrumb a { color: #333; text-decoration: none; font-size: 0.9rem; }
    .breadcrumb span { font-size: 0.9rem; color: #777; }
</style>

<div class="container py-5">
    
    <div class="mb-4 breadcrumb">
        <a href="<?php echo URLROOT; ?>">Home</a>
        <span class="mx-2">&gt;</span>
        <span>All Products</span>
    </div>

    <div class="row">
        
        <div class="col-md-3 pe-lg-5">
            
            <div class="mb-5">
                <h3 class="sidebar-title">Browse by</h3>
                <nav>
                    <a href="<?php echo URLROOT; ?>/shop" class="cat-link active">All Products</a>
                    
                    <?php if(!empty($data['categories'])): ?>
                        <?php foreach($data['categories'] as $cat): ?>
                            <a href="<?php echo URLROOT; ?>/shop/category/<?php echo $cat->category_id; ?>" class="cat-link">
                                <?php echo $cat->name; ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </nav>
            </div>

            <div class="mb-5">
                <h3 class="sidebar-title">Filter by</h3>
                <label class="mb-2 fw-light">Price</label>
                <input type="range" class="form-range price-slider" min="0" max="50" id="priceRange">
                <div class="d-flex justify-content-between mt-2 fs-6 text-muted">
                    <span>$0</span>
                    <span>$50</span>
                </div>
            </div>

        </div>

        <div class="col-md-9">
            
            <div class="shop-banner-container">
                <img src="<?php echo URLROOT; ?>/assets/products/shop_banner.jpg" alt="Shop Banner" class="shop-banner-img">
            </div>

            <div class="category-header mb-4">
                <h1>All Products</h1>
                <p class="text-muted fw-light mt-2" style="max-width: 700px;">
                    Explore our wide selection of fresh produce, dairy, and household essentials.
                </p>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 pb-3">
                <span class="text-muted fw-light"><?php echo count($data['products']); ?> products</span>
                <div class="dropdown">
                    <button class="btn btn-sm dropdown-toggle fw-light border-0" type="button" data-bs-toggle="dropdown">
                        Sort by: Recommended
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Newest</a></li>
                        <li><a class="dropdown-item" href="#">Price (Low to High)</a></li>
                        <li><a class="dropdown-item" href="#">Price (High to Low)</a></li>
                    </ul>
                </div>
            </div>

            <div class="row g-4">
                
                <?php if(!empty($data['products'])): ?>
                    <?php foreach($data['products'] as $product): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="shop-card">
                            
                            <form action="<?php echo URLROOT; ?>/cart/add" method="POST" class="add-cart-form">
                                <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">

                                <a href="<?php echo URLROOT; ?>/shop/product/<?php echo $product->product_id; ?>" class="shop-img-wrapper">
                                    <img src="<?php echo URLROOT; ?>/assets/products/<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>" class="shop-img">
                                </a>

                                <div class="shop-title"><?php echo $product->name; ?></div>
                                <div class="shop-price"><?php echo CURRENCY . $product->selling_price; ?></div>

                                <div class="shop-qty-group">
                                    <button type="button" class="shop-qty-btn" onclick="this.nextElementSibling.value = Math.max(1, parseInt(this.nextElementSibling.value) - 1)">-</button>
                                    <input type="number" name="qty" class="shop-qty-val" value="1" min="1" readonly>
                                    <button type="button" class="shop-qty-btn" onclick="this.previousElementSibling.value = parseInt(this.previousElementSibling.value) + 1">+</button>
                                </div>

                                <button type="submit" class="btn-shop-add">Add to Cart</button>
                            </form>
                            </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center mt-5">No products found in the database.</p>
                <?php endif; ?>

            </div>

            <div class="d-flex justify-content-center mt-5">
                <nav>
                    <ul class="pagination pagination-sm">
                        <li class="page-item disabled"><a class="page-link border-0 bg-transparent text-muted" href="#">&lt;</a></li>
                        <li class="page-item"><a class="page-link border-0 bg-transparent text-dark" href="#">1</a></li>
                        <li class="page-item"><a class="page-link border-0 bg-transparent text-muted" href="#">2</a></li>
                        <li class="page-item"><a class="page-link border-0 bg-transparent text-muted" href="#">&gt;</a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
</div> <script>
    // 1. Select all forms with the class 'add-cart-form'
    const forms = document.querySelectorAll('.add-cart-form');

    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // 2. Prevent the default form submission
            e.preventDefault();

            // 3. Get the button so we can change text (Optional feedback)
            const button = form.querySelector('button[type="submit"]');
            const originalText = button.innerText;

            // 4. Create data payload
            const formData = new FormData(this);

            // 5. Send data to server using Fetch API (AJAX)
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                // The item is now added to the session in the background!
                
                // Visual Feedback: Change button text briefly
                button.innerText = "Added!";
                button.style.backgroundColor = "#1F4D3C"; // Dark Green
                button.style.color = "#fff";
                
                // Reset button after 2 seconds
                setTimeout(() => {
                    button.innerText = originalText;
                    button.style.backgroundColor = "transparent";
                    button.style.color = "#333";
                }, 2000);
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>

<?php require_once '../app/views/includes/footer.php'; ?>

