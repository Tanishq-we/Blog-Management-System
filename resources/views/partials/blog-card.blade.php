{{-- Blog Card Partial - Rendered via AJAX --}}
<div class="col-lg-4 col-md-6 mb-4 blog-card-wrapper" data-aos="fade-up">
    <article class="blog-card">
        <div class="blog-card-image">
            @if($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image)))
                <img src="{{ asset('uploads/blogs/' . $blog->image) }}" alt="{{ $blog->title }}" loading="lazy">
            @else
                <div class="blog-card-placeholder">
                    <i class="bi bi-journal-richtext"></i>
                </div>
            @endif
            <div class="blog-card-category">
                <span>{{ $blog->category->name ?? 'Uncategorized' }}</span>
            </div>
        </div>
        <div class="blog-card-body">
            <div class="blog-card-meta">
                <span><i class="bi bi-calendar3 me-1"></i>{{ $blog->publish_date->format('M d, Y') }}</span>
            </div>
            <h3 class="blog-card-title">
                <a href="{{ route('blog.show', $blog->slug) }}">{{ Str::limit($blog->title, 65) }}</a>
            </h3>
            <p class="blog-card-text">{{ Str::limit($blog->short_description, 120) }}</p>
            <a href="{{ route('blog.show', $blog->slug) }}" class="blog-card-link">
                Read More <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </article>
</div>
