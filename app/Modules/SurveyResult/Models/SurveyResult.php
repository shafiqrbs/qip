<?php

namespace App\Modules\SurveyResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use app;
use auth;

class SurveyResult extends Model
{
    use HasFactory;
    protected $table = 'sur_survey_result';
    protected $fillable = [
        'survey_id',
        'survey_value',
        'name',
        'item_id',
        'organization_id',
        'user_id',
        'device_id',
        'date',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'latitude',
        'longitude'
    ];

    public function SurveyItem(){
        return $this->belongsTo('App\Modules\SurveyItem\Models\SurveyItem','item_id','id');
    }

    public function SurveyOrganization(){
        return $this->belongsTo('App\Modules\Organization\Models\Organization','organization_id','id');
    }

    public function SurveyUser(){
        return $this->belongsTo('App\Modules\User\Models\User','user_id','id');
    }

    public function SurveyName(){
        return $this->belongsTo('App\Modules\Survey\Models\Survey','survey_id','id');
    }


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
