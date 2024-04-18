<?php

namespace App\Modules\Organization\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;
use Auth;

class Organization extends Model
{
    use HasFactory;
    protected $table = 'sur_organization';
    protected $fillable = [
        'name',
        'address',
        'mobile',
        'email',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];


    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
            }
        });
    }
}
