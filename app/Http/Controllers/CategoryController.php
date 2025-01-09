<?php

namespace App\Http\Controllers;

use App\Repositories\Contract\boardingHouseRepositoryInterface;
use App\Repositories\Contract\categoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private boardingHouseRepositoryInterface $boardingHouseRepository;
    private categoryRepositoryInterface $categoryRepository;

    public function __construct(
        boardingHouseRepositoryInterface $boardingHouseRepository,
        categoryRepositoryInterface $categoryRepository,
    ) {
        $this->boardingHouseRepository = $boardingHouseRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function show($slug)
    {
        $categoryBySlug = $this->categoryRepository->getCategoryBySlug($slug);
        $boardingHouses = $this->boardingHouseRepository->getBoardingHouseByCategorySlug($slug);
        return view('pages.category.show', compact('boardingHouses', 'categoryBySlug'));
    }
}
