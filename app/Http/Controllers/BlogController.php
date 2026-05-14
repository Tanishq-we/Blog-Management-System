<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display the blog listing page.
     */
    public function index()
    {
        $blogs = Blog::with('category')
            ->published()
            ->latest('publish_date')
            ->paginate(9);

        $categories = Category::withCount('blogs')->get();

        return view('frontend.index', compact('blogs', 'categories'));
    }

    /**
     * Display a single blog post.
     */
    public function show(string $slug)
    {
        $blog = Blog::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedBlogs = $blog->relatedBlogs(3);

        return view('frontend.show', compact('blog', 'relatedBlogs'));
    }
}
