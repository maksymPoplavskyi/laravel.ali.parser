<?php


namespace App\Services;


use App\Repositories\ProductRepository;

abstract class MainService
{
    public function makeQuantityProductOfCategory($categories)
    {
        $categories_count = [];
        foreach ($categories as $category) {
            $categories_count[$category->name] = app(ProductRepository::class)->getQuantityProductOfCategory($category->id);
        }

        return $categories_count;
    }
}
