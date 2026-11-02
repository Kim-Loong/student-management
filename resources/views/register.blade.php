<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Split Screen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-side {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .form-wrapper {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }
        .brand-side {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            min-height: 100vh;
        }
    </style>
</head>
<body>
<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Left Side: Branding (Hidden on mobile) -->
        <div class="col-lg-6 d-none d-lg-flex brand-side">
            <div class="text-center px-5">
                <h1 class="display-4 fw-bold mb-4">Join Us Today</h1>
                <p class="lead">Create your account to unlock all features and personalize your experience.</p>
            </div>
        </div>
        
        <!-- Right Side: Register Form -->
        <div class="col-lg-6 login-side">
            <div class="form-wrapper">
                <h2 class="fw-bold mb-4">Register</h2>
                
                @if($errors->any())
                    <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
                @endif
                
                <form action="{{ url('/register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label text-muted fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control form-control-lg bg-light border-0" placeholder="please input your name" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted fw-semibold">Email address</label>
                        <input type="email" name="email" class="form-control form-control-lg bg-light border-0" placeholder="example@gmail.com" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg bg-light border-0" placeholder="•••••" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">Register</button>
                </form>
                
                <div class="text-center mt-4">
                    <span class="text-muted">Already registered?</span> 
                    <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>