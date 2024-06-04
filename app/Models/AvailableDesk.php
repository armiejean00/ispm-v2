<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableDesk extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'desk_id',
    ];

    // ? Waiting for confirmation to merge available_desks to bookings
    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('date', 'like', '%' . request('search') . '%');
        }
    } // ? Move to Booking.php

    // Relationship to Bookings
    public function bookings() {
        return $this->hasMany(Booking::class, 'available_desk_id');
    }

    // Relationship to Desks
    public function desk() {
        return $this->belongsTo(Desk::class);
    }
}
