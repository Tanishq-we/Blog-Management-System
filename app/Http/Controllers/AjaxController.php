<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    /**
     * Filter blogs via AJAX.
     * Supports: search, category filter, date filter, pagination.
     */
    public function filterBlogs(Request $request): JsonResponse
    {
        $query = Blog::with('category')->published();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('short_description', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category') && $request->input('category') !== 'all') {
            $query->where('category_id', $request->input('category'));
        }

        // Date filter
        if ($request->filled('date_from')) {
            $query->where('publish_date', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->where('publish_date', '<=', $request->input('date_to'));
        }

        // Sort order
        $sortBy = $request->input('sort', 'latest');
        if ($sortBy === 'oldest') {
            $query->oldest('publish_date');
        } else {
            $query->latest('publish_date');
        }

        $blogs = $query->paginate(9);

        // Render blog cards as HTML
        $html = '';
        if ($blogs->count() > 0) {
            foreach ($blogs as $blog) {
                $html .= view('partials.blog-card', compact('blog'))->render();
            }
        }

        return response()->json([
            'success' => true,
            'html' => $html,
            'total' => $blogs->total(),
            'current_page' => $blogs->currentPage(),
            'last_page' => $blogs->lastPage(),
            'has_more' => $blogs->hasMorePages(),
            'pagination' => $blogs->links('partials.pagination')->render(),
        ]);
    }

    /**
     * Search blogs via AJAX (live search).
     */
    public function searchBlogs(Request $request): JsonResponse
    {
        $search = $request->input('q', '');

        if (strlen($search) < 2) {
            return response()->json([
                'success' => true,
                'results' => [],
                'count' => 0,
            ]);
        }

        $blogs = Blog::with('category')
            ->published()
            ->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('short_description', 'LIKE', "%{$search}%");
            })
            ->latest('publish_date')
            ->limit(5)
            ->get()
            ->map(function ($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'short_description' => Str::limit($blog->short_description, 80),
                    'category' => $blog->category->name ?? 'Uncategorized',
                    'publish_date' => $blog->publish_date->format('M d, Y'),
                    'image_url' => $blog->image_url,
                    'url' => route('blog.show', $blog->slug),
                ];
            });

        return response()->json([
            'success' => true,
            'results' => $blogs,
            'count' => $blogs->count(),
        ]);
    }

    /**
     * Get all categories for filter dropdown.
     */
    public function getCategories(): JsonResponse
    {
        $categories = Category::withCount('blogs')
            ->orderBy('name')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'blogs_count' => $category->blogs_count,
                ];
            });

        return response()->json([
            'success' => true,
            'categories' => $categories,
        ]);
    }
}
