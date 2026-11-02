<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile - Split Screen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-side {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem 0;
        }
        .form-wrapper {
            width: 100%;
            max-width: 450px;
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
    <div class="row g-0 min-vh-100">
        <!-- Left Side: Branding (Hidden on mobile) -->
        <div class="col-lg-6 d-none d-lg-flex brand-side">
            <div class="text-center px-5">
                <h1 class="display-4 fw-bold mb-4">Account Settings</h1>
                <p class="lead">Manage your personal profile details and update your security credentials to keep your account secure.</p>
            </div>
        </div>
        
        <!-- Right Side: Edit Profile Form -->
        <div class="col-lg-6 form-side">
            <div class="form-wrapper">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0">Edit Profile</h2>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm">← Dashboard</a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success py-2 border-0 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger py-2 border-0 shadow-sm">
                        {{ $errors->first() }}
                    </div>
                @endif
                
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control form-control-lg bg-light border-0" value="{{ auth()->user()->name }}" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label text-muted fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-lg bg-light border-0" value="{{ auth()->user()->email }}" required>
                    </div>
                    
                    <hr class="my-4 text-muted">
                    
                    <p class="text-muted small fw-medium mb-3">
                        <i class="bi bi-info-circle me-1"></i> Leave password fields blank if you do not want to change your password.
                    </p>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold">New Password</label>
                        <input type="password" name="password" class="form-control form-control-lg bg-light border-0" placeholder="••••••••">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label text-muted fw-semibold">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control form-control-lg bg-light border-0" placeholder="••••••••">
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg w-100">Save Changes</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
</body>
</html>