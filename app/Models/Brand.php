<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    public $fillable = [
        'name', 'address', 'image'
    ];
    public function planes(){
        return $this->hasMany(Plane::class, 'brand_id');
    }
}
