<?php


namespace App\Services;


use App\Repositories\ProductRepository;
use Carbon\Carbon;

class ShopService extends MainService
{
    public function addProductAction($request)
    {
        $idAddedProduct = app(ProductRepository::class)->addProductThenReturnId($request);

        return (is_numeric($idAddedProduct)) ? $idAddedProduct : abort(404);
    }
}
