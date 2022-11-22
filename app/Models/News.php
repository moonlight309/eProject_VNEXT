<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    public $timestamps = true;
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
            $cookie = Auth::user();
            $user->created_user = $cookie->id;
        });

        static::updating(function ($user) {
            $cookie = Auth::user();
            $user->updated_user = $cookie->id;
        });

        static::deleting(function ($user) {
            $cookie = Auth::user();
            $user->deleted_user = $cookie->id;
        });
    }

}
