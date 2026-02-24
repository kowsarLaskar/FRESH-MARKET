<?php require_once '../app/views/includes/header.php'; ?>

<style>
  /* --- MINIMAL FORM STYLES --- */
  .form-control-minimal {
    border: none;
    border-bottom: 1px solid #ccc;
    border-radius: 0;
    padding: 15px 0;
    background: transparent;
    transition: all 0.3s;
  }

  .form-control-minimal:focus {
    box-shadow: none;
    border-bottom-color: #1F4D3C;
    background: transparent;
  }

  /* Select Dropdown Styling */
  select.form-control-minimal {
    cursor: pointer;
    color: #555;
  }

  .btn-minimal {
    background-color: #1c1c1c;
    color: white;
    padding: 12px 40px;
    border-radius: 0;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 1px;
    border: none;
    margin-top: 20px;
    transition: background-color 0.3s;
  }

  .btn-minimal:hover {
    background-color: #1F4D3C;
    color: white;
  }

  /* --- LAYOUT TYPOGRAPHY --- */
  .contact-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #999;
    margin-bottom: 5px;
    display: block;
    font-weight: 600;
  }

  .contact-value {
    font-size: 1.1rem;
    color: #1c1c1c;
    font-weight: 400;
    text-decoration: none;
    display: block;
    margin-bottom: 35px;
    line-height: 1.4;
  }

  .contact-value:hover {
    color: #1F4D3C;
  }

  .page-title {
    font-weight: 700;
    font-size: 2.5rem;
    color: #1c1c1c;
    margin-bottom: 1rem;
  }

  .page-desc {
    font-size: 1rem;
    color: #666;
    margin-bottom: 3rem;
    max-width: 400px;
  }
</style>

<div class="container py-5 my-5">

  <div class="row gx-lg-5">

    <div class="col-lg-4 mb-5 mb-lg-0">
      <h1 class="page-title">Contact Us</h1>
      <p class="page-desc">
        We value your feedback. Whether you have a suggestion, a complaint, or just want to say hello, we are listening.
      </p>

      <div class="mt-5">
        <span class="contact-label">Address</span>
        <span class="contact-value"><?php echo $data['address']; ?></span>

        <span class="contact-label">Email Support</span>
        <a href="mailto:<?php echo $data['email']; ?>" class="contact-value">
          <?php echo $data['email']; ?>
        </a>

        <span class="contact-label">Customer Care</span>
        <a href="tel:<?php echo $data['phone']; ?>" class="contact-value">
          <?php echo $data['phone']; ?>
        </a>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="ps-lg-5">
        <h4 class="mb-4 fw-bold" style="color:#1F4D3C;">Send Feedback</h4>

        <form action="#" method="POST">
          <div class="row">
            <div class="col-md-6 mb-4">
              <input type="text" name="name" class="form-control form-control-minimal" placeholder="Your Name" required>
            </div>
            <div class="col-md-6 mb-4">
              <input type="email" name="email" class="form-control form-control-minimal" placeholder="Your Email"
                required>
            </div>
          </div>

          <div class="mb-4">
            <select name="subject" class="form-control form-control-minimal" required>
              <option value="" selected disabled>Select Subject</option>
              <option value="General Inquiry">General Inquiry</option>
              <option value="Order Issue">Order Issue</option>
              <option value="Feedback/Suggestion">Feedback / Suggestion</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="mb-4">
            <textarea name="message" class="form-control form-control-minimal" rows="5"
              placeholder="How can we help you? Or tell us what you think..." required></textarea>
          </div>

          <button type="submit" class="btn btn-minimal">Submit Feedback</button>
        </form>
      </div>
    </div>

  </div>
</div>

<?php require_once '../app/views/includes/footer.php'; ?>