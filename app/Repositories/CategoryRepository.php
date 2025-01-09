<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contract\categoryRepositoryInterface;

class categoryRepository implements categoryRepositoryInterface
{
    public function getAllCategories()
    {
        return Category::all();
    }
    public function getCategoryBySlug($slug)
    {
        return Category::where('slug', $slug)->first();
    }
}
