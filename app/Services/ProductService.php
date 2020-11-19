<?php


namespace App\Services;


use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function addProductAction($request): Model
    {
        $requestData = $request->validated();
        $newPrice = $requestData['old_price'] - $requestData['old_price'] * ($requestData['sales'] / 100);
        $requestData['price'] = round($newPrice, 2);

        return $this->productRepository->addProduct($requestData);
    }

    public function updateProductAction($id, $request): Model
    {
        $requestData = $request->validated();
        $newPrice = $requestData['old_price'] - $requestData['old_price'] * ($requestData['sales'] / 100);
        $requestData['price'] = round($newPrice, 2);

        $this->productRepository->updateProduct($id, $requestData);

        return $this->productRepository->getProductById($id);
    }

    public function deleteProductAction($productId)
    {
        return $this->productRepository->deleteProduct($productId);
    }
}
