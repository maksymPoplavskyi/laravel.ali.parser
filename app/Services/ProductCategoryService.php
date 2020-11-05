<?php


namespace App\Services;


use App\Repositories\CategoryRepository;
use App\Repositories\ProductCategoryRepository;

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

    final public function updateRelationProductWithCategory($productId, $categoryId) :void
    {
        $resultUpdateRelation = app(ProductCategoryRepository::class)->updateRelation($productId, $categoryId);

        if ($resultUpdateRelation === null) abort('404', 'updateRelation');
    }
}
