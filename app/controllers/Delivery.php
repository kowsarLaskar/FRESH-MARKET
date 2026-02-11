<?php

class Delivery extends Controller {
    private $orderModel;

    public function __construct() {
        // Security Check
        if (!isLoggedIn() || $_SESSION['user_role'] != 'delivery_boy') {
            redirect('users/login');
        }
        $this->orderModel = $this->model('Order');
    }

    public function index() {
        // Get the current logged-in driver's ID
        $driver_id = $_SESSION['user_id'];

        // 1. Fetch "Open Pool" (Processing + No Driver)
        // 2. Fetch "My Queue" (Assigned to ME)
        $data = [
            'open_orders' => $this->orderModel->getOpenOrders(),
            'my_orders'   => $this->orderModel->getAssignedOrders($driver_id)
        ];

        $this->view('delivery/index', $data);
    }

    // ACTION: Accept an Order (Atomic Update)
    // This replaces your old 'start' function
    public function accept($order_id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $driver_id = $_SESSION['user_id'];

            // Attempt to accept using the Race Condition Safe method
            if ($this->orderModel->acceptOrder($order_id, $driver_id)) {
                // Scenario: WINNER
                flash('delivery_msg', 'Order Accepted Successfully! Please proceed to pickup.', 'alert alert-success');
            } else {
                // Scenario: LOSER (Someone else clicked 1ms before you)
                flash('delivery_msg', 'Too late! Another driver just accepted this order.', 'alert alert-danger');
            }
            redirect('delivery/index');
        }
    }

    // ACTION: Complete Delivery
    // Updates status to 'delivered' AND records the commission fee
    public function complete($order_id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $driver_id = $_SESSION['user_id'];

            if ($this->orderModel->completeDelivery($order_id, $driver_id)) {
                flash('delivery_msg', 'Great Job! Delivery Completed.', 'alert alert-success');
            } else {
                flash('delivery_msg', 'Error updating status.', 'alert alert-danger');
            }
            redirect('delivery/index');
        }
    }

    // --- ADD THESE INSIDE Delivery.php ---

    // VIEW: History Page
    public function history() {
        $driver_id = $_SESSION['user_id'];
        $deliveries = $this->orderModel->getDeliveredOrdersByDriver($driver_id);
        
        $total_earned = 0;
        $total_dues = 0;
        
        // Calculate earnings and pending dues
        if($deliveries) {
            foreach($deliveries as $d) {
                $total_earned += $d->driver_fee;
                if($d->driver_paid_status == 'pending') {
                    $total_dues += $d->driver_fee;
                }
            }
        }

        $data = [
            'deliveries' => $deliveries,
            'total_earned' => $total_earned,
            'total_dues' => $total_dues
        ];

        $this->view('delivery/history', $data);
    }

    // VIEW: Order Details Page
    public function details($id) {
        $order = $this->orderModel->getOrderById($id);
        
        // Security: Prevent viewing if assigned to another driver
        if ($order->delivery_boy_id != null && $order->delivery_boy_id != $_SESSION['user_id']) {
            flash('delivery_msg', 'Unauthorized access.', 'alert alert-danger');
            redirect('delivery');
        }

        $items = $this->orderModel->getOrderItems($id);

        $data = [
            'order' => $order,
            'items' => $items
        ];

        $this->view('delivery/details', $data);
    }

    // ACTION: Cancel Delivery
    public function cancel($order_id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $driver_id = $_SESSION['user_id'];
            $reason = trim($_POST['cancel_reason']);

            if ($this->orderModel->cancelDelivery($order_id, $driver_id, $reason)) {
                flash('delivery_msg', 'Delivery marked as cancelled.', 'alert alert-warning text-dark fw-bold');
            } else {
                flash('delivery_msg', 'Error cancelling delivery.', 'alert alert-danger');
            }
            redirect('delivery/index');
        }
    }
}