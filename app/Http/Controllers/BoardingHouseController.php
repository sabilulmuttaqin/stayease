<?php

namespace App\Http\Controllers;

use App\Repositories\Contract\boardingHouseRepositoryInterface;
use App\Repositories\Contract\categoryRepositoryInterface;
use App\Repositories\Contract\cityRepositoryInterface;
use Illuminate\Http\Request;

class BoardingHouseController extends Controller
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
    public function findBooking()
    {
        $cities = $this->cityRepository->getAllCities();
        $categories = $this->categoryRepository->getAllCategories();
        return view('pages.boarding-house.find', compact('cities', 'categories'));
    }
    public function findBookingResult(Request $request)
    {
        $boardingHouse = $this->boardingHouseRepository->getAllBoardingHouse($request->search, $request->city, $request->category);
        return view('pages.boarding-house.index', compact('boardingHouse'));
    }

    public function show($slug)
    {

        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        // dd($boardingHouse);
        return view('pages.boarding-house.show', compact('boardingHouse'));
    }
    public function room($slug)
    {
        // dd($slug);
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        // dd($boardingHouse);
        // dd($boardingHouse->toArray());
        return view('pages.boarding-house.room', compact('boardingHouse'));
    }
}
