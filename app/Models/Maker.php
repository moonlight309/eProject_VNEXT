<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'address',
        'description',
        'phone',
        'code',
        'name',
        'created_user',
        'updated_user',
        'deleted_user'
    ];
}
