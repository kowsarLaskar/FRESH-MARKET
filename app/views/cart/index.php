<?php require_once '../app/views/includes/header.php'; ?>

<style>
    /* --- CART PAGE STYLING --- */
    body { background-color: #FBF9F1; }

    /* NEW: Constrain the width of the main content */
    .cart-body-wrapper {
        max-width: 1100px; /* Prevents it from getting too wide on large screens */
        margin: 0 auto;    /* Centers the block */
    }

    /* Table Styles */
    .cart-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 15px; /* Adds space between rows */
    }
    .cart-table thead th {
        border-bottom: 1px solid #ccc;
        font-weight: 600;
        color: #1F4D3C;
        padding-bottom: 10px;
        text-transform: uppercase;
        font-size: 0.85rem;
    }
    .cart-table tbody tr {
        background-color: white; /* White row on cream bg */
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }
    .cart-table td {
        padding: 15px;
        vertical-align: middle;
    }
    
    /* Product Info Column */
    .cart-product-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #333;
    }
    .cart-thumb {
        width: 60px;
        height: 60px;
        object-fit: contain;
        margin-right: 15px;
        border: 1px solid #eee;
    }
    .cart-prod-name {
        font-weight: 500;
        font-size: 1rem;
        color: #333;
    }

    /* Qty Selector (Matches Shop Page) */
    .cart-qty-group {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        width: 100px;
        height: 35px;
    }
    .cart-qty-btn {
        background: transparent;
        border: none;
        width: 30px;
        font-size: 1.2rem;
        color: #555;
        cursor: pointer;
    }
    .cart-qty-val {
        border: none;
        width: 40px;
        text-align: center;
        font-size: 0.9rem;
        background: transparent;
        -moz-appearance: textfield;
    }

    /* Remove Button */
    .btn-remove {
        color: #999;
        font-size: 1.2rem;
        transition: color 0.3s;
        cursor: pointer;
        background: none;
        border: none;
    }
    .btn-remove:hover { color: #dc3545; }

    /* Order Summary Box */
    .summary-card {
        background: white;
        padding: 25px;
        border: 1px solid #eee;
        position: sticky;
        top: 20px; /* Sticks when scrolling */
    }
    .summary-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1F4D3C;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 0.95rem;
        color: #555;
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
        font-weight: 700;
        font-size: 1.2rem;
        color: #333;
    }

    /* Checkout Button */
    .btn-checkout {
        background-color: #2A6049;
        color: white;
        width: 100%;
        padding: 12px;
        text-transform: uppercase;
        font-weight: 600;
        border: none;
        margin-top: 25px;
        transition: background 0.3s;
    }
    .btn-checkout:hover {
        background-color: #1F4D3C;
        color: white;
    }
    
    /* Empty Cart State */
    .empty-cart-container {
        text-align: center;
        padding: 80px 0;
    }
    .empty-cart-icon {
        font-size: 4rem;
        color: #ccc;
        margin-bottom: 20px;
    }
</style>

<div class="container py-5">
    
    <div class="cart-body-wrapper">

        <div class="mb-4 breadcrumb">
            <a href="<?php echo URLROOT; ?>">Home</a>
            <span class="mx-2">&gt;</span>
            <span>My Cart</span>
        </div>

        <?php if(empty($data['cart_items'])): ?>
            
            <div class="empty-cart-container">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-basket"></i>
                </div>
                <h2 class="fw-bold text-muted">Your cart is empty</h2>
                <p class="mb-4">Looks like you haven't added anything to your cart yet.</p>
                <a href="<?php echo URLROOT; ?>/shop" class="btn btn-checkout" style="max-width: 250px;">Start Shopping</a>
            </div>

        <?php else: ?>

            <div class="row">
                
                <div class="col-lg-8 mb-4">
                    <div class="table-responsive">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Product</th>
                                    <th style="width: 15%;">Price</th>
                                    <th style="width: 20%;">Quantity</th>
                                    <th style="width: 10%;">Total</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody>
    <?php foreach($data['cart_items'] as $item): ?>
    <tr>
        <td>
            <a href="<?php echo URLROOT; ?>/shop/product/<?php echo $item['product_id']; ?>" class="cart-product-link">
                <img src="<?php echo URLROOT; ?>/assets/products/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="cart-thumb">
                <span class="cart-prod-name"><?php echo $item['name']; ?></span>
            </a>
        </td>
        
        <td><?php echo CURRENCY . $item['selling_price']; ?></td>
        
        <td>
    <div class="cart-qty-group">
        <a href="<?php echo URLROOT; ?>/cart/decrease/<?php echo $item['product_id']; ?>" class="cart-qty-btn" style="text-decoration:none; line-height:30px;">
            -
        </a>
        
        <input type="text" class="cart-qty-val" value="<?php echo $item['qty']; ?>" readonly>
        
        <a href="<?php echo URLROOT; ?>/cart/increase/<?php echo $item['product_id']; ?>" class="cart-qty-btn" style="text-decoration:none; line-height:30px;">
            +
        </a>
    </div>
</td>
        
        <td class="fw-bold">
            <?php echo CURRENCY . number_format($item['selling_price'] * $item['qty'], 2); ?>
        </td>
        
        <td class="text-end">
            <a href="<?php echo URLROOT; ?>/cart/remove/<?php echo $item['product_id']; ?>" class="btn-remove" title="Remove Item">
                <i class="fas fa-times"></i>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="summary-card">
                        <div class="summary-title">Order Summary</div>
                        
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span><?php echo CURRENCY . number_format($data['subtotal'], 2); ?></span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Estimate Delivery</span>
                            <span>Free</span>
                        </div>

                        <div class="summary-total">
                            <span>Total</span>
                            <span><?php echo CURRENCY . number_format($data['subtotal'], 2); ?></span>
                        </div>

                        <button class="btn-checkout">Checkout</button>
                        
                        <div class="text-center mt-3 text-muted" style="font-size: 0.8rem;">
                            <i class="fas fa-lock me-1"></i> Secure Checkout
                        </div>
                    </div>
                </div>

            </div>

        <?php endif; ?>
    </div> </div>

<script>
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