<?php

namespace App\Models\Product;

use App\Models\User;
use App\Models\Brand\Brand;
use App\Foundations\Traits\HasUUID;
use App\Models\SubCategory\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasUUID, SoftDeletes;

    protected $fillable = [
        'name',
        'sub_category_id',
        'brand_id',
        'image',
        'is_active',
        'created_by',
        'modified_by'
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function created_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function modified_user()
    {
        return $this->belongsTo(User::class, 'modified_by', 'id');
    }
}
