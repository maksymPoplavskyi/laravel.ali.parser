<?php


namespace App\Services;


use App\Repositories\CategoryRepository;

class CategoryService extends MainService
{
    public function getCategoryById($id) :object
    {
        return app(CategoryRepository::class)->getCategoryById($id);
    }
}
