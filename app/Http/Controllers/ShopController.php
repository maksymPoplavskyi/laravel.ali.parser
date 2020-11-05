<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopCreateProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\CategoryService;
use App\Services\ProductCategoryService;
use App\Services\ShopService;
use Illuminate\Support\Facades\Route;

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

        return view('shop', [
            'products' => $products,
            'categories_count' => $this->categories_count,
            'products_sum' => $this->products_sum
        ]);
    }

    public function show($category, $id)
    {
        $product = app(ProductRepository::class)->getProductWithCategory($id);

        return view('product', [
            'category' => $category,
            'product' => $product,
            'products_sum' => $this->products_sum,
            'categories_count' => $this->categories_count
        ]);
    }

    public function createView()
    {
        $categories = app(CategoryRepository::class)->getAll();

        return view('create', [
            'categories' => $categories,
            'products_sum' => $this->products_sum,
            'categories_count' => $this->categories_count
        ]);
    }

    public function createAction(ShopCreateProductRequest $request, ShopService $shopService, ProductCategoryService $productCategoryService)
    {
        $newProductId = $shopService->addProductAction($request);

        $newProductCategory = $productCategoryService->makeRelationProductWithCategory($newProductId, $request->get('category_id'));

        return redirect()->route('shop.view', [
            'category' => $newProductCategory->name,
            'id' => $newProductId
        ]);

    }

    public function updateView($categoryName, $productId)
    {
        $product = app(ProductRepository::class)->getProductWithCategory($productId);

        $categories = app(CategoryRepository::class)->getAll();

        return view('update', [
            'product' => $product,
            'categories' => $categories,
            'products_sum' => $this->products_sum,
            'categories_count' => $this->categories_count
        ]);
    }

    public function updateAction($productId, ShopCreateProductRequest $request, ShopService $shopService, ProductCategoryService $productCategoryService, CategoryService $categoryService)
    {
        $updateProductResult = $shopService->updateProductAction($productId, $request);
        if (!$updateProductResult) return abort(404, 'updateAction');

        $productCategoryService->updateRelationProductWithCategory($productId, $request->get('category_id'));

        $category = $categoryService->getCategoryById($request->get('category_id'));
        if (!$category) return abort(404, 'updateAction');

        return redirect()->route('shop.update.view', [
            'category' => $category->name,
            'id' => $productId
        ]);
    }

    public function deleteAction($categoryName, $productId, ProductCategoryService $productCategoryService, ShopService $shopService)
    {
        $resultDeleteRelation = $productCategoryService->deleteRelationProductWithCategory($productId);
        if (!$resultDeleteRelation) abort(404, 'delete relation');

        $resultDeleteProduct = $shopService->deleteProductAction($productId);
        if (!$resultDeleteProduct) abort(404, 'delete product');

        $previousRoute = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();

        if ($previousRoute === 'shop.view' || $previousRoute === 'shop.update.view') return redirect()->route('shop');

        return redirect()->back();

    }
}
