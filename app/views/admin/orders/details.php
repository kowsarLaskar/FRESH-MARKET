<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order #<?php echo $data['order']->order_id; ?> - Fresh Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body { background-color: #FBF9F1; padding: 40px; }</style>
</head>
<body>

<div class="container" style="max-width: 800px;">
    <div class="d-flex justify-content-between mb-4">
        <h3 class="fw-bold">Order #<?php echo $data['order']->order_id; ?></h3>
        <a href="<?php echo URLROOT; ?>/adminOrders" class="btn btn-outline-secondary">Back to List</a>
    </div>

    <div class="card shadow-sm border-0 p-4 mb-4">
        <h5 class="border-bottom pb-2 mb-3">Customer Details</h5>
        <p><strong>Name:</strong> <?php echo $data['order']->full_name; ?></p>
        <p><strong>Email:</strong> <?php echo $data['order']->email; ?></p>
        <p><strong>Phone:</strong> <?php echo $data['order']->phone; ?></p>
        <p><strong>Address:</strong> <?php echo nl2br($data['order']->delivery_address); ?></p>
    </div>

    <div class="card shadow-sm border-0 p-4">
        <h5 class="border-bottom pb-2 mb-3">Order Status</h5>
        
        <form action="<?php echo URLROOT; ?>/adminOrders/show/<?php echo $data['order']->order_id; ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Current Status:</label>
                <select name="order_status" class="form-select form-select-lg">
                    <option value="pending" <?php echo ($data['order']->order_status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="processing" <?php echo ($data['order']->order_status == 'processing') ? 'selected' : ''; ?>>Processing</option>
                    <option value="out_for_delivery" <?php echo ($data['order']->order_status == 'out_for_delivery') ? 'selected' : ''; ?>>Out for Delivery</option>
                    <option value="delivered" <?php echo ($data['order']->order_status == 'delivered') ? 'selected' : ''; ?>>Delivered</option>
                    <option value="cancelled" <?php echo ($data['order']->order_status == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Update Status</button>
        </form>
    </div>
</div>

</body>
</html>