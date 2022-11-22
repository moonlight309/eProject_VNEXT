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
}
