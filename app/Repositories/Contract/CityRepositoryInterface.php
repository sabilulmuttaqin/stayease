<?php

namespace App\Repositories\Contract;

interface cityRepositoryInterface
{
    public function getAllCities();
    public function getCityBySlug($slug);
}
