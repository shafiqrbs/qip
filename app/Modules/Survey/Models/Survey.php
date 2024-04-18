<?php

namespace App\Modules\Survey\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use app;
use auth;
use DB;

class Survey extends Model
{
    use HasFactory;
    protected $table = 'sur_survey';
    protected $fillable = [
        'nameen',
        'namebn',
        'discriptionen',
        'discriptionbn',
        'mode',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function SurveyOrganization($id){
        $result = DB::table('sur_survey')
            ->leftjoin('sur_survey_organization', 'sur_survey_organization.survey_id', '=', 'sur_survey.id')
            ->leftjoin('sur_organization', 'sur_survey_organization.organization_id', '=', 'sur_organization.id')
            ->select('sur_organization.*')
            ->where('sur_survey.id',$id)
            ->get();
        return $result;
    }

    public function SurveyItem(){
        return $this->hasMany('App\Modules\SurveyItem\Models\SurveyItem','survey_id','id');
    }

    public function SurveyResult(){
        return $this->hasMany('App\Modules\SurveyResult\Models\SurveyResult','survey_id','id');
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
