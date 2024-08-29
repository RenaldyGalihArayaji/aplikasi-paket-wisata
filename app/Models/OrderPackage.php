<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPackage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function package()
    {
        return $this->belongsTo(TourPackage::class, 'tourPackage_id');
    }

    // public function hotel()
    // {
    //     return $this->belongsTo(Hotel::class, 'hotel_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
