<?php


namespace App\Services;


use App\DTO\ProductData;
use App\Http\Requests\CreateUpdateProductRequest;
use App\Repositories\ProductLocalizationRepository;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ProductService extends ProductData
{
    /** @var ProductRepository $productRepository */
    private $productRepository;
    /** @var ProductLocalizationRepository $productLocalizationRepository */
    private $productLocalizationRepository;

    public function __construct(ProductRepository $productRepository, ProductLocalizationRepository $productLocalizationRepository)
    {
        $this->productRepository = $productRepository;
        $this->productLocalizationRepository = $productLocalizationRepository;
    }

    public function addProductAction(CreateUpdateProductRequest $request): int
    {

        $dto = new ProductData($request);
        $obj = $dto->createProductData($request);
        dd($obj->category_id);

        $newProductId = $this->productRepository->addProduct($dto->createProductData($request));
        dd($newProductId);

        $this->productLocalizationRepository->createProductLocalization($newProductId, 'en', $request['description_en']);
        $this->productLocalizationRepository->createProductLocalization($newProductId, 'ru', $request['description_ru']);

        return $newProductId;
    }

    public function updateProductAction($id, UpdateProductRequest $request): Model
    {
        $requestData = $this->makeProductData($request);
        $this->productRepository->updateProduct($id, $requestData);

        $attributes = [
            'en' => $request->validated()['description_en'],
            'ru' => $request->validated()['description_ru'],
        ];

        $this->productLocalizationRepository->updateProductLocalization($id, $attributes);

        return $this->productRepository->getProduct($id, App::getLocale());
    }

    public function deleteProductAction($productId)
    {
        $this->productLocalizationRepository->deleteProductLocalization($productId);
        return $this->productRepository->deleteProduct($productId);
    }

    private function makeProductData($request): array
    {
        unset($request['description_en']);
        unset($request['description_ru']);
        $newPrice = $request['old_price'] - $request['old_price'] * ($request['sales'] / 100);
        $request['price'] = round($newPrice, 2);

        return $request;
    }
}
