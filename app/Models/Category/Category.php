<?php

namespace App\Models\Category;

use App\Models\User;
use App\Foundations\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasUUID, SoftDeletes;

    protected $fillable = [
        'name',
        'created_by',
        'modified_by'
    ];

    public function created_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function modified_user()
    {
        return $this->belongsTo(User::class, 'modified_by', 'id');
    }
}
