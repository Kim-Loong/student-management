<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .welcome-side {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .content-wrapper {
            width: 100%;
            max-width: 480px;
            padding: 2rem;
        }
        .brand-side {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }
        .link-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            transition: all 0.2s ease-in-out;
            background-color: #f8f9fa;
        }
        .link-card:hover {
            border-color: #0d6efd;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            transform: translateY(-2px);
        }
        .link-icon {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            border-radius: 8px;
            margin-right: 1rem;
        }
    </style>
</head>
<body>
<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Left Side: Branding -->
        <div class="col-lg-6 d-none d-lg-flex brand-side">
            <div class="text-center px-5 position-relative z-1">
                <h1 class="display-3 fw-bold mb-4">{{ config('app.name', 'Laravel') }}</h1>
                <p class="lead mb-5">Build something amazing today.</p>
            </div>
            <!-- Abstract background circles for aesthetic flair -->
            <div style="position: absolute; width: 600px; height: 600px; background: rgba(255,255,255,0.05); border-radius: 50%; top: -100px; left: -100px;"></div>
            <div style="position: absolute; width: 400px; height: 400px; background: rgba(255,255,255,0.08); border-radius: 50%; bottom: -50px; right: -50px;"></div>
        </div>
        
        <!-- Right Side: Content & Auth -->
        <div class="col-lg-6 welcome-side">
            <div class="content-wrapper">
                
                <!-- Auth Navigation -->
                @if (Route::has('login'))
                    <div class="d-flex justify-content-end gap-2 mb-5">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary px-4">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary px-4">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary px-4">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif

                <!-- Main Content -->
                <h2 class="fw-bold mb-2">Let's get started</h2>
                <p class="text-muted mb-4">With so many options available to you, we suggest you start with the following:</p>
                
                <div class="d-flex flex-column mb-4">
                    <a href="https://laravel.com/docs" target="_blank" class="link-card">
                        <div class="link-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Read the Documentation</h6>
                        </div>
                    </a>
                    
                    <a href="https://laracasts.com" target="_blank" class="link-card">
                        <div class="link-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Watch video tutorials at Laracasts</h6>
                        </div>
                    </a>

                    <a href="https://cloud.laravel.com" target="_blank" class="link-card">
                        <div class="link-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.5 19C19.9853 19 22 16.9853 22 14.5C22 12.1643 20.218 10.2435 17.9392 10.024C17.4338 6.64335 14.5126 4 11 4C7.13401 4 4 7.13401 4 11C4 11.2366 4.01174 11.4704 4.03457 11.7006C1.77121 12.1691 0 14.1332 0 16.5C0 19.5376 2.46243 22 5.5 22H17.5C18.4239 22 19.2965 21.7825 20.0617 21.3995"></path></svg>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Deploy now</h6>
                        </div>
                    </a>
                </div>
                
                <!-- Footer Info -->
                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                    <span class="text-muted small fw-medium">Laravel v{{ app()->version() }}</span>
                    <a href="https://github.com/laravel/framework/blob/13.x/CHANGELOG.md" target="_blank" class="text-decoration-none small fw-medium">View changelog →</a>
                </div>
                
            </div>
        </div>
    </div>
</div>
</body>
</html>