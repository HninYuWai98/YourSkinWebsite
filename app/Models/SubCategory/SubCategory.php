<?php

namespace App\Models\SubCategory;

use App\Models\User;
use App\Models\Category\Category;
use App\Foundations\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory, HasUUID, SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
        'created_by',
        'modified_by'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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
