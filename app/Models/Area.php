<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_name',
        'is_out_of_order',
    ];

    public function desks() {
        return $this->hasMany(Desk::class, 'area_id');
    }
}
