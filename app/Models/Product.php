<?php

namespace App\Models;

use App\Models\Picture;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','price','size','is_discounted','is_published','reference'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function picture(){
        return $this->hasOne(Picture::class);
    }

    public $timestamps = false;
}
