<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class News extends Model
{
    public $timestamps = true;
    protected $table = 'news';
    use SoftDeletes, HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'content',
        'created_user',
        'updated_user',
        'deleted_user',
        'created_at',
        'updated_at',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->created_user = Auth::user()->id;
        });

        static::updating(function ($user) {
            $user->updated_user = Auth::user()->id;
        });

        static::deleting(function ($user) {
            $user->deleted_user = Auth::user()->id;
        });
    }
}
