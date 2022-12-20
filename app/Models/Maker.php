<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Maker extends Model
{
    use HasFactory;
    use Sortable;
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

    public $sortable = ['code', 'name', 'created_at'];
    public static function getMaker(){
        $records = DB::table('makers')->select('id','code','name','logo','address','description','phone','created_at','updated_at','deleted_at')->get()->toArray();
        return $records;
    }


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
