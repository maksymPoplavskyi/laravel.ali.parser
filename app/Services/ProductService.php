<?php


namespace App\Services;


use App\Repositories\ProductLocalizationRepository;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ProductService
{
    private $productRepository;
    private $productLocalizationRepository;

    public function __construct(ProductRepository $productRepository, ProductLocalizationRepository $productLocalizationRepository)
    {
        $this->productRepository = $productRepository;
        $this->productLocalizationRepository = $productLocalizationRepository;
    }

    public function addProductAction($request): int
    {
        $requestData = $this->makeProductData($request);

        $newProductId = $this->productRepository->addProduct($requestData);
        $this->productLocalizationRepository->createProductLocalization($newProductId, 'en', $request->validated()['description_en']);
        $this->productLocalizationRepository->createProductLocalization($newProductId, 'ru', $request->validated()['description_ru']);

        return $newProductId;
    }

    public function updateProductAction($id, $request): Model
    {
        $requestData = $this->makeProductData($request);
        $this->productRepository->updateProduct($id, $requestData);

        $attributes = [
            'en' => $request->validated()['description_en'],
            'ru' => $request->validated()['description_ru'],
        ];

        $this->productLocalizationRepository->updateProductLocalization($id, $attributes);

        return $this->productRepository->getProductById($id, App::getLocale());
    }

    public function deleteProductAction($productId)
    {
        $this->productLocalizationRepository->deleteProductLocalization($productId);
        return $this->productRepository->deleteProduct($productId);
    }

    private function makeProductData($request): array
    {
        $requestData = $request->validated();
        unset($requestData['description_en']);
        unset($requestData['description_ru']);
        $newPrice = $requestData['old_price'] - $requestData['old_price'] * ($requestData['sales'] / 100);
        $requestData['price'] = round($newPrice, 2);

        return $requestData;
    }
}
