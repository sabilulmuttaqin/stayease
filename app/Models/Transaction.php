<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "code",
        "room_id",
        "boarding_house_id",
        "name",
        "email",
        "phone_number",
        "payment_method",
        "payment_status",
        "started_at",
        "transaction_date",
        "total_amount",
        "duration",
        "address",
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function boarding_house()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
    public static function generateUniqueTrxId()
    {
        $prefix = 'MS';
        do {
            $randomstring = $prefix . mt_rand(100, 9999);
        } while (self::where('code', $randomstring)->exists());

        return $randomstring;
    }
}
