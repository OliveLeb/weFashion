<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Picture;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','price','is_discounted','is_published','reference'
    ];

    public function scopePublished($query) {
        return $query->where('is_published',true);
    }

    public function getIsDiscountedAttribute($value) {
        if($value == 0) {
            return 'Standard';
        }
        else {
            return 'Soldé';
        }
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function picture(){
        return $this->hasOne(Picture::class);
    }

    public function sizes() {
        return $this->belongsToMany(Size::class);
    }

    public $timestamps = false;
}
