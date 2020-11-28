<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ShopCreateProductRequest;
use App\Http\Requests\ShopUpdateProductRequest;
use App\Repositories\CategoryLocalizationRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\LocalizationRepository;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Support\Facades\App;


class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository;
    private $localizationRepository;
    private $categoryLocalizationRepository;
    private $productsCount;
    private $productService;
    private $localizations;

    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository,
                                ProductService $productService, LocalizationRepository $localizationRepository,
                                CategoryLocalizationRepository $categoryLocalizationRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productService = $productService;
        $this->localizationRepository = $localizationRepository;
        $this->categoryLocalizationRepository = $categoryLocalizationRepository;

        $this->productsCount = $this->productRepository->getAll()->count();
        $this->localizations = $this->localizationRepository->getAll();
    }

    public function index()
    {
        return view('shop', [
            'products' => $this->productRepository->getAllProductsBaseLocale(App::getLocale()),
            'categories' => $this->getCategories($this->categoryLocalizationRepository),
            'productsCount' => $this->productsCount,
            'localizations' => $this->localizations
        ]);
    }

    public function show($id, ProductRequest $request)
    {
        return view('product', [
            'product' => $this->productRepository->getProductById($id, App::getLocale()),
            'categories' => $this->getCategories($this->categoryLocalizationRepository),
            'productsCount' => $this->productsCount,
            'localizations' => $this->localizations
        ]);
    }

    public function createView()
    {
        return view('create', [
            'categories' => $this->getCategories($this->categoryLocalizationRepository),
            'productsCount' => $this->productsCount,
            'localizations' => $this->localizations
        ]);
    }

    public function createAction(ShopCreateProductRequest $request)
    {
        return redirect()->route('shop.view', ['id' => $this->productService->addProductAction($request)]);
    }

    public function updateView($id, ProductRequest $request)
    {
        return view('update', [
            'product' => $this->productRepository->getProductById($id, App::getLocale()),
            'categories' => $this->getCategories($this->categoryLocalizationRepository),
            'productsCount' => $this->productsCount,
            'localizations' => $this->localizations
        ]);
    }

    public function updateAction($id, ShopUpdateProductRequest $request)
    {
        return view('update', [
            'product' => $this->productService->updateProductAction($id, $request),
            'categories' => $this->getCategories($this->categoryLocalizationRepository),
            'productsCount' => $this->productsCount,
            'localizations' => $this->localizations
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
