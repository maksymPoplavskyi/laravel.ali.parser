<?php


namespace App\Services;


use App\DTO\ProductDataDTO;
use App\Http\Requests\CreateUpdateProductRequest;
use App\Repositories\ProductLocalizationRepository;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ProductService
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

//        $q = ProductDataDTO::createProductLocalizationData($request->get('category_id'),
//            $request->get('description_en'),
//            $request->get('description_ru'));
//        dd($q);
//        dd($request);
//        $requestData = $this->makeProductData($request->validated());

        $dto = new ProductDataDTO();
        $productData = $dto->createProductData($request);
        dd($productData);

        $newProductId = $this->productRepository->addProduct(ProductDataDTO::createProductData($request));
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
