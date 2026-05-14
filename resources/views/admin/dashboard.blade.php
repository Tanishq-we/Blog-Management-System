@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

{{-- Stats Cards --}}
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-widget stat-primary">
            <div class="stat-icon"><i class="bi bi-file-earmark-text"></i></div>
            <div class="stat-info">
                <h3>{{ $totalBlogs }}</h3>
                <p>Total Blogs</p>
            </div>
            <div class="stat-trend">
                <i class="bi bi-arrow-up-right"></i>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-widget stat-success">
            <div class="stat-icon"><i class="bi bi-grid"></i></div>
            <div class="stat-info">
                <h3>{{ $totalCategories }}</h3>
                <p>Categories</p>
            </div>
            <div class="stat-trend">
                <i class="bi bi-arrow-up-right"></i>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-widget stat-warning">
            <div class="stat-icon"><i class="bi bi-eye"></i></div>
            <div class="stat-info">
                <h3>Live</h3>
                <p>Published Today</p>
            </div>
            <div class="stat-trend">
                <i class="bi bi-arrow-up-right"></i>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-widget stat-info">
            <div class="stat-icon"><i class="bi bi-people"></i></div>
            <div class="stat-info">
                <h3>Active</h3>
                <p>System Status</p>
            </div>
            <div class="stat-trend">
                <i class="bi bi-check-circle"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Recent Blogs Table --}}
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="bi bi-clock-history me-2"></i>Recent Blogs</h5>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="admin-card-body p-0">
                <div class="table-responsive">
                    <table class="table admin-table mb-0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBlogs as $blog)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image)))
                                            <img src="{{ asset('uploads/blogs/' . $blog->image) }}" class="table-thumb" alt="">
                                        @else
                                            <div class="table-thumb-placeholder"><i class="bi bi-image"></i></div>
                                        @endif
                                        <span>{{ Str::limit($blog->title, 45) }}</span>
                                    </div>
                                </td>
                                <td><span class="badge-category">{{ $blog->category->name ?? '-' }}</span></td>
                                <td><small>{{ $blog->publish_date->format('M d, Y') }}</small></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-xs btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-xs btn-outline-info" target="_blank">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">No blogs yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Category Breakdown --}}
    <div class="col-lg-4">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h5><i class="bi bi-pie-chart me-2"></i>By Category</h5>
            </div>
            <div class="admin-card-body">
                @foreach($categoriesWithCount as $cat)
                <div class="category-stat-row">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="cat-name">{{ $cat->name }}</span>
                        <span class="cat-count">{{ $cat->blogs_count }}</span>
                    </div>
                    <div class="progress mb-3" style="height:6px;">
                        @php $pct = $totalBlogs > 0 ? ($cat->blogs_count / $totalBlogs) * 100 : 0; @endphp
                        <div class="progress-bar bg-primary" style="width:{{ $pct }}%"></div>
                    </div>
                </div>
                @endforeach

                <div class="mt-3">
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary w-100">
                        <i class="bi bi-plus-circle me-2"></i>Add New Blog
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
