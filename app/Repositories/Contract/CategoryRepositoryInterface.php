<?php

namespace App\Repositories\Contract;

interface categoryRepositoryInterface
{
    public function getAllCategories();
    public function getCategoryBySlug($slug);
}
