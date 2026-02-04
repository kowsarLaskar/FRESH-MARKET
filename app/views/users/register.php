<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Fresh Market</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FBF9F1;
            height: 100vh; /* Force full viewport height */
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden; /* Prevent body scroll */
        }

        .auth-wrapper {
            width: 100%;
            max-width: 600px; /* Slightly wider to fit side-by-side inputs */
            padding: 10px;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 10px; /* Reduced margin */
            font-size: 1.5rem;
            font-weight: 700;
            color: #1F4D3C;
            text-decoration: none;
            display: block;
        }

        .auth-card {
            background: white;
            padding: 25px 30px; /* Compact padding */
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border: 1px solid #f0f0f0;
        }

        .auth-title {
            text-align: center;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: #666;
            margin-bottom: 2px;
        }

        /* Compact Inputs */
        .form-control, .form-select {
            background-color: #fcfcfc;
            border: 1px solid #e0e0e0;
            padding: 8px 12px; /* Smaller padding */
            font-size: 0.9rem;
            border-radius: 6px;
        }

        .form-control:focus, .form-select:focus {
            background-color: #fff;
            border-color: #1F4D3C;
            box-shadow: none;
        }

        .btn-auth {
            background-color: #1F4D3C;
            color: white;
            width: 100%;
            padding: 10px;
            font-weight: 600;
            margin-top: 15px;
            border: none;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .btn-auth:hover {
            background-color: #15382b;
            color: white;
        }

        .auth-footer {
            text-align: center;
            margin-top: 15px;
            font-size: 0.85rem;
            color: #888;
        }

        .auth-footer a {
            color: #1F4D3C;
            font-weight: 600;
            text-decoration: none;
        }

        .back-link {
            text-align: center;
            display: block;
            margin-top: 10px;
            color: #999;
            font-size: 0.85rem;
            text-decoration: none;
        }

        .invalid-feedback {
            font-size: 0.75rem;
            margin-top: 2px;
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">
        
        <a href="<?php echo URLROOT; ?>" class="brand-logo">
            <i class="fas fa-leaf me-2"></i>FRESH MARKET
        </a>

        <div class="auth-card">
            <h4 class="auth-title">Create Account</h4>
            
            <form action="<?php echo URLROOT; ?>/users/register" method="post">
                
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" placeholder="John Doe">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" placeholder="name@email.com">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                </div>

                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $data['phone']; ?>" placeholder="Mobile No.">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">I am a:</label>
                        <select name="role" class="form-select">
                            <option value="customer" selected>Customer</option>
                            <option value="delivery_boy">Delivery Partner</option>
                        </select>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                    </div>
                </div>

                <button type="submit" class="btn-auth">Register</button>

            </form>

            <div class="auth-footer">
                Already have an account? <a href="<?php echo URLROOT; ?>/users/login">Login here</a>
            </div>
        </div>

        <a href="<?php echo URLROOT; ?>" class="back-link">
            <i class="fas fa-arrow-left me-1"></i> Back to Home
        </a>
    </div>

</body>
</html>