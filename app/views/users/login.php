<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fresh Market</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FBF9F1;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 400px; /* Narrower for Login */
            padding: 15px;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
            font-weight: 700;
            color: #1F4D3C;
            text-decoration: none;
            display: block;
        }

        .auth-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border: 1px solid #f0f0f0;
        }

        .auth-title {
            text-align: center;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            font-size: 1.4rem;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #666;
            margin-bottom: 5px;
        }

        .form-control {
            background-color: #fcfcfc;
            border: 1px solid #e0e0e0;
            padding: 10px;
            font-size: 0.95rem;
            border-radius: 8px;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #1F4D3C;
            box-shadow: none;
        }

        .btn-auth {
            background-color: #1F4D3C;
            color: white;
            width: 100%;
            padding: 12px;
            font-weight: 600;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .btn-auth:hover {
            background-color: #15382b;
            color: white;
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #888;
        }

        .auth-footer a {
            color: #1F4D3C;
            font-weight: 600;
            text-decoration: none;
        }

        .invalid-feedback {
            font-size: 0.8rem;
            margin-top: 5px;
        }
        
        .alert-danger {
            font-size: 0.9rem;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">
        
        <a href="<?php echo URLROOT; ?>" class="brand-logo">
            <i class="fas fa-leaf me-2"></i>FRESH MARKET
        </a>

        <div class="auth-card">
            <h4 class="auth-title">Welcome Back</h4>

            <?php if(!empty($data['password_err']) && empty($data['email_err'])): ?>
                <div class="alert alert-danger text-center">
                    <?php echo $data['password_err']; ?>
                </div>
            <?php endif; ?>
            
            <form action="<?php echo URLROOT; ?>/users/login" method="post">
                
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" placeholder="Enter your email">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $data['password']; ?>" placeholder="Enter your password">
                </div>

                <button type="submit" class="btn-auth">Login</button>
            </form>

            <div class="auth-footer">
                New here? <a href="<?php echo URLROOT; ?>/users/register">Create an account</a>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="<?php echo URLROOT; ?>" style="color: #999; text-decoration: none; font-size: 0.9rem;">
                <i class="fas fa-arrow-left me-1"></i> Back to Home
            </a>
        </div>
    </div>

</body>
</html>