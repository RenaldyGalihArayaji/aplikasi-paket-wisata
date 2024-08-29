<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // public function orderPackages()
    // {
    //     return $this->hasMany(OrderPackage::class, 'hotel_id');
    // }

    public function tourPackages()
    {
        return $this->hasMany(TourPackage::class);
    }
    public function room()
    {
        return $this->hasMany(HotelRoom::class);
    }
    public function getActiveRoomCountAttribute()
    {
        return $this->room->where('status', 'active')->count();
    }
}
