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

    public function getCategoryAttribute($value) {
        if($value == 'female') {
            return 'Femme';
        }
        else {
            return 'Homme';
        }
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
