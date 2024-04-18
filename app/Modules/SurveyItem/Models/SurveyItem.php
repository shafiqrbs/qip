<?php

namespace App\Modules\SurveyItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;
use Auth;

class SurveyItem extends Model
{
    use HasFactory;
    protected $table = 'sur_item';
    protected $fillable = [
        'survey_id',
        'itemtexten',
        'itemtextbn',
        'itemvaluebn',
        'itemvalueen',
        'color_code',
        'oredring',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

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
