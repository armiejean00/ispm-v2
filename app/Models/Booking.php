<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // ? Waiting for confirmation to merge available_desks to bookings
    protected $fillable = [
        'date', // ? Add
        'user_id',
        'desk_id',
        'available_desk_id', // ? Remove
        'auto_accept',
        'status'
        
    ];

     protected $table = 'bookings';
    public $timestamps = true;

    // Relationship to User
    public function user() {
        return $this->belongsTo(User::class);
        // Equivalent to belongsTo(User::class, 'user_id')
    }

    // Relationship to Desks
    public function desk() {
        return $this->belongsTo(Desk::class);
    }

    // ? Waiting for confirmation to merge available_desks to bookings
    // Relationship to AvailableDesks
    public function available_desk() {
        return $this->belongsTo(AvailableDesk::class);
    } // ? Remove
}
