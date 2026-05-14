@extends('layouts.app')

@section('title', $blog->title . ' - BlogHub')
@section('meta_description', $blog->short_description)

@section('content')

{{-- ===== BREADCRUMB ===== --}}
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door me-1"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('home') }}?category={{ $blog->category_id }}">{{ $blog->category->name ?? 'Blog' }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ===== BLOG DETAIL ===== --}}
<section class="blog-detail-section">
    <div class="container">
        <div class="row g-4">

            {{-- ===== MAIN CONTENT ===== --}}
            <div class="col-lg-8">
                <article class="blog-detail-card">

                    {{-- Category + Date --}}
                    <div class="blog-detail-meta">
                        <span class="blog-category-badge">
                            <i class="bi bi-tag me-1"></i>{{ $blog->category->name ?? 'Uncategorized' }}
                        </span>
                        <span class="blog-date">
                            <i class="bi bi-calendar3 me-1"></i>{{ $blog->publish_date->format('F d, Y') }}
                        </span>
                    </div>

                    {{-- Title --}}
                    <h1 class="blog-detail-title">{{ $blog->title }}</h1>

                    {{-- Short Description --}}
                    <p class="blog-detail-intro">{{ $blog->short_description }}</p>

                    {{-- Featured Image --}}
                    @if($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image)))
                        <div class="blog-detail-image">
                            <img src="{{ asset('uploads/blogs/' . $blog->image) }}"
                                 alt="{{ $blog->title }}"
                                 class="img-fluid rounded-3">
                        </div>
                    @else
                        <div class="blog-detail-image-placeholder">
                            <i class="bi bi-journal-richtext"></i>
                        </div>
                    @endif

                    {{-- Full Content --}}
                    <div class="blog-detail-content">
                        {!! $blog->content !!}
                    </div>

                    {{-- Share + Back --}}
                    <div class="blog-detail-footer">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Blogs
                        </a>
                        <div class="share-buttons">
                            <span>Share:</span>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                               class="share-btn twitter" target="_blank">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                               class="share-btn facebook" target="_blank">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}"
                               class="share-btn whatsapp" target="_blank">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <button class="share-btn copy" onclick="copyUrl()" title="Copy link">
                                <i class="bi bi-link-45deg"></i>
                            </button>
                        </div>
                    </div>
                </article>
            </div>

            {{-- ===== SIDEBAR ===== --}}
            <div class="col-lg-4">

                {{-- Category Filter Widget --}}
                <div class="sidebar-widget">
                    <h4 class="widget-title"><i class="bi bi-grid me-2"></i>Categories</h4>
                    @php $sidebarCategories = \App\Models\Category::withCount('blogs')->get(); @endphp
                    <ul class="category-list">
                        @foreach($sidebarCategories as $cat)
                            <li>
                                <a href="{{ route('home') }}?category={{ $cat->id }}">
                                    <span>{{ $cat->name }}</span>
                                    <span class="badge bg-primary rounded-pill">{{ $cat->blogs_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Related Blogs Widget --}}
                @if($relatedBlogs->count() > 0)
                <div class="sidebar-widget">
                    <h4 class="widget-title"><i class="bi bi-collection me-2"></i>Related Blogs</h4>
                    <div class="related-blogs">
                        @foreach($relatedBlogs as $related)
                            <a href="{{ route('blog.show', $related->slug) }}" class="related-blog-item">
                                <div class="related-blog-img">
                                    @if($related->image && file_exists(public_path('uploads/blogs/' . $related->image)))
                                        <img src="{{ asset('uploads/blogs/' . $related->image) }}" alt="{{ $related->title }}">
                                    @else
                                        <div class="related-img-placeholder"><i class="bi bi-journal-richtext"></i></div>
                                    @endif
                                </div>
                                <div class="related-blog-info">
                                    <h6>{{ Str::limit($related->title, 55) }}</h6>
                                    <small><i class="bi bi-calendar3 me-1"></i>{{ $related->publish_date->format('M d, Y') }}</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

{{-- ===== IMAGE LIGHTBOX MODAL ===== --}}
<div class="modal fade" id="imageLightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 pb-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="background-color: rgba(255,255,255,0.8); border-radius: 50%; padding: 10px;"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="" id="lightboxImage" class="img-fluid rounded shadow-lg" style="max-height: 85vh; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function copyUrl() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const btn = document.querySelector('.share-btn.copy');
        const icon = btn.querySelector('i');
        icon.className = 'bi bi-check-lg';
        setTimeout(() => { icon.className = 'bi bi-link-45deg'; }, 2000);
    });
}

// Image Lightbox Script
document.addEventListener('DOMContentLoaded', function() {
    const blogImages = document.querySelectorAll('.blog-detail-content img, .blog-detail-image img');
    const lightboxModal = new bootstrap.Modal(document.getElementById('imageLightboxModal'));
    const lightboxImage = document.getElementById('lightboxImage');

    blogImages.forEach(img => {
        // Enforce max width directly to ensure layout doesn't break
        img.style.maxWidth = '100%';
        img.style.height = 'auto';
        img.style.cursor = 'pointer';
        
        // Remove hardcoded dimensions set by editors
        img.removeAttribute('width');
        img.removeAttribute('height');

        img.addEventListener('click', function() {
            lightboxImage.src = this.src;
            lightboxModal.show();
        });
    });
});
</script>
@endpush
