<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="container my-5">
    <div class="row">
        
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-truck me-2 text-success"></i>Delivery Details</h5>
                </div>
                <div class="card-body p-4">
                    <form action="<?php echo URLROOT; ?>/checkout/placeOrder" method="post">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" 
                                       value="<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control" required placeholder="Enter active phone number">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Street Address</label>
                            <textarea name="address" class="form-control" rows="2" required placeholder="House No, Street Name..."></textarea>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Zip Code</label>
                                <input type="text" name="zip" class="form-control" required>
                            </div>
                        </div>

                        <h5 class="mb-3 fw-bold"><i class="fas fa-wallet me-2 text-success"></i>Payment Method</h5>
                        
                        <div class="border rounded p-3 mb-2 d-flex align-items-center bg-light">
                            <div class="form-check m-0">
                                <input class="form-check-input" type="radio" name="payment_mode" value="cod" id="cod" checked style="cursor: pointer;">
                                <label class="form-check-label fw-bold ms-2" for="cod" style="cursor: pointer;">
                                    Cash on Delivery (COD)
                                </label>
                            </div>
                        </div>
                        
                        <div class="border rounded p-3 mb-2 d-flex align-items-center opacity-50">
                            <div class="form-check m-0">
                                <input class="form-check-input" type="radio" name="payment_mode" id="upi" disabled>
                                <label class="form-check-label ms-2" for="upi">
                                    UPI / GPay / PhonePe <span class="badge bg-secondary ms-2">Coming Soon</span>
                                </label>
                            </div>
                        </div>

                        <div class="border rounded p-3 mb-4 d-flex align-items-center opacity-50">
                            <div class="form-check m-0">
                                <input class="form-check-input" type="radio" name="payment_mode" id="card" disabled>
                                <label class="form-check-label ms-2" for="card">
                                    Credit / Debit Card <span class="badge bg-secondary ms-2">Coming Soon</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100 fw-bold shadow-sm">
                            Confirm Order
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-light" style="position: sticky; top: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Order Summary</h5>
                    
                    <?php foreach($data['cart_items'] as $item): ?>
                        <div class="d-flex justify-content-between mb-2 small">
                            <span><?php echo $item['name']; ?> (x<?php echo $item['qty']; ?>)</span>
                            <span class="fw-bold">₹<?php echo number_format($item['selling_price'] * $item['qty'], 2); ?></span>
                        </div>
                    <?php endforeach; ?>
                    
                    <hr>
                    <div class="d-flex justify-content-between fs-5 fw-bold text-success">
                        <span>Total</span>
                        <span>₹<?php echo number_format($data['total'], 2); ?></span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>