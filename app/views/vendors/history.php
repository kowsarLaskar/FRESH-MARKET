<?php require APPROOT . '/views/includes/vendor_header.php'; ?>

<div class="container mt-4">
  <div class="row">
    <?php // require APPROOT . '/views/inc/sidebar.php'; 
    ?>

    <div class="col-md-12">
      <h2 class="mb-2"><i class="fa fa-history"></i> Order History</h2>
      <p class="text-muted">A complete log of items you have successfully packed and dispatched.</p>

      <div class="card shadow-sm mt-4">
        <div class="card-body p-0">
          <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
              <tr>
                <th>Order #</th>
                <th>Date & Time</th>
                <th>Product Name</th>
                <th>Qty</th>
                <th>Total Price</th>
                <th>Delivery Status</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($data['orders'])) : ?>
                <tr>
                  <td colspan="6" class="text-center py-5">
                    <h5 class="text-muted">No order history yet.</h5>
                    <p class="mb-0">Your completed orders will appear here.</p>
                  </td>
                </tr>
              <?php else : ?>
                <?php foreach ($data['orders'] as $order) : ?>
                  <tr>
                    <td class="align-middle fw-bold">#<?php echo $order->order_id; ?></td>
                    <td class="align-middle"><?php echo date('M d, Y - g:i A', strtotime($order->order_date)); ?></td>
                    <td class="align-middle"><strong><?php echo $order->product_name; ?></strong></td>
                    <td class="align-middle"><?php echo $order->quantity; ?></td>
                    <td class="align-middle text-success fw-bold">
                      ₹<?php echo number_format($order->quantity * $order->price, 2); ?>
                    </td>
                    <td class="align-middle">
                      <?php
                      // Dynamic badge colors based on the exact status
                      $status = strtolower($order->vendor_status);
                      if ($status == 'ready_for_delivery') {
                        $badgeClass = 'bg-info text-dark';
                        $statusText = 'WAITING FOR DRIVER';
                      } elseif ($status == 'completed' || $status == 'delivered') {
                        $badgeClass = 'bg-success';
                        $statusText = 'DELIVERED';
                      } else {
                        $badgeClass = 'bg-secondary';
                        $statusText = strtoupper(str_replace('_', ' ', $status));
                      }
                      ?>
                      <span class="badge <?php echo $badgeClass; ?> px-2 py-1 shadow-sm">
                        <i class="fa fa-truck me-1"></i> <?php echo $statusText; ?>
                      </span>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/includes/vendor_footer.php'; ?>