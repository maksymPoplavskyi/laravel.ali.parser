<?php


namespace App\Services;


use App\Repositories\CategoryRepository;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;

class ProductCategoryService extends MainService
{
    public function makeRelationProductWithCategory($idNewProduct, $categoryId)
    {
        $resultAddRelation = app(ProductCategoryRepository::class)->makeRelationProductWithCategory($idNewProduct, $categoryId);

        if ($resultAddRelation) {
            return app(CategoryRepository::class)->getCategoryById($categoryId);
        } else {
            return abort(404, 'mainService');
        }
    }
}
