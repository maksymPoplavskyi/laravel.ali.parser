<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateProductRequest;
use App\Models\Localization;
use App\Models\Product;
use App\Repositories\CategoryLocalizationRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\LocalizationRepository;
use App\Repositories\ProductRepository;
use App\Services\ProductService;


class ProductController extends Controller
{
    /** @var ProductRepository $productRepository */
    private $productRepository;
    /** @var CategoryRepository $categoryRepository */
    private $categoryRepository;
    /** @var LocalizationRepository $localizationRepository */
    private $localizationRepository;
    /** @var CategoryLocalizationRepository $categoryLocalizationRepository */
    private $categoryLocalizationRepository;
    /** @var int $productsCount */
    private $productsCount;
    /** @var ProductService $productService */
    private $productService;
    /** @var Localization $localizations */
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
            'products' => $this->productRepository->getAllProductsBaseLocale(),
            'categories' => $this->categoryRepository->getCategoriesBasedLocale(),
            'productsCount' => $this->productsCount,
            'localizations' => $this->localizations
        ]);
    }

    public function show(Product $product)
    {
        return view('product', [
            'product' => $this->productRepository->getProduct($product),
            'categories' => $this->categoryRepository->getCategoriesBasedLocale(),
            'productsCount' => $this->productsCount,
            'localizations' => $this->localizations
        ]);
    }

    public function createView()
    {
        return view('create', [
            'categories' => $this->categoryRepository->getCategoriesBasedLocale(),
            'productsCount' => $this->productsCount,
            'localizations' => $this->localizations
        ]);
    }

    public function createAction(CreateUpdateProductRequest $request)
    {
        return redirect()->route('shop.view', [$this->productService->addProductAction($request)]);
    }

    public function updateView(Product $product)
    {
        return view('update', [
            'product' => $this->productRepository->getProduct($product),
            'categories' => $this->categoryRepository->getCategoriesBasedLocale(),
            'productsCount' => $this->productsCount,
            'localizations' => $this->localizations
        ]);
    }

    public function updateAction($product, CreateUpdateProductRequest $request)
    {
        return view('update', [
            'product' => $this->productService->updateProductAction($product, $request),
            'categories' => $this->categoryRepository->getCategoriesBasedLocale(),
            'productsCount' => $this->productsCount,
            'localizations' => $this->localizations
        ]);
    }

    public function deleteAction(Product $product)
    {
        $this->productService->deleteProductAction($product->id);

        $previousRoute = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();

        if ($previousRoute === 'shop.view' || $previousRoute === 'shop.update.view') return redirect()->route('shop');

        return redirect()->back();

    }
}
