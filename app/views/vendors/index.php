<?php require APPROOT . '/views/includes/vendor_header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Welcome back, <?php echo $_SESSION['user_name']; ?>!</h2>
    <span class="badge bg-success p-2 fs-6">Store Status: Active</span>
</div>

<div class="row mb-4">
    
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Pending Orders</h5>
                        <h2 class="mb-0">12</h2> 
                    </div>
                    <i class="fas fa-clock fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <a href="<?php echo URLROOT; ?>/vendors/orders" class="text-white text-decoration-none">View Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-info mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">My Inventory</h5>
                        <h2 class="mb-0">45</h2>
                    </div>
                    <i class="fas fa-tags fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <a href="<?php echo URLROOT; ?>/vendors/products" class="text-white text-decoration-none">Manage Products <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-success mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Monthly Earnings</h5>
                        <h2 class="mb-0"><?php echo CURRENCY; ?> 4,250</h2>
                    </div>
                    <i class="fas fa-wallet fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <a href="<?php echo URLROOT; ?>/vendors/history" class="text-white text-decoration-none">View History <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

</div>

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-list-alt text-primary"></i> Recent Orders Needing Attention</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Order ID</th>
                    <th>Item</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#10045</td>
                    <td>Organic Apples (1kg)</td>
                    <td>Today, 10:30 AM</td>
                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                    <td><a href="<?php echo URLROOT; ?>/vendors/orders" class="btn btn-sm btn-primary">Process</a></td>
                </tr>
                <tr>
                    <td>#10042</td>
                    <td>Whole Wheat Bread</td>
                    <td>Today, 09:15 AM</td>
                    <td><span class="badge bg-info">Processing</span></td>
                    <td><a href="<?php echo URLROOT; ?>/vendors/orders" class="btn btn-sm btn-primary">Update</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php require APPROOT . '/views/includes/vendor_footer.php'; ?>