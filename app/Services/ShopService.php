<?php


namespace App\Services;


use App\Repositories\ProductRepository;

class ShopService extends MainService
{
    public function addProductAction($request)
    {
        $idAddedProduct = app(ProductRepository::class)->addProductThenReturnId($request);

        return (is_numeric($idAddedProduct)) ? $idAddedProduct : abort(404, 'addProductAction');
    }

    public function updateProductAction($productId, $request) :bool
    {
        $updateResult = app(ProductRepository::class)->updateProduct($productId, $request);
        return ($updateResult) ? true : false;
    }
}
