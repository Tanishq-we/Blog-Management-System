@extends('layouts.admin')

@section('title', 'Edit Blog')
@section('page_title', 'Edit Blog')

@section('content')

<form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data" id="blogForm">
    @csrf
    @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5><i class="bi bi-pencil-square me-2"></i>Edit Blog</h5>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Back
                    </a>
                </div>
                <div class="admin-card-body">

                    <div class="mb-4">
                        <label class="form-label required">Blog Title</label>
                        <input type="text" name="title" id="titleInput"
                               class="form-control admin-input @error('title') is-invalid @enderror"
                               value="{{ old('title', $blog->title) }}"
                               placeholder="Enter blog title..." required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Slug (Auto-generated)</label>
                        <div class="input-group">
                            <span class="input-group-text text-muted">/</span>
                            <input type="text" id="slugPreview" class="form-control admin-input" readonly
                                   value="{{ $blog->slug }}">
                        </div>
                        <small class="text-muted">SEO-friendly URL generated from title</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label required">Short Description</label>
                        <textarea name="short_description" id="shortDesc"
                                  class="form-control admin-input @error('short_description') is-invalid @enderror"
                                  rows="3" maxlength="500" required>{{ old('short_description', $blog->short_description) }}</textarea>
                        <div class="d-flex justify-content-end">
                            <small class="char-counter" id="descCounter">0/500</small>
                        </div>
                        @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label required">Full Content</label>
                        <textarea name="content" id="richEditor" class="@error('content') is-invalid @enderror">{!! old('content', $blog->content) !!}</textarea>
                        @error('content')<div class="invalid-feedback d-block mt-2">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label required">Category</label>
                            <select name="category_id"
                                    class="form-select admin-input @error('category_id') is-invalid @enderror"
                                    required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id', $blog->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">Publish Date</label>
                            <input type="date" name="publish_date"
                                   class="form-control admin-input @error('publish_date') is-invalid @enderror"
                                   value="{{ old('publish_date', $blog->publish_date->format('Y-m-d')) }}"
                                   readonly
                                   required>
                            @error('publish_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-check-circle me-2"></i>Update Blog
                        </button>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary btn-lg">Cancel</a>
                    </div>
                </div>
            </div>
        </div>

    {{-- Image Upload Sidebar --}}
    <div class="col-lg-4">
        <div class="admin-card sticky-top" style="top:90px;">
            <div class="admin-card-header">
                <h5><i class="bi bi-image me-2"></i>Featured Image</h5>
            </div>
            <div class="admin-card-body">
                <div class="image-upload-zone" id="imageUploadZone">
                    <input type="file" name="image" id="imageInput"
                           class="image-file-input @error('image') is-invalid @enderror"
                           accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                    <div class="image-preview-wrapper" id="imagePreviewWrapper">
                        @if($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image)))
                            <img id="imagePreview"
                                 src="{{ asset('uploads/blogs/' . $blog->image) }}"
                                 alt="{{ $blog->title }}"
                                 style="display:block; width:100%; border-radius:8px;">
                            <div class="upload-placeholder" id="uploadPlaceholder" style="display:none;">
                                <i class="bi bi-cloud-upload fs-1"></i>
                                <p>Click to change image</p>
                            </div>
                        @else
                            <img id="imagePreview" src="" alt="" style="display:none;">
                            <div class="upload-placeholder" id="uploadPlaceholder">
                                <i class="bi bi-cloud-upload fs-1"></i>
                                <p>Drag & drop or click to upload</p>
                                <small>JPEG, PNG, GIF, WebP — Max 2MB</small>
                            </div>
                        @endif
                    </div>
                </div>
                @error('image')<div class="invalid-feedback d-block mt-2">{{ $message }}</div>@enderror
                <button type="button" id="clearImage"
                        class="btn btn-sm btn-outline-danger mt-2 w-100 {{ $blog->image ? '' : 'd-none' }}">
                    <i class="bi bi-x-circle me-1"></i>Remove Image
                </button>
                <small class="text-muted d-block mt-2">Leave empty to keep current image</small>

                {{-- Quick Actions --}}
                <hr>
                <div class="d-grid gap-2">
                    <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-outline-info btn-sm">
                        <i class="bi bi-eye me-1"></i>Preview Blog
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>
</form>

@endsection

@push('styles')
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
<script src="{{ asset('js/admin-blog-form.js') }}?v={{ time() }}"></script>
@endpush
