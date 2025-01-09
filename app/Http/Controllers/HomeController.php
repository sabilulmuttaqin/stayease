<?php

namespace App\Http\Controllers;

use App\Repositories\categoryRepository;
use App\Repositories\Contract\boardingHouseRepositoryInterface;
use App\Repositories\Contract\categoryRepositoryInterface;
use App\Repositories\Contract\cityRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private cityRepositoryInterface $cityRepository;
    private boardingHouseRepositoryInterface $boardingHouseRepository;
    private categoryRepositoryInterface $categoryRepository;

    public function __construct(
        cityRepositoryInterface $cityRepository,
        boardingHouseRepositoryInterface $boardingHouseRepository,
        categoryRepositoryInterface $categoryRepository
    ) {

        $this->cityRepository = $cityRepository;
        $this->boardingHouseRepository = $boardingHouseRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {

        $categories = $this->categoryRepository->getAllCategories();
        $popularBoardingHouse = $this->boardingHouseRepository->getPopularBoardingHouse();
        $cities = $this->cityRepository->getAllCities();
        $boardingHouses = $this->boardingHouseRepository->getAllBoardingHouse();
        return view('pages.home', compact('categories', 'popularBoardingHouse', 'cities', 'boardingHouses'));
    }
}
