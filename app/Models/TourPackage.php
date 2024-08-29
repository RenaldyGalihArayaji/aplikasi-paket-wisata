<?php

namespace App\Models;

use App\Models\Hotel;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourPackage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function orderPackages()
    {
        return $this->hasMany(OrderPackage::class, 'tourPackage_id');
    }

    public function room()
    {
        return $this->belongsTo(HotelRoom::class);
    }
}
