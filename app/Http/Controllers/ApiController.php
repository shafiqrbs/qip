<?php

namespace App\Http\Controllers;

use App\Modules\Organization\Models\Organization;
use App\Modules\Survey\Models\Survey;
use App\Modules\SurveyItem\Models\SurveyItem;
use App\Modules\SurveyResult\Models\SurveyResult;
use App\Modules\User\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

//use DB;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        global $access;
        $requestDBName = $request->header('x-api-key');
        $requestDBUserName = $request->header('x-api-value');
        $requestDBPass = $request->header('x-api-secret');

        $key = \config('api.key');
        $value = \config('api.value');
        $secret = \config('api.secret');

        if (($requestDBName == $key) && ($requestDBUserName == $value) && ($requestDBPass == $secret)){
            $this->access = 'allow';
        }else{
            $this->access= 'Not allow';
        }
        echo $access;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getorganizationdata(){
        try{
            if ($this->access == 'allow'){
                $allOrganization = Organization::all();
                return \response(
                    $allOrganization
                );
            }else{
                return \response([
                    'message'=>'Error,Incorrect API Info'
                ]);
            }
        }catch(Exception $ex){
            return \response([
                'message'=>$ex->getMessage()
            ]);
        }
    }

    public function getsurveydata(){
        try{
            if ($this->access == 'allow'){
                $allSurvey = Survey::all();
                return \response(
                    $allSurvey
                );
            }else{
                return \response([
                    'message'=>'Error,Incorrect API Info'
                ]);
            }
        }catch(Exception $ex){
            return \response([
                'message'=>$ex->getMessage()
            ]);
        }
    }


    public function getsurveyitem(){
        try{
            if ($this->access == 'allow'){
                $allSurveyItem = Survey::query()
                    ->with(['SurveyItem' => function ($query) {
                        $query->select('id','survey_id', 'itemtexten as item_name_en','itemtextbn as item_name_bn','itemvalueen as item_value_en','itemvaluebn as item_value_bn');
                        $query->where('status',1);
                    }])
                    ->where('status',1)
                    ->get(['id','nameen as name_en','namebn as name_bn','discriptionen as discriptionen_en','discriptionbn as discriptionbn_bn','mode']);
                return \response(
                    $allSurveyItem
                );
            }else{
                return \response([
                    'message'=>'Error,Incorrect API Info'
                ]);
            }
        }catch(Exception $ex){
            return \response([
                'message'=>$ex->getMessage()
            ]);
        }
    }

    public function surveyLogin(Request $request){
        if ($this->access == 'allow'){
            $input = $request->all();

            $validation = true;

            if (empty($input['email'])){
                $validation = false;
                return \response([
                    'error'=>'Email must be filled'
                ]);
            }else{
                if (empty($input['password'])){
                    $validation = false;
                    return \response([
                        'error'=>'Password must be filled'
                    ]);
                }else{
                    $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
                    if (preg_match($pattern, $input['email']) === 1) {
                        $emailUser = User::where('email',$input['email'])->where('status','1')->first();
                        if ($emailUser){
                            if (password_verify($input['password'], $emailUser->password)) {

                                $userInfo = User::query()
                                    ->with(['UserOrganization' => function ($query) {
                                        $query->select('id','name as organizationName','address as organizationAddress','mobile as organizationMobile','email as organizationEmail');
                                    }])
                                    ->where('email',$input['email'])->where('status','1')
                                    ->first(['id as userID','name','email','mobile','address','organization_id']);
                                return \response(
                                    $userInfo
                                );
                            } else {
                                return \response([
                                    'error'=>'Invalid password'
                                ]);
                            }
                        }else{
                            return \response([
                                'error'=>'No user found'
                            ]);
                        }
                    }else{
                        $validation = false;
                        return \response([
                            'error'=>'Email not valid'
                        ]);
                    }
                }
            }

//            return new JsonResponse($input);

        }else{
            return \response([
                'message'=>'Error,Incorrect API Info'
            ]);
        }
    }


    public function createSurveyResult(Request $request){
//        var_dump($_REQUEST);
//        exit;

//        dd($input['survey_id']);
        if ($this->access == 'allow'){
            $input = $request->all();
            $validation = true;

            if (empty($input['survey_id'])){
                $validation = false;
                return \response([
                    'error'=>'Survey Id must be filled'
                ]);
            }
            if (empty($input['device_id'])){
                $validation = false;
                return \response([
                    'error'=>'Device Id must be filled'
                ]);
            }
            if (empty($input['item_id'])){
                $validation = false;
                return \response([
                    'error'=>'Item Id must be filled'
                ]);
            }
            if (empty($input['organization_id'])){
                $validation = false;
                return \response([
                    'error'=>'Organization Id must be filled'
                ]);
            }

            if (empty($input['user_id'])){
                $validation = false;
                return \response([
                    'error'=>'User Id must be filled'
                ]);
            }

            if ($validation){
                DB::beginTransaction();
                try {
                    $input['date'] = date('d-m-Y');
                    $input['status'] = 1;
                    $input['created_by'] = $input['user_id'];
                    if ($SurveyResultData = SurveyResult::create($input)) {
                        $SurveyResultData->save();
                    }

                    DB::commit();
                    return \response([
                        'message'=>'Survey added successfully'
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return \response([
                        'message'=>$e->getMessage()
                    ]);
                }
            }

            return new JsonResponse($input);
//            return \response([
//                'message'=>'Access'
//            ]);
        }else{
            return \response([
                'message'=>'Error,Incorrect API Info'
            ]);
        }
    }


    public function getsurveyresult(){
        try{
            if ($this->access == 'allow'){
                $surveyResult = Survey::with(
                    array(
                        'SurveyResult' => function ($query) {
                            $query->select('id','survey_id', 'item_id','organization_id','user_id','latitude','longitude')->with(
                                array(
                                    'SurveyItem' => function ($q) {
                                        $q->select('id','itemtexten','itemtextbn','itemvalueen','itemvaluebn');
                                    },
                                    'SurveyOrganization' => function ($q) {
                                        $q->select('id','name','address','mobile','email');
                                    },
                                    'SurveyUser' => function ($q) {
                                        $q->select('id','name','address','mobile','email');
                                    }
                                )
                            );
                        }
                    )
                )->get();

                return \response(
                    $surveyResult
                );
            }else{
                return \response([
                    'message'=>'Error,Incorrect API Info'
                ]);
            }
        }catch(Exception $ex){
            return \response([
                'message'=>$ex->getMessage()
            ]);
        }
    }


    public function getsurveyresultGroupBy(){
        try{
//            if ($this->access == 'allow'){

                $surveyResults = SurveyResult::select([
                    DB::raw('count(sur_survey_result.id) as total'),
                    'sur_survey.nameen',
                    'sur_survey.namebn',
                    'sur_survey.discriptionen',
                    'sur_survey.discriptionbn',
                    'sur_item.itemtexten',
                    'sur_item.itemtextbn',
                ])->join('sur_survey','sur_survey_result.survey_id','=','sur_survey.id')
                    ->join('sur_item','sur_survey_result.item_id','=','sur_item.id')
                    ->groupBy('sur_survey.id')->groupBy('sur_item.id')->get();

                $allSurveyItem = [];
                if($surveyResults){
                    foreach ($surveyResults as $result){
                        $allSurveyItem[]=[
                            'total'=>$result->total,
                            'nameen'=>$result->nameen,
                            'namebn'=>$result->namebn,
                            'discriptionen'=>$result->discriptionen,
                            'discriptionbn'=>$result->discriptionbn,
                            'itemtexten'=>$result->itemtexten,
                            'itemtextbn'=>$result->itemtextbn
                        ];
                    }
                }

                return \response(
                    $allSurveyItem
                );
            /*}else{
                return \response([
                    'message'=>'Error,Incorrect API Info'
                ]);
            }*/
        }catch(Exception $ex){
            return \response([
                'message'=>$ex->getMessage()
            ]);
        }
    }


    public function surveyResultChart(Request $request){
        if ($this->access == 'allow'){
            $input = $request->all();

            $validation = true;
//
            if (empty($input['survey_id'])){
                $validation = false;
                return \response([
                    'error'=>'Survey Id must be filled'
                ]);
            }

            if (empty($input['organization_id'])){
                $validation = false;
                return \response([
                    'error'=>'Organization Id must be filled'
                ]);
            }

            if (isset($input['survey_id']) && isset($input['organization_id'])){
                $surveyResult = SurveyResult::select([
                    DB::raw('count(sur_survey_result.id) as value'),
//                    'sur_survey.id as surveyId',
//                    'sur_survey.nameen',
//                    'sur_survey.namebn',
//                    'sur_survey.discriptionen',
//                    'sur_survey.discriptionbn',
                    'sur_item.itemtexten',
                    'sur_item.itemtextbn',
//                    'sur_survey_organization_person.person',
                ])
                    ->join('sur_survey', 'sur_survey_result.survey_id', '=', 'sur_survey.id')
                    ->join('sur_item', 'sur_survey_result.item_id', '=', 'sur_item.id')
                    ->join('sur_survey_organization_person', 'sur_survey_organization_person.survey_id', '=', 'sur_survey.id')
                    ->where('sur_survey_result.survey_id', $input['survey_id'])
                    ->where('sur_survey_result.organization_id', $input['organization_id'])
                    ->where('sur_survey_result.date', date('d-m-Y'))
                    ->where('sur_survey_organization_person.date', date('d-m-Y'))
                    ->groupBy('sur_survey_result.item_id')
                    ->get();

                return \response(
                    $surveyResult
                );
            }


//            return new JsonResponse($input);

        }else{
            return \response([
                'message'=>'Error,Incorrect API Info'
            ]);
        }
    }
}
