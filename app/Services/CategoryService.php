<?php


namespace App\Services;


use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    public function getCategoryById($id): Category
    {
        return app(CategoryRepository::class)->getCategoryById($id);
    }
}
