<?php
class Payouts extends Controller {
    private $orderModel;
    private $userModel;

    public function __construct() {
        // Security: Only Admins allowed
        if (!isLoggedIn() || $_SESSION['user_role'] != 'admin') {
            redirect('users/login');
        }
        $this->orderModel = $this->model('Order');
        $this->userModel = $this->model('User');
    }

    // The Main Payouts Dashboard
    public function index() {
        // 1. Get Filters
        $filter_driver = isset($_GET['driver_id']) ? $_GET['driver_id'] : '';
        $filter_from   = isset($_GET['date_from']) ? $_GET['date_from'] : date('Y-m-01'); 
        $filter_to     = isset($_GET['date_to']) ? $_GET['date_to'] : date('Y-m-d');

        // 2. Fetch Data
        $deliveries = $this->orderModel->getDeliveryHistory($filter_driver, $filter_from, $filter_to);
        $drivers    = $this->userModel->getUsersByRole('delivery_boy');

        // 3. Calculate Totals
        $total_commission = 0;
        $pending_payout   = 0;

        if($deliveries) {
            foreach($deliveries as $d) {
                $total_commission += $d->driver_fee;
                if($d->driver_paid_status == 'pending') {
                    $pending_payout += $d->driver_fee;
                }
            }
        }

        $data = [
            'nav' => 'payouts', // Highlights sidebar
            'deliveries' => $deliveries,
            'drivers' => $drivers,
            'filters' => [
                'driver_id' => $filter_driver,
                'from' => $filter_from,
                'to' => $filter_to
            ],
            'stats' => [
                'total_comm' => $total_commission,
                'pending' => $pending_payout
            ]
        ];

        $this->view('admin/payouts/index', $data);
    }

    // Action: Mark orders as Paid
    public function mark_paid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $driver_id = $_POST['driver_id'];
            $date_from = $_POST['date_from'];
            $date_to   = $_POST['date_to'];

            if($this->orderModel->markDeliveriesAsPaid($driver_id, $date_from, $date_to)) {
                // Redirect back with same filters
                redirect('payouts/index?driver_id='.$driver_id.'&date_from='.$date_from.'&date_to='.$date_to);
            } else {
                die('Something went wrong');
            }
        }
    }
}