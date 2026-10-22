<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { width: 100%; max-width: 450px; border-radius: 8px; border: 1px solid #e0e0e0; }
        .card-header { background: transparent; border-bottom: none; text-align: center; font-size: 28px; font-weight: 500; padding-top: 25px; }
    </style>
</head>
<body>
<div class="card shadow-sm">
    <div class="card-header">Register Form</div>[cite: 5]
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
        @endif
        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>[cite: 5]
                <input type="text" name="name" class="form-control" placeholder="please input your name" required>[cite: 5]
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>[cite: 5]
                <input type="email" name="email" class="form-control" placeholder="adminwoman@gmail.com" required>[cite: 5]
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>[cite: 5]
                <input type="password" name="password" class="form-control" placeholder="•••••" required>[cite: 5]
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 mt-2">Register</button>[cite: 5]
        </form>
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none">Already registered? Login</a>
        </div>
    </div>
</div>
</body>
</html>