<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ShopCreateProductRequest;
use App\Http\Requests\ShopUpdateProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Support\Facades\App;


class ProductController extends Controller
{
    private $categories;
    private $productRepository;
    private $categoryRepository;
    private $productsCount;
    private $productService;

    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository, ProductService $productService)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productService = $productService;

        $this->categories = $this->categoryRepository->getAll();
        $this->productsCount = $this->productRepository->getAll()->count();
    }

    public function index()
    {
        return view('shop', [
            'products' => $this->productRepository->getAll(),
            'categories' => $this->categories,
            'productsCount' => $this->productsCount
        ]);
    }

    public function show($id, ProductRequest $request)
    {
        return view('product', [
            'product' => $this->productRepository->getProductById($id),
            'categories' => $this->categories,
            'productsCount' => $this->productsCount
        ]);
    }

    public function createView()
    {
        return view('create', [
            'categories' => $this->categoryRepository->getAll(),
            'productsCount' => $this->productsCount
        ]);
    }

    public function createAction(ShopCreateProductRequest $request)
    {
        return view('product', [
            'product' => $this->productService->addProductAction($request),
            'categories' => $this->categories,
            'productsCount' => $this->productRepository->getAll()->count()
        ]);

    }

    public function updateView($id, ProductRequest $request)
    {
        return view('update', [
            'product' => $this->productRepository->getProductById($id),
            'categories' => $this->categories,
            'productsCount' => $this->productsCount
        ]);
    }

    public function updateAction($id, ShopUpdateProductRequest $request)
    {
        return view('update', [
            'product' => $this->productService->updateProductAction($id, $request),
            'categories' => $this->categories,
            'productsCount' => $this->productsCount
        ]);
    }

    public function deleteAction($id, ProductRequest $request)
    {
        $this->productService->deleteProductAction($id);

        $previousRoute = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();

        if ($previousRoute === 'shop.view' || $previousRoute === 'shop.update.view') return redirect()->route('shop');

        return redirect()->back();

    }
}
