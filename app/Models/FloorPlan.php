<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorPlan extends Model
{
    protected $fillable = ['image_path'];
    protected $table = 'floor_plans';


    public function setImage($image)
    {
        if ($image) {
            $imagePath = $image->store('images/floor-plan', 'public');
            $this->image_path = $imagePath;
            $this->save();
        }
    }

    public function getImagePathAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
