<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function isBestSeller()
    {
        return $this->sales_count >= 10;
    }

    public function isPopular()
    {
        return $this->view_count >= 100;
    }

    public function isNew()
    {
        return $this->created_at->diffInDays(now()) <= 10;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function get_properties($ids)
    {
        return ProductProperty::whereIn('id', explode(',',$ids))->get();
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }
}
