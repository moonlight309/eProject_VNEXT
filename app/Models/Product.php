<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;

    protected $table = 'products';
    public $timestamps = true;
    use SoftDeletes, HasApiTokens, HasFactory, Notifiable;


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

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value)
        );
    }

    protected function color(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value)
        );
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }
}
