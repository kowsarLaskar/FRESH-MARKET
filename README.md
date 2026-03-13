# 🛒 Fresh-Market: E-Commerce Web Application

A robust, custom-built e-commerce platform utilizing a custom PHP MVC (Model-View-Controller) architecture. Fresh-Market is designed to provide a seamless shopping experience while offering dedicated management dashboards for Administrators and Delivery Personnel.

**Live Demo:** [https://fresh-market.infinityfreeapp.com] *(Note: Currently in development/testing phase)*

---

## 🚀 Key Features by User Role

Fresh-Market operates on a multi-tier user system, ensuring that customers, admins, and delivery drivers have access to exactly what they need.

### 👤 1. Customer Panel
* **Secure Authentication:** User registration and login system with secure password hashing.
* **Product Browsing:** Dynamic product catalog fetched directly from the database.
* **AJAX Shopping Cart:** Seamless "Add to Cart" functionality without page reloads for a smoother user experience.
* **Order Placement:** Streamlined checkout process to finalize purchases.
* **Order History:** Dedicated dashboard for customers to track their active and past orders.

### 🛡️ 2. Administrator Panel
* **Product Management:** Full CRUD (Create, Read, Update, Delete) capabilities for the store's inventory.
* **Order Oversight:** View all system-wide orders and manage their fulfillment status.
* **User Management:** Monitor registered customers and manage delivery personnel accounts.
* **Financial Settings:** Control dynamic platform variables (e.g., configuring driver commission rates).

### 🚚 3. Delivery Personnel Panel
* **Delivery Dashboard:** A focused interface for drivers to see orders assigned to them.
* **Status Tracking:** Ability to update the delivery status of an order (e.g., "Out for Delivery", "Delivered") in real-time.
* **Earnings Overview:** Track completed deliveries and calculated commissions.

---

## 🛠️ Technology Stack

* **Backend:** PHP (Custom MVC Framework)
* **Database:** MySQL
* **Frontend:** HTML5, CSS3, JavaScript (AJAX/Fetch API)
* **Routing:** Apache `.htaccess` URL rewriting for clean, secure routing
* **Hosting environment:** Linux-based shared hosting

---

## 📂 System Architecture (MVC)

This application was built without external PHP frameworks (like Laravel) to deeply understand software architecture. It uses a custom routing engine (`app/core/Core.php`) to map URLs to specific Controllers and Views.

```text
FRESH-MARKET/
├── app/
│   ├── config/       # Database & Environment variables
│   ├── controllers/  # Application logic (Pages, Users, Cart, etc.)
│   ├── core/         # Base Controller, Database PDO wrapper, and Router
│   ├── helpers/      # Session and formatting helpers
│   ├── models/       # Database queries and data handling
│   └── views/        # UI templates (HTML/PHP)
├── public/           
│   ├── css/          # Stylesheets
│   ├── js/           # Client-side scripts & AJAX
│   └── index.php     # The application entry point
└── .htaccess         # Root traffic director

## 💻 Local Environment Setup

Follow these steps to get the Fresh Market application running on your local machine using a local server environment like XAMPP, MAMP, or WAMP.

###  Repository Setup

1. Navigate to your local web server's root directory (e.g., `C:\xampp\htdocs` for XAMPP users).
2. Clone this repository into that folder:
   ```bash
   git clone [https://github.com/kowsarlaskar/FRESH-MARKET.git](https://github.com/kowsarlaskar/FRESH-MARKET.git)

## 💻 Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');    
define('DB_NAME', 'fresh_market_db');
define('DB_PORT', '3306');

