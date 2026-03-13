<?php require_once '../app/views/includes/header.php'; ?>

<style>
    /* --- CART PAGE STYLING --- */
    body {
        background-color: #FBF9F1;
    }

    /* Constrain the width of the main content */
    .cart-body-wrapper {
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Table Styles */
    .cart-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 15px;
        /* Adds space between rows */
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
        background-color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
    }

    /* ROUNDED CORNERS FOR TABLE ROWS */
    .cart-table tbody tr td:first-child {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .cart-table tbody tr td:last-child {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
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
        border-radius: 8px;
        /* Added border radius */
        padding: 4px;
    }

    .cart-prod-name {
        font-weight: 500;
        font-size: 1rem;
        color: #333;
    }

    /* --- FIXED QTY SELECTOR --- */
    .cart-qty-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        /* Distributes items evenly */
        border: 1px solid #ccc;
        width: 110px;
        /* Slightly wider for padding */
        height: 38px;
        border-radius: 8px;
        /* Added border radius */
        padding: 0 4px;
        /* Internal padding */
        background: #fff;
    }

    .cart-qty-btn {
        background: transparent;
        border: none;
        width: 32px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #555;
        cursor: pointer;
        text-decoration: none;
        border-radius: 6px;
        /* Inner radius for hover effect */
        transition: background-color 0.2s, color 0.2s;
    }

    .cart-qty-btn:hover {
        background-color: #f0f0f0;
        color: #1F4D3C;
    }

    .cart-qty-val {
        border: none;
        width: 35px;
        text-align: center;
        font-size: 1rem;
        font-weight: 600;
        background: transparent;
        -moz-appearance: textfield;
        outline: none;
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

    .btn-remove:hover {
        color: #dc3545;
    }

    /* Order Summary Box */
    .summary-card {
        background: white;
        padding: 25px;
        border: 1px solid #eee;
        border-radius: 12px;
        /* Added border radius */
        position: sticky;
        top: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        /* Soft shadow */
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
        border-radius: 8px;
        /* Added border radius */
        margin-top: 25px;
        transition: background 0.3s, transform 0.2s;
    }

    .btn-checkout:hover {
        background-color: #1F4D3C;
        color: white;
        transform: translateY(-2px);
        /* Slight lift effect */
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
            <a href="<?php echo URLROOT; ?>" class="text-decoration-none text-muted">Home</a>
            <span class="mx-2">&gt;</span>
            <span class="fw-bold text-dark">My Cart</span>
        </div>

        <?php if (empty($data['cart_items'])): ?>

            <div class="empty-cart-container bg-white" style="border-radius: 12px; border: 1px solid #eee;">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-basket"></i>
                </div>
                <h2 class="fw-bold text-muted">Your cart is empty</h2>
                <p class="mb-4">Looks like you haven't added anything to your cart yet.</p>
                <a href="<?php echo URLROOT; ?>/shop" class="btn btn-checkout mx-auto d-block"
                    style="max-width: 250px; text-decoration: none;">Start Shopping</a>
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
                                    <th style="width: 20%; text-align: center;">Quantity</th>
                                    <th style="width: 10%;">Total</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['cart_items'] as $item): ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo URLROOT; ?>/shop/product/<?php echo $item['product_id']; ?>"
                                                class="cart-product-link">
                                                <img src="<?php echo URLROOT; ?>/assets/products/<?php echo $item['image']; ?>"
                                                    alt="<?php echo $item['name']; ?>" class="cart-thumb">
                                                <span class="cart-prod-name"><?php echo $item['name']; ?></span>
                                            </a>
                                        </td>

                                        <td><?php echo CURRENCY . $item['selling_price']; ?></td>

                                        <td>
                                            <div class="cart-qty-group mx-auto">
                                                <a href="<?php echo URLROOT; ?>/cart/decrease/<?php echo $item['product_id']; ?>"
                                                    class="cart-qty-btn">
                                                    -
                                                </a>

                                                <input type="text" class="cart-qty-val" value="<?php echo $item['qty']; ?>" readonly>

                                                <a href="<?php echo URLROOT; ?>/cart/increase/<?php echo $item['product_id']; ?>"
                                                    class="cart-qty-btn">
                                                    +
                                                </a>
                                            </div>
                                        </td>

                                        <td class="fw-bold">
                                            <?php echo CURRENCY . number_format($item['selling_price'] * $item['qty'], 2); ?>
                                        </td>

                                        <td class="text-end">
                                            <a href="<?php echo URLROOT; ?>/cart/remove/<?php echo $item['product_id']; ?>" class="btn-remove"
                                                title="Remove Item">
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
                            <span class="text-success fw-bold">Free</span>
                        </div>

                        <div class="summary-total">
                            <span>Total</span>
                            <span><?php echo CURRENCY . number_format($data['subtotal'], 2); ?></span>
                        </div>

                        <a href="<?php echo URLROOT; ?>/checkout" class="btn-checkout text-decoration-none d-block text-center">
                            Checkout
                        </a>

                        <div class="text-center mt-3 text-muted" style="font-size: 0.8rem;">
                            <i class="fas fa-lock me-1"></i> Secure Checkout
                        </div>
                    </div>
                </div>

            </div>

        <?php endif; ?>
    </div>
</div>

<script>
    function increaseQty(btn) {
        let input = btn.previousElementSibling;
        input.value = parseInt(input.value) + 1;
    }

    function decreaseQty(btn) {
        let input = btn.nextElementSibling;
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>

<?php require_once '../app/views/includes/footer.php'; ?>