<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category'
    ];

    public function setCategoryAttribute($value) {
        if($value == 'female') {
            $this->attributes['category'] = 'Femme';
        }
        else {
            $this->attributes['category'] = 'Homme';
        }
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
