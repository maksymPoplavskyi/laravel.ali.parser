<?php


namespace App\Services;


use App\Repositories\CategoryRepository;

class CategoryService
{
    /** @var CategoryRepository $repository */
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
}
