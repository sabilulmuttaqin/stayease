<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bonus extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "boarding_house_id",
        "description",
        "name",
        "image"
    ];

    public function boarding_house()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}
