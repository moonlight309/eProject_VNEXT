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
            $cookie             = Auth::user();
            $user->created_user = $cookie->id;
        });

        static::updating(function ($user) {
            $cookie             = Auth::user();
            $user->updated_user = $cookie->id;
        });

        static::deleting(function ($user) {
            $cookie             = Auth::user();
            $user->deleted_user = $cookie->id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_user', 'id');
    }

}
