@extends('layouts.app')

@section('title', 'Latest Blogs - BlogHub')
@section('meta_description', 'Browse the latest Admit Cards, Results, Exams, Jobs, and News updates on BlogHub.')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="hero-section">
    <div class="hero-bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    <div class="container">
        <div class="row align-items-center min-vh-40">
            <div class="col-lg-7 hero-text">
                <span class="hero-badge"><i class="bi bi-lightning-fill me-1"></i>Live Updates</span>
                <h1 class="hero-title">Your Gateway to <span class="gradient-text">Latest Updates</span></h1>
                <p class="hero-subtitle">Stay informed with the latest Admit Cards, Results, Exams, Government Jobs, and Breaking News — all in one place.</p>

                {{-- Category Pills --}}
                <div class="category-pills">
                    <button class="category-pill active" data-category="all">All</button>
                    @foreach($categories as $cat)
                        <button class="category-pill" data-category="{{ $cat->id }}">
                            {{ $cat->name }}
                            <span class="pill-count">{{ $cat->blogs_count }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-end">
                <div class="hero-stats">
                    <div class="stat-card">
                        <i class="bi bi-newspaper"></i>
                        <span class="stat-number">{{ $blogs->total() }}+</span>
                        <span class="stat-label">Articles</span>
                    </div>
                    <div class="stat-card">
                        <i class="bi bi-grid-3x3-gap"></i>
                        <span class="stat-number">{{ $categories->count() }}</span>
                        <span class="stat-label">Categories</span>
                    </div>
                    <div class="stat-card">
                        <i class="bi bi-clock-history"></i>
                        <span class="stat-number">Daily</span>
                        <span class="stat-label">Updates</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== FILTER & SEARCH SECTION ===== --}}
<section class="filter-section">
    <div class="container">
        <div class="filter-bar">
            <div class="row g-3 align-items-center">
                {{-- Search --}}
                <div class="col-lg-4 col-md-6">
                    <div class="search-box">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" id="blogSearch" class="form-control" placeholder="Search blogs..." autocomplete="off">
                        <div id="searchDropdown" class="search-dropdown"></div>
                    </div>
                </div>

                {{-- Category Filter --}}
                <div class="col-lg-3 col-md-6">
                    <select id="categoryFilter" class="form-select filter-select">
                        <option value="all">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }} ({{ $cat->blogs_count }})</option>
                        @endforeach
                    </select>
                </div>

                {{-- Date From --}}
                <div class="col-lg-2 col-md-6">
                    <input type="date" id="dateFrom" class="form-control filter-select" placeholder="From Date">
                </div>

                {{-- Date To --}}
                <div class="col-lg-2 col-md-6">
                    <input type="date" id="dateTo" class="form-control filter-select" placeholder="To Date">
                </div>

                {{-- Reset --}}
                <div class="col-lg-1 col-md-12">
                    <button id="resetFilters" class="btn btn-outline-secondary w-100" title="Reset Filters">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                </div>
            </div>

            {{-- Results Info --}}
            <div class="filter-info mt-3">
                <span id="resultsCount" class="results-count">
                    Showing <strong>{{ $blogs->total() }}</strong> articles
                </span>
                <div class="sort-options">
                    <label>Sort:</label>
                    <select id="sortOrder" class="form-select form-select-sm">
                        <option value="latest">Latest First</option>
                        <option value="oldest">Oldest First</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== BLOG LISTING SECTION ===== --}}
<section class="blogs-section">
    <div class="container">

        {{-- Loading Spinner --}}
        <div id="loadingSpinner" class="loading-spinner" style="display:none;">
            <div class="spinner-wrapper">
                <div class="spinner-border text-primary" role="status"></div>
                <p>Loading blogs...</p>
            </div>
        </div>

        {{-- Blog Grid --}}
        <div class="row" id="blogGrid">
            @forelse($blogs as $blog)
                @include('partials.blog-card', compact('blog'))
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-journal-x"></i>
                        <h4>No blogs found</h4>
                        <p>There are no blog posts yet. Check back soon!</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div id="paginationWrapper">
            {{ $blogs->links('partials.pagination') }}
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/blog-filter.js') }}"></script>
<script>
    // Pre-select category from URL query string
    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        const cat = urlParams.get('category');
        if (cat) {
            $('#categoryFilter').val(cat);
            $('.category-pill[data-category="' + cat + '"]').addClass('active');
            $('.category-pill[data-category="all"]').removeClass('active');
            BlogFilter.fetch();
        }
    });
</script>
@endpush
