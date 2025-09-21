<?php

namespace App\Models\Brand;

use App\Models\User;
use App\Foundations\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Brand extends Model
{
    use HasFactory, HasUUID, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
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
