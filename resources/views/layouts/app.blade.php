<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Blog Management System - Latest updates on Admit Cards, Results, Exams, Jobs, and News')">
    <title>@yield('title', 'Blog Management System')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-journal-richtext me-2"></i>
                <span>Blog<span class="text-accent">Hub</span></span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-grid me-1"></i> Categories
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            @php $navCategories = \App\Models\Category::all(); @endphp
                            @foreach($navCategories as $cat)
                                <li><a class="dropdown-item" href="{{ route('home') }}?category={{ $cat->id }}">{{ $cat->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">
                            <i class="bi bi-shield-lock me-1"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ===== MAIN CONTENT ===== --}}
    <main>
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="site-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <h4><i class="bi bi-journal-richtext me-2"></i>Blog<span class="text-accent">Hub</span></h4>
                        <p>Your one-stop destination for the latest updates on Admit Cards, Results, Examinations, Government Jobs, and Breaking News.</p>
                    </div>
                    <div class="footer-social">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('home') }}?category=1">Admit Cards</a></li>
                        <li><a href="{{ route('home') }}?category=2">Results</a></li>
                        <li><a href="{{ route('home') }}?category=3">Exams</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>More</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}?category=4">Jobs</a></li>
                        <li><a href="{{ route('home') }}?category=5">News</a></li>
                        <li><a href="{{ route('admin.login') }}">Admin Panel</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5>Stay Updated</h5>
                    <p>Subscribe to get the latest blog updates directly in your inbox.</p>
                    <div class="footer-subscribe">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email">
                            <button class="btn btn-accent" type="button">
                                <i class="bi bi-send"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} BlogHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- ===== SCROLL TO TOP ===== --}}
    <button id="scrollToTop" class="scroll-to-top" title="Back to top">
        <i class="bi bi-chevron-up"></i>
    </button>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
</body>
</html>
