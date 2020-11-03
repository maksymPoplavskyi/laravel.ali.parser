<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\ShopService;

class ShopController extends Controller
{
    private $products_sum;
    private $categories_count;

    public function __construct(ShopService $service)
    {
        $this->products_sum = app(ProductRepository::class)->getQuantityProducts();

        $categories = app(CategoryRepository::class)->getAll();
        $this->categories_count = $service->makeQuantityProductOfCategory($categories);
    }

    public function index()
    {
        $products = app(ProductRepository::class)->getAllProductsWithCategory();

        return view('shop', ['products' => $products, 'categories_count' => $this->categories_count, 'products_sum' => $this->products_sum]);
    }

    public function show($category, $id)
    {
        $product = app(ProductRepository::class)->getProductById($id);

        return view('product', ['product' => $product, 'products_sum' => $this->products_sum, 'categories_count' => $this->categories_count]);
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
