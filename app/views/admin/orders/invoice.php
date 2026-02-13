<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice_Order_#<?php echo $data['order']->order_id; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fff; color: #000; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
        .invoice-header { border-bottom: 2px solid #1F4D3C; padding-bottom: 10px; margin-bottom: 20px; }
        .table th { background-color: #f8f9fa !important; color: #000 !important; }
        
        /* Hide buttons and styling when actually printing */
        @media print {
            .no-print { display: none !important; }
            .invoice-box { box-shadow: none; border: none; padding: 0; margin: 0; }
        }
    </style>
</head>
<body>

<div class="container mt-4 mb-4">
    <div class="text-end mb-3 no-print">
        <button onclick="window.print()" class="btn btn-success"><i class="fas fa-print"></i> Print / Save PDF</button>
        <button onclick="window.close()" class="btn btn-secondary">Close Tab</button>
    </div>

    <div class="invoice-box">
        
        <div class="invoice-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-0" style="color:#1F4D3C;">FRESH MARKET</h2>
                <small class="text-muted">Your Daily Grocery Partner</small>
            </div>
            <div class="text-end">
                <h3 class="fw-bold text-muted mb-0">INVOICE</h3>
                <strong>Order #:</strong> <?php echo $data['order']->order_id; ?><br>
                <strong>Date:</strong> <?php echo date('M d, Y', strtotime($data['order']->order_date)); ?>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-6">
                <h6 class="fw-bold text-muted text-uppercase mb-1">Customer Details:</h6>
                <div><strong>Name:</strong> <?php echo $data['order']->full_name; ?></div>
                <div><strong>Phone:</strong> <?php echo $data['order']->phone; ?></div>
                <div><strong>Payment:</strong> <?php echo strtoupper($data['order']->payment_mode); ?> (<?php echo ucfirst($data['order']->payment_status); ?>)</div>
            </div>
            <div class="col-sm-6 text-end">
                <h6 class="fw-bold text-muted text-uppercase mb-1">Delivery Address:</h6>
                <div><?php echo nl2br($data['order']->delivery_address); ?></div>
            </div>
        </div>

        <table class="table table-bordered border-dark mt-4">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['items'] as $item): ?>
                    <tr>
                        <td>
                            <strong><?php echo $item->name; ?></strong><br>
                            <small class="text-muted"><?php echo $item->unit_value . ' ' . $item->unit_type; ?></small>
                        </td>
                        <td class="text-center">₹<?php echo number_format($item->price, 2); ?></td>
                        <td class="text-center"><?php echo $item->quantity; ?></td>
                        <td class="text-end fw-bold">₹<?php echo number_format($item->price * $item->quantity, 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Grand Total:</td>
                    <td class="text-end fw-bold fs-5">₹<?php echo number_format($data['order']->total_amount, 2); ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="mt-5 text-center text-muted small">
            <p>Thank you for shopping with Fresh Market!<br>
            If you have any questions concerning this invoice, contact our support.</p>
        </div>
    </div>
</div>

<script>
    window.onload = function() { window.print(); }
</script>

</body>
</html>