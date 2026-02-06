<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="container my-5 text-center">
    <div class="card border-0 shadow-sm p-5 mx-auto" style="max-width: 600px;">
        <div class="mb-4">
            <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
        </div>
        <h2 class="fw-bold text-success mb-3">Order Placed Successfully!</h2>
        <p class="text-muted lead mb-4">
            Thank you for shopping with Fresh Market. <br>
            We have received your order and are confirming it shortly.
        </p>
        
        <div class="d-grid gap-2 col-8 mx-auto">
            <a href="<?php echo URLROOT; ?>" class="btn btn-success fw-bold">Continue Shopping</a>
            <a href="<?php echo URLROOT; ?>/orders" class="btn btn-outline-secondary">View My Orders</a>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>