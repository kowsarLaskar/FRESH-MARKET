<footer class="text-white pt-5 mt-auto" style="background-color: #1F4D3C; font-family: 'Poppins', sans-serif;">
  <div class="container">

    <div class="row border-bottom border-secondary pb-4 mb-4 align-items-center">
      <div class="col-md-6 mb-3 mb-md-0">
        <h2 class="fw-bold m-0" style="letter-spacing: 1px;"><i class="fas fa-leaf me-2"></i>FRESH MARKET</h2>
        <small class="text-white-50">Your daily dose of freshness, delivered.</small>
      </div>
      <div class="col-md-6 text-md-end">
        <a href="#" class="text-white me-3 social-icon"><i class="fab fa-facebook-f fa-lg"></i></a>
        <a href="#" class="text-white me-3 social-icon"><i class="fab fa-instagram fa-lg"></i></a>
        <a href="#" class="text-white me-3 social-icon"><i class="fab fa-twitter fa-lg"></i></a>
        <a href="#" class="text-white social-icon"><i class="fab fa-youtube fa-lg"></i></a>
      </div>
    </div>

    <div class="row g-4">

      <div class="col-lg-3 col-md-6">
        <h6 class="text-uppercase fw-bold mb-3 text-warning">Shop</h6>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">New Arrivals</a></li>
          <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Best Sellers</a></li>
          <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Fresh Fruits</a></li>
          <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Organic Vegetables</a>
          </li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6">
        <h6 class="text-uppercase fw-bold mb-3 text-warning">Customer Care</h6>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Help Center</a></li>
          <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Track Order</a></li>
          <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Shipping & Returns</a>
          </li>
          <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Contact Us</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6">
        <h6 class="text-uppercase fw-bold mb-3 text-warning">Visit Us</h6>
        <p class="text-white-50 mb-1"><i class="fas fa-map-marker-alt me-2"></i> Indhranagar, Agartala</p>
        <p class="text-white-50 mb-3 ps-4">IT BHAVAN, CA 98703</p>

        <h6 class="text-uppercase fw-bold mb-2 text-warning mt-4">Support</h6>
        <p class="text-white-50 mb-1"><i class="fas fa-envelope me-2"></i> support@freshmarket.com</p>
        <p class="text-white-50"><i class="fas fa-phone-alt me-2"></i> +91 123 456 7890</p>
      </div>

      <div class="col-lg-3 col-md-6">
        <h6 class="text-uppercase fw-bold mb-3 text-warning">Stay Updated</h6>
        <p class="text-white-50 small">Subscribe for exclusive offers and recipes.</p>
        <form action="#" method="POST">
          <div class="input-group mb-2">
            <input type="email" class="form-control rounded-0 bg-transparent text-white border-secondary"
              placeholder="Your Email" required>
            <button class="btn btn-warning rounded-0 text-dark fw-bold" type="submit">GO</button>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input bg-transparent border-secondary" id="newsletterCheck">
            <label class="form-check-label text-white-50 small" for="newsletterCheck">I agree to terms.</label>
          </div>
        </form>
      </div>

    </div>
  </div>

  <div class="bg-dark py-3 mt-5">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
      <small class="text-white-50 mb-2 mb-md-0">&copy; <?php echo date('Y'); ?> Fresh Market. All rights
        reserved.</small>
      <div class="text-white-50">
        <i class="fab fa-cc-visa fa-lg me-2"></i>
        <i class="fab fa-cc-mastercard fa-lg me-2"></i>
        <i class="fab fa-cc-paypal fa-lg"></i>
      </div>
    </div>
  </div>
</footer>

<style>
/* Custom Hover Effects */
.hover-white:hover {
  color: #fff !important;
  padding-left: 5px;
  transition: all 0.3s;
}

.social-icon:hover {
  color: #ffc107 !important;
  transition: color 0.3s;
}

::placeholder {
  color: rgba(255, 255, 255, 0.5) !important;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo URLROOT; ?>/js/main.js"></script>
</body>

</html>