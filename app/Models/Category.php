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
            return ucfirst($value);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public $timestamps = false;

}
