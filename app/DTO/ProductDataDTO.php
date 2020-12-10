<?php


namespace App\DTO;


use App\Http\Requests\CreateUpdateProductRequest;

class ProductDataDTO
{
    /** @var int $category_id */
    protected $category_id;
    /** @var string $description_en */
    protected $description_en;
    /** @var string $description_ru */
    protected $description_ru;
    /** @var float $old_price */
    protected $old_price;
    /** @var int $sales */
    protected $sales;
    /** @var string $img_url */
    protected $img_url;
    /** @var int $order_count */
    protected $order_count;
    /** @var int $stock_availability */
    protected $stock_availability;

    public function __construct()
    {
    }

    public static function createProductLocalizationData(int $categoryId, string $en, string $ru)
    {
        $obj = new self();
        $obj->setCategoryId($categoryId);
        $obj->setDescriptionEn($en);
        $obj->setDescriptionRu($ru);

        $obj->deleteNullElement($obj);

        return $obj;
    }

    public static function createProductData(CreateUpdateProductRequest $request)
    {
        $obj = new self();
        $obj->setCategoryId($request->get('category_id'));
        $obj->setOldPrice($request->get('old_price'));
        $obj->setSales($request->get('sales'));
        $obj->setImgUrl($request->get('img_url'));
        $obj->setOrderCount($request->get('order_count'));
        $obj->setStockAvailability($request->get('stock_availability'));

        $obj->deleteNullElement($obj);

        return $obj;
    }

    private static function deleteNullElement(Object $obj) {
        foreach ($obj as $key => $value) {
            if ($value === null) {
                unset($obj->{$key});
            }
        }
    }

    /**
     * @return int
     */
    protected function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    protected function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @return string
     */
    protected function getDescriptionEn(): string
    {
        return $this->description_en;
    }

    /**
     * @param string $description_en
     */
    protected function setDescriptionEn(string $description_en): void
    {
        $this->description_en = $description_en;
    }

    /**
     * @return string
     */
    protected function getDescriptionRu(): string
    {
        return $this->description_ru;
    }

    /**
     * @param string $description_ru
     */
    protected function setDescriptionRu(string $description_ru): void
    {
        $this->description_ru = $description_ru;
    }

    /**
     * @return float
     */
    protected function getOldPrice(): float
    {
        return $this->old_price;
    }

    /**
     * @param float $old_price
     */
    protected function setOldPrice(float $old_price): void
    {
        $this->old_price = $old_price;
    }

    /**
     * @return int
     */
    protected function getSales(): int
    {
        return $this->sales;
    }

    /**
     * @param int $sales
     */
    protected function setSales(int $sales): void
    {
        $this->sales = $sales;
    }

    /**
     * @return string
     */
    protected function getImgUrl(): string
    {
        return $this->img_url;
    }

    /**
     * @param string $img_url
     */
    protected function setImgUrl(string $img_url): void
    {
        $this->img_url = $img_url;
    }

    /**
     * @return int
     */
    protected function getOrderCount(): int
    {
        return $this->order_count;
    }

    /**
     * @param int $order_count
     */
    protected function setOrderCount(int $order_count): void
    {
        $this->order_count = $order_count;
    }

    /**
     * @return int
     */
    protected function getStockAvailability(): int
    {
        return $this->stock_availability;
    }

    /**
     * @param int $stock_availability
     */
    protected function setStockAvailability(int $stock_availability): void
    {
        $this->stock_availability = $stock_availability;
    }




}
