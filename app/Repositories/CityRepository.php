<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Contract\cityRepositoryInterface;

class cityRepository implements cityRepositoryInterface
{
    public function getAllCities()
    {
        return City::all();
    }
    public function getCityBySlug($slug)
    {
        return City::where('slug', $slug)->first();
    }
}
