<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'image',
        'category_id',
        'publish_date',
    ];

    protected function casts(): array
    {
        return [
            'publish_date' => 'date',
        ];
    }

    /**
     * Get the category that this blog belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the blog image URL.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && file_exists(public_path('uploads/blogs/' . $this->image))) {
            return asset('uploads/blogs/' . $this->image);
        }
        return asset('images/default-blog.jpg');
    }

    /**
     * Get related blogs from the same category.
     */
    public function relatedBlogs(int $limit = 3)
    {
        return static::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->latest('publish_date')
            ->limit($limit)
            ->get();
    }

    /**
     * Scope: published blogs only.
     */
    public function scopePublished($query)
    {
        return $query->where('publish_date', '<=', now());
    }
}
