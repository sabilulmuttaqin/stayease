<?php

namespace App\Http\Controllers;

use App\Repositories\Contract\boardingHouseRepositoryInterface;
use App\Repositories\Contract\categoryRepositoryInterface;
use App\Repositories\Contract\cityRepositoryInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private boardingHouseRepositoryInterface $boardingHouseRepository;
    private cityRepositoryInterface $cityRepository;

    public function __construct(
        boardingHouseRepositoryInterface $boardingHouseRepository,
        cityRepositoryInterface $cityRepository,
    ) {
        $this->boardingHouseRepository = $boardingHouseRepository;
        $this->cityRepository = $cityRepository;
    }

    public function show($slug)
    {
        $cityBySlug = $this->cityRepository->getCityBySlug($slug);
        $boardingHouses = $this->boardingHouseRepository->getBoardingHouseByCitySlug($slug);
        return view('pages.city.city', compact('cityBySlug', 'boardingHouses'));
    }
}
