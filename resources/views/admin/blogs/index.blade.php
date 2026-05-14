@extends('layouts.admin')

@section('title', 'All Blogs')
@section('page_title', 'All Blogs')

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-file-earmark-text me-2"></i>Blog Posts ({{ $blogs->total() }})</h5>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i>Add New Blog
        </a>
    </div>
    <div class="admin-card-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th width="40">#</th>
                        <th>Blog</th>
                        <th>Category</th>
                        <th>Publish Date</th>
                        <th>Slug</th>
                        <th width="130">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $index => $blog)
                    <tr>
                        <td>{{ $blogs->firstItem() + $index }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image)))
                                    <img src="{{ asset('uploads/blogs/' . $blog->image) }}" class="table-thumb" alt="">
                                @else
                                    <div class="table-thumb-placeholder"><i class="bi bi-image"></i></div>
                                @endif
                                <div>
                                    <div class="fw-600">{{ Str::limit($blog->title, 50) }}</div>
                                    <small class="text-muted">{{ Str::limit($blog->short_description, 60) }}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge-category">{{ $blog->category->name ?? '-' }}</span></td>
                        <td>
                            <span class="text-nowrap">{{ $blog->publish_date->format('d M Y') }}</span>
                        </td>
                        <td>
                            <small class="text-muted font-mono">/{{ Str::limit($blog->slug, 30) }}</small>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('blog.show', $blog->slug) }}"
                                   class="btn btn-xs btn-outline-info" target="_blank" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.blogs.edit', $blog) }}"
                                   class="btn btn-xs btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-xs btn-outline-danger delete-btn"
                                        data-id="{{ $blog->id }}"
                                        data-title="{{ $blog->title }}"
                                        data-url="{{ route('admin.blogs.destroy', $blog) }}"
                                        title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-journal-x fs-1 d-block mb-2"></i>
                            No blogs found. <a href="{{ route('admin.blogs.create') }}">Add your first blog</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($blogs->hasPages())
    <div class="admin-card-footer">
        {{ $blogs->links() }}
    </div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content admin-modal">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete:</p>
                <p class="fw-600" id="deleteBlogTitle"></p>
                <p class="text-danger small"><i class="bi bi-exclamation-circle me-1"></i>This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Delete Blog
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.querySelectorAll('.delete-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const title = this.getAttribute('data-title');
        const url = this.getAttribute('data-url');
        document.getElementById('deleteBlogTitle').textContent = '"' + title + '"';
        document.getElementById('deleteForm').setAttribute('action', url);
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    });
});
</script>
@endpush
