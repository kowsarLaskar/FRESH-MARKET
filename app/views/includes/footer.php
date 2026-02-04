<footer class="text-white py-5 mt-auto" style="background-color: var(--primary-green); font-family: 'Poppins', sans-serif;">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h6 class="text-uppercase fw-bold mb-4" style="font-size: 0.9rem; letter-spacing: 1px;">Store</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none fw-light">Shop All</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none fw-light">Shipping & Returns</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none fw-light">Store Policy</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none fw-light">FAQ</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h6 class="text-uppercase fw-bold mb-4" style="font-size: 0.9rem; letter-spacing: 1px;">Address</h6>
                <p class="fw-light mb-1">Indhranagar, Agartala</p>
                <p class="fw-light">IT BHAVAN, CA 98703</p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h6 class="text-uppercase fw-bold mb-4" style="font-size: 0.9rem; letter-spacing: 1px;">Opening Hours</h6>
                <p class="fw-light mb-1">Mon - Fri: 7am - 10pm</p>
                <p class="fw-light mb-1">Saturday: 8am - 10pm</p>
                <p class="fw-light">Sunday: 8am - 11pm</p>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="text-uppercase fw-bold mb-4" style="font-size: 0.9rem; letter-spacing: 1px;">Get It Fresh</h6>
                
                <form action="#" method="POST">
                    <div class="mb-3">
                        <label for="emailInput" class="form-label fw-light">Email *</label>
                        <input type="email" class="form-control rounded-0 bg-transparent text-white border-white" id="emailInput" required>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input rounded-0 bg-transparent border-white" id="newsletterCheck">
                        <label class="form-check-label fw-light" style="font-size: 0.9rem;" for="newsletterCheck">
                            Yes, subscribe me to your newsletter.
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-white w-100 rounded-0 py-2 fw-bold" 
                            style="background-color: white; color: var(--primary-green); border: none;">
                        SUBSCRIBE NOW
                    </button>
                </form>
            </div>
            
        </div>

        <div class="my-5"></div>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
                <small class="fw-light">&copy; <?php echo date('Y'); ?> by Fresh Market. All rights reserved.</small>
            </div>
            
            <div class="d-flex gap-3">
                <a href="#" class="text-white text-decoration-none fs-5"><i class="fab fa-youtube"></i></a>
                <a href="#" class="text-white text-decoration-none fs-5"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white text-decoration-none fs-5"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/main.js"></script>
</body>
</html>