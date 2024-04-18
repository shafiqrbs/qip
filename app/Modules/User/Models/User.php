<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Model
{
    use HasFactory, Notifiable,HasRoles;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'password',
        'user_image',
        'type',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status',
        'resetcode',
        'organization_id'
    ];

    public function UserOrganization(){
        return $this->belongsTo('App\Modules\Organization\Models\Organization','organization_id','id');
    }

    protected $guard_name = 'web';



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
