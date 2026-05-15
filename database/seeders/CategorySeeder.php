<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Admit Card',
            'Results',
            'Exams',
            'Jobs',
            'News',
            'Scholarships',
            'Syllabus',
            'Answer Key',
            'Admission',
            'Government Jobs',
            'Study Material',
            'Current Affairs',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => Str::slug($category)],
                ['name' => $category]
            );
        }
    }
}
