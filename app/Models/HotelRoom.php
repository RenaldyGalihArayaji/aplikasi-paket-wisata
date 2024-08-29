<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;
    protected $table = 'hotel_rooms';
    protected $guarded = ['id'];


    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function tourPackages()
    {
        return $this->hasMany(TourPackage::class);
    }
    public function orderHotel()
    {
        return $this->hasMany(OrderHotel::class);
    }
}
