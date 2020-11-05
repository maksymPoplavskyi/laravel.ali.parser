<?php


namespace App\Services;


use App\Repositories\ProductRepository;

class ShopService extends MainService
{
    public function addProductAction($request)
    {
        $AddedProductId = app(ProductRepository::class)->addProductThenReturnId($request);

        return (is_numeric($AddedProductId)) ? $AddedProductId : abort(404, 'addProductAction');
    }

    public function updateProductAction($productId, $request): bool
    {
        return app(ProductRepository::class)->updateProduct($productId, $request);
    }

    public function deleteProductAction($productId)
    {
        return app(ProductRepository::class)->deleteProduct($productId);
    }
}
