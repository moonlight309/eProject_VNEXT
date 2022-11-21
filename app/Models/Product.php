<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'image',
        'price',
        'color',
        'description',
        'maker_id',
        'created_user',
        'updated_user',
        'deleted_user'
    ];

    // public function category()
    // {
    //     return $this->belongsToMany(Category::class, 'category_id', 'id');
    // }

    // protected $casts = [
    //     'image' => 'array'
    // ];

    // protected function image(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => json_decode($value, true),
    //         // set: fn ($value) => json_encode($value),
    //     );
    // }
}
