<?php require_once '../app/views/includes/header.php'; ?>

<style>
  /* --- TYPOGRAPHY & LAYOUT --- */
  .page-header {
    padding: 80px 0 50px;
    text-align: center;
    max-width: 700px;
    margin: 0 auto;
  }

  .page-title {
    font-weight: 700;
    color: #1F4D3C;
    font-size: 2.5rem;
    margin-bottom: 15px;
    letter-spacing: -0.5px;
  }

  .page-subtitle {
    color: #666;
    font-size: 1.1rem;
    font-weight: 300;
    line-height: 1.6;
  }

  /* --- STORY SECTION --- */
  .story-img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 4px;
    filter: brightness(0.95);
  }

  .section-title {
    font-weight: 700;
    color: #1c1c1c;
    margin-bottom: 20px;
    font-size: 1.75rem;
  }

  .text-body-relaxed {
    color: #555;
    line-height: 1.8;
    font-size: 1rem;
    margin-bottom: 20px;
  }

  /* --- FOUNDER SECTION --- */
  .founder-section {
    background-color: #FBF9F1;
    padding: 60px 0;
    margin-top: 60px;
    text-align: center;
  }

  .founder-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 20px;
    border: 4px solid #fff;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  }

  .founder-name {
    font-weight: 700;
    font-size: 1.5rem;
    color: #1F4D3C;
    margin-bottom: 5px;
  }

  .founder-role {
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 0.8rem;
    color: #999;
    margin-bottom: 20px;
  }

  .founder-quote {
    font-style: italic;
    color: #555;
    max-width: 600px;
    margin: 0 auto;
    font-size: 1.1rem;
  }

  /* --- VALUES GRID --- */
  .value-item {
    padding: 20px;
    text-align: center;
  }

  .value-icon {
    font-size: 2rem;
    color: #1F4D3C;
    margin-bottom: 15px;
    opacity: 0.8;
  }

  .value-head {
    font-weight: 600;
    color: #1c1c1c;
    margin-bottom: 10px;
  }

  .value-desc {
    font-size: 0.9rem;
    color: #666;
  }
</style>

<div class="container">

  <div class="page-header">
    <h1 class="page-title">About Fresh Market</h1>
    <p class="page-subtitle">Bridging the gap between local farmers and your kitchen table with quality you can taste.
    </p>
  </div>

  <div class="row align-items-center mb-5">
    <div class="col-lg-6 mb-4 mb-lg-0">
      <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=2574&auto=format&fit=crop"
        alt="Our Farm" class="story-img">
    </div>
    <div class="col-lg-6 ps-lg-5">
      <h3 class="section-title">Simply Fresh.</h3>
      <p class="text-body-relaxed">
        It started with a simple question: why does grocery shopping have to be complicated? We wanted to create a place
        where quality isn't a luxury, but a standard.
      </p>
      <p class="text-body-relaxed">
        By cutting out the middlemen and working directly with local growers, we ensure that what you eat is as close to
        nature as possible. No hidden warehouses, no long shelf lives—just real food, delivered fast.
      </p>
    </div>
  </div>

  <div class="row g-4 border-top border-bottom py-5 my-5">
    <div class="col-md-4">
      <div class="value-item">
        <div class="value-icon"><i class="fas fa-leaf"></i></div>
        <h5 class="value-head">100% Organic</h5>
        <p class="value-desc">Sourced responsibly from certified partners.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="value-item">
        <div class="value-icon"><i class="fas fa-shipping-fast"></i></div>
        <h5 class="value-head">Fast Delivery</h5>
        <p class="value-desc">From our store to your door in minutes.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="value-item">
        <div class="value-icon"><i class="fas fa-hand-holding-heart"></i></div>
        <h5 class="value-head">Community First</h5>
        <p class="value-desc">Supporting local farmers and fair wages.</p>
      </div>
    </div>
  </div>

</div>

<div class="founder-section">
  <div class="container">
    <img src="https://ui-avatars.com/api/?name=Kowsar+Laskar&background=1F4D3C&color=fff&size=128" alt="Kowsar Laskar"
      class="founder-img">
    <div class="founder-name">Kowsar Laskar</div>
    <div class="founder-role">Founder & CEO</div>
    <p class="founder-quote">
      "We believe that good food is the foundation of a happy life. Our mission is to make fresh, healthy produce
      accessible to everyone in our community."
    </p>
  </div>
</div>

<?php require_once '../app/views/includes/footer.php'; ?>