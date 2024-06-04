<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desk extends Model
{
    use HasFactory;

    protected $fillable = [
        'desk_number',
        'is_out_of_order',
        'amenities',
        'area'
    ];
    
    // Relationship to areas
    public function area() {
        return $this->belongsTo(Area::class);
    }

    // Relationship to bookings
    public function bookings() {
        return $this->hasMany(Booking::class, 'desk_id');
    }
}
