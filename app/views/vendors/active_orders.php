<?php require APPROOT . '/views/includes/vendor_header.php'; ?>

<div class="container mt-4">
  <div class="row">
    <?php // require APPROOT . '/views/inc/sidebar.php'; 
    ?>

    <div class="col-md-12">
      <h2 class="mb-2"><i class="fa fa-clock"></i> Active Orders To Pack</h2>
      <p class="text-muted">These items have been ordered by customers. Please pack them and mark them ready for the
        delivery team.</p>

      <div class="card shadow-sm mt-4">
        <div class="card-body p-0">
          <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
              <tr>
                <th>Order #</th>
                <th>Date & Time</th>
                <th>Product Name</th>
                <th>Qty</th>
                <th>Status</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
              <?php if (empty($data['orders'])) : ?>
                <tr>
                  <td colspan="6" class="text-center py-5">
                    <h5 class="text-muted">No active orders right now.</h5>
                    <p class="mb-0">You are all caught up!</p>
                  </td>
                </tr>
              <?php else : ?>
                <?php foreach ($data['orders'] as $order) : ?>
                  <tr>
                    <td class="align-middle fw-bold">#<?php echo $order->order_id; ?></td>
                    <td class="align-middle"><?php echo date('M d, Y - g:i A', strtotime($order->order_date)); ?></td>
                    <td class="align-middle"><strong><?php echo $order->product_name; ?></strong></td>
                    <td class="align-middle"><?php echo $order->quantity; ?></td>
                    <td class="align-middle">
                      <span class="badge bg-warning text-dark px-2 py-1">
                        <?php echo strtoupper($order->vendor_status); ?>
                      </span>
                    </td>
                    <td class="align-middle">
                      <form action="<?php echo URLROOT; ?>/vendors/updateActiveStatus/<?php echo $order->item_id; ?>"
                        method="POST">
                        <input type="hidden" name="vendor_status" value="ready_for_delivery">
                        <button type="submit" class="btn btn-success btn-sm fw-bold shadow-sm">
                          Mark Ready <i class="fa fa-check-circle ms-1"></i>
                        </button>
                      </form>
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