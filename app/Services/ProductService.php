<?php


namespace App\Services;


use App\DTO\ProductData;
use App\Http\Requests\CreateUpdateProductRequest;
use App\Repositories\ProductLocalizationRepository;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;

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

        $dto = new ProductData($request);
        $attributes = $this->makeProductData($dto);

        $newProductId = $this->productRepository->addProduct($attributes);

        $this->productLocalizationRepository->createProductLocalization($newProductId, 'en', $dto->getDescriptionEn());
        $this->productLocalizationRepository->createProductLocalization($newProductId, 'ru', $dto->getDescriptionRu());

        return $newProductId;
    }

    public function updateProductAction($product, CreateUpdateProductRequest $request): Model
    {
        $dto = new ProductData($request);
        $attributes = $this->makeProductData($dto);

        $this->productRepository->updateProduct($product->id, $attributes);

        $langData = [
            'en' => $dto->getDescriptionEn(),
            'ru' => $dto->getDescriptionRu()
        ];

        $this->productLocalizationRepository->updateProductLocalization($product->id, $langData);

        return $this->productRepository->getProductById($product->id);
    }

    public function deleteProductAction(int $id): bool
    {
        $this->productLocalizationRepository->deleteProductLocalization($id);
        return $this->productRepository->deleteProduct($id);
    }

    private function makeProductData(ProductData $dto): array
    {
        return [
            'category_id' => $dto->getCategoryId(),
            'old_price' => $dto->getOldPrice(),
            'sales' => $dto->getSales(),
            'img_url' => $dto->getImgUrl(),
            'order_count' => $dto->getOrderCount(),
            'stock_availability' => $dto->getStockAvailability(),
            'price' => round($dto->getOldPrice() - $dto->getOldPrice() * ($dto->getSales() / 100))
        ];
    }
}
