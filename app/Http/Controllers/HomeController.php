<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use App\Modules\Survey\Models\Survey;
use App\Modules\SurveyItem\Models\SurveyItem;
use App\Modules\SurveyResult\Models\SurveyResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Validator;
use Auth;
use Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        ConfigurationHelper::Language();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        ConfigurationHelper::Language();

        $surveyInfo = Survey::with(
            array(
                'SurveyResult' => function ($query) {
                    $query->select('id','survey_id', 'item_id','organization_id','user_id','latitude','longitude')->with(
                        array(
                            'SurveyItem' => function ($q) {
                                $q->select('id','itemtexten','itemtextbn','itemvalueen','itemvaluebn');
                            }
                        )
                    );
                }
            )
        )->where('status',1);
        if (Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();
            $surveyInfo->join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id');
            $surveyInfo->where('sur_survey_organization.organization_id',$userInfo->organization_id);
        }
        $surveyInfo=$surveyInfo->get();

//        dd($surveyInfo);

        $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();
        $surveySelect = Survey::join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id')
            ->where('sur_survey.status',1);

        if (Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $surveySelect->where('sur_survey_organization.organization_id',$userInfo->organization_id);
        }
        if(session()->get('locale') == 'en'){
            $surveySelect = $surveySelect->pluck('sur_survey.nameen','sur_survey.id')->all();
        }else{
            $surveySelect = $surveySelect->pluck('sur_survey.namebn','sur_survey.id')->all();
        }
        $surveySelect[''] = 'Choose Survey';
        ksort($surveySelect);

        $selectOrganization = Organization::join('sur_survey_organization','sur_organization.id','=','sur_survey_organization.organization_id');
        if (Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $selectOrganization->where('sur_survey_organization.organization_id',$userInfo->organization_id);
        }
        $selectOrganization = $selectOrganization->pluck('sur_organization.name','sur_organization.id')->all();
        $selectOrganization[''] = 'Choose Organization';
        ksort($selectOrganization);
//        dd($selectOrganization);

        return view("backend.admin.index",compact(['surveyInfo','surveySelect','selectOrganization']));
    }

    public function surveyGraphFilter(Request $request){
        $input = $request->all();

        ConfigurationHelper::Language();

        $surveyInfo = Survey::with(
            array(
                'SurveyResult' => function ($query) {
                    $query->select('id','survey_id', 'item_id','organization_id','user_id','latitude','longitude')->with(
                        array(
                            'SurveyItem' => function ($q) {
                                $q->select('id','itemtexten','itemtextbn','itemvalueen','itemvaluebn');
                            }
                        )
                    );
                }
            )
        )->where('status',1);
        if (Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();
            $surveyInfo->join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id');
            $surveyInfo->where('sur_survey_organization.organization_id',$userInfo->organization_id);
        }
        if (isset($input['survey_id']) && !empty($input['survey_id'])){
            $surveyInfo = $surveyInfo->where('sur_survey.id',$input['survey_id']);
        }

        if (isset($input['organization_id']) && !empty($input['organization_id'])){
            $surveyInfo->join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id');
            $surveyInfo = $surveyInfo->where('sur_survey_organization.organization_id',$input['organization_id']);
        }
        $surveyInfo = $surveyInfo->get();
//        dd($surveyInfo);

        $selectOrganization = Organization::join('sur_survey_organization','sur_organization.id','=','sur_survey_organization.organization_id');
        if (Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $selectOrganization->where('sur_survey_organization.organization_id',$userInfo->organization_id);
        }
        $selectOrganization = $selectOrganization->pluck('sur_organization.name','sur_organization.id')->all();
        $selectOrganization[''] = 'Choose Organization';
        ksort($selectOrganization);


        $surveySelect = Survey::join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id')
            ->where('sur_survey.status',1);

        if (Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();
            $surveySelect->where('sur_survey_organization.organization_id',$userInfo->organization_id);
        }
        if(session()->get('locale') == 'en'){
            $surveySelect = $surveySelect->pluck('sur_survey.nameen','sur_survey.id')->all();
        }else{
            $surveySelect = $surveySelect->pluck('sur_survey.namebn','sur_survey.id')->all();
        }
        $surveySelect[''] = 'Choose Survey';
        ksort($surveySelect);

        if (isset($input['date']) && (!isset($input['month']) && !isset($input['year']))){
            $searchDate = $input['date'];
            $survey_id = $input['survey_id'];
            $organization_id = null;
            if (Auth::user()->hasRole('ADMIN_OPERATOR') || Auth::user()->hasRole('ADMIN_REPORTER') || Auth::user()->hasRole('ADMINISTRATOR')){
                $organization_id = $input['organization_id'];
            }
            return view("backend.admin.index",compact(['surveyInfo','searchDate','surveySelect','survey_id','organization_id','selectOrganization']));
        }

        if (isset($input['month']) && isset($input['year'])){
            dd('ok');
            $searchmonth = $input['month'];
            $searchyear = $input['year'];
//            dd($searchmonth,$searchyear);
            return view("backend.admin.index",compact(['surveyInfo','searchDate','searchmonth','searchyear']));
        }
    }

    public function valueWiseReport(){
        ConfigurationHelper::Language();

        $surveyInfo = Survey::with(
            array(
                'SurveyResult' => function ($query) {
                    $query->select('id','survey_id', 'item_id','organization_id','user_id','latitude','longitude')->with(
                        array(
                            'SurveyItem' => function ($q) {
                                $q->select('id','itemtexten','itemtextbn','itemvalueen','itemvaluebn');
                            }
                        )
                    );
                }
            )
        )->where('status',1);
        if (Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();
            $surveyInfo->join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id');
            $surveyInfo->where('sur_survey_organization.organization_id',$userInfo->organization_id);
        }
        $surveyInfo=$surveyInfo->get();

//        $surveyInfo = Survey::with(
//            array(
//                'SurveyResult' => function ($query) {
//                    $query->select('id','survey_id', 'item_id','organization_id','user_id','latitude','longitude')->with(
//                        array(
//                            'SurveyItem' => function ($q) {
//                                $q->select('id','itemtexten','itemtextbn','itemvalueen','itemvaluebn');
//                            }
//                        )
//                    );
//                }
//            )
//        )->where('status',1)->get();
//        $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();
//
//        $surveySelect = Survey::join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id')
//                                    ->where('sur_survey.status',1);
//                                    if(Auth::user()->hasRole('Reporter') || Auth::user()->hasRole('Admin')){
//                                        $surveySelect->where('sur_survey_organization.organization_id',$userInfo->organization_id);
//                                    }
////                                    ->where('sur_survey_organization.organization_id',$userInfo->organization_id);
//            if(session()->get('locale') == 'en'){
//                $surveySelect = $surveySelect->pluck('sur_survey.nameen','sur_survey.id')->all();
//            }else{
//                $surveySelect = $surveySelect->pluck('sur_survey.namebn','sur_survey.id')->all();
//            }
//
//        $surveySelect[''] = 'Choose Survey';
//        ksort($surveySelect);
        $surveySelect = Survey::join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id')
            ->where('sur_survey.status',1);

        if (Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();
            $surveySelect->where('sur_survey_organization.organization_id',$userInfo->organization_id);
        }
        if(session()->get('locale') == 'en'){
            $surveySelect = $surveySelect->pluck('sur_survey.nameen','sur_survey.id')->all();
        }else{
            $surveySelect = $surveySelect->pluck('sur_survey.namebn','sur_survey.id')->all();
        }
        $surveySelect[''] = 'Choose Survey';
        ksort($surveySelect);

        return view("backend.admin.value-wise-report",compact(['surveySelect','surveyInfo']));
    }


    public function valueWiseGraph(Request $request){
        $input = $request->all();

        $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();

        $surveyItems = SurveyItem::where('survey_id',$input['survey_id']);
                if ($input['item_id'] != 'all'){
                    $surveyItems->where('id', $input['item_id']);
                }

        $surveyItems=$surveyItems->get();

        $surveyResult = SurveyResult::select([
            DB::raw('count(sur_survey_result.id) as total'),
            'sur_item.id as surveyItemId',
            'sur_item.itemtexten',
            'sur_item.itemtextbn',
        ])
            ->join('sur_item', 'sur_survey_result.item_id', '=', 'sur_item.id')
            ->where('sur_survey_result.survey_id',$input['survey_id'])
//            ->where('sur_survey_result.organization_id', $userInfo->organization_id)
            ->where('sur_survey_result.date',date("d-m-Y", strtotime($input['date'])) );
            if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
                $surveyResult->where('sur_survey_result.organization_id',$userInfo->organization_id);
            }
            if ($input['item_id'] != 'all'){
                $surveyResult = $surveyResult->where('sur_survey_result.item_id', $input['item_id']);
            }

        $surveyResult = $surveyResult->groupBy('sur_survey_result.item_id')->get();

        $arraySurveyArray=[];
        foreach ($surveyResult as $value) {
            $arraySurveyArray[$value->surveyItemId]=$value;
        }
//        dd($arraySurveyArray);
        $data = '';
        $dataWithColor = '';
        if($surveyItems){
            foreach ($surveyItems as $item){
//                dd($item);
                if(isset($arraySurveyArray[$item->id])){
                    $dataWithColor.='am5.color(0x'.$item->color_code.'),';
                    if (session()->get('locale') == 'en') {
                        $data .= "{ item:'" . $arraySurveyArray[$item->id]->itemtexten . "', value:" . $arraySurveyArray[$item->id]->total . "}, ";
                    } else {
                        $data .= "{ item:'" . $arraySurveyArray[$item->id]->itemtextbn . "', value:" . $arraySurveyArray[$item->id]->total . "}, ";
                    }
                }else{
                    if (session()->get('locale') == 'en') {
                        $data .= "{ item:'" . $item->itemtexten . "', value:0}, ";
                    } else {
                        $data .= "{ item:'" . $item->itemtextbn . "', value:0}, ";
                    }
                }
            }
        }
        $data = substr($data, 0, -2);


        $totalResponse = SurveyResult::where('sur_survey_result.survey_id', $input['survey_id'])
//            ->where('sur_survey_result.organization_id', $userInfo->organization_id)
            ->where('sur_survey_result.date', date("d-m-Y", strtotime($input['date'])));
            if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
                $totalResponse->where('sur_survey_result.organization_id',$userInfo->organization_id);
            }
            if ($input['item_id'] != 'all'){
                $totalResponse->where('sur_survey_result.item_id', $input['item_id']);
            }
        $totalResponse=$totalResponse->count();


        $surveySelect = Survey::join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id')
            ->where('sur_survey.status',1);
            if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
                $surveySelect->where('sur_survey_organization.organization_id',$userInfo->organization_id);
            }
        if(session()->get('locale') == 'en'){
            $surveySelect = $surveySelect->pluck('sur_survey.nameen','sur_survey.id')->all();
        }else{
            $surveySelect = $surveySelect->pluck('sur_survey.namebn','sur_survey.id')->all();
        }

        $surveySelect[''] = 'Choose Survey';
        ksort($surveySelect);

        $survey = Survey::where('status',1)->where('id',$input['survey_id'])->first();

        $surveyItem = SurveyItem::where('survey_id',$input['survey_id']);
        if(session()->get('locale') == 'en'){
            $surveyItem = $surveyItem->pluck('itemtexten','id')->all();
        }else{
            $surveyItem = $surveyItem->pluck('itemtextbn','id')->all();
        }
        $surveyItem['all'] = 'All';

        return view("backend.admin.value-wise-report",compact(['surveySelect','survey','data','totalResponse','input','surveyItem','dataWithColor']));
    }

    public function compareReport(Request $request){
        ConfigurationHelper::Language();

        $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();

        $surveySelect = Survey::join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id')
            ->where('sur_survey.status',1);
//            ->where('sur_survey_organization.organization_id',$userInfo->organization_id);
            if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
                $surveySelect->where('sur_survey_organization.organization_id',$userInfo->organization_id);
            }
        if(session()->get('locale') == 'en'){
            $surveySelect = $surveySelect->pluck('sur_survey.nameen','sur_survey.id')->all();
        }else{
            $surveySelect = $surveySelect->pluck('sur_survey.namebn','sur_survey.id')->all();
        }

        $surveySelect[''] = 'Choose Survey';
        ksort($surveySelect);
        $compareData['data']='';
        $compareData['totalResponse']=0;
        $survey = '';
        if($request->get('compare_form_submit')=='compare_form_submit'){
            $input = $request->all();
            $survey = Survey::where('status',1)->where('id',$input['survey_id'])->first();
            $compareData= $this->compareGraph($input);
            $surveyItem = SurveyItem::where('survey_id',$input['survey_id']);
            if(session()->get('locale') == 'en'){
                $surveyItem = $surveyItem->pluck('itemtexten','id')->all();
            }else{
                $surveyItem = $surveyItem->pluck('itemtextbn','id')->all();
            }
            return view("backend.admin.compare-report",compact(['surveySelect','compareData','input','surveyItem','survey']));
        }else{
            return view("backend.admin.compare-report",compact(['surveySelect','compareData','survey']));
        }
    }

    private function compareGraph($input){
        $startDate = date("Y-m-d", strtotime($input['startdate']));
        $endDate = date("Y-m-d", strtotime($input['enddate']));
        $allDates = $this->getDatesFromRange($startDate,$endDate);

        $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();
        $surveyItems = SurveyItem::where('survey_id',$input['survey_id'])->get();

        $surveyResult = SurveyResult::select([
            DB::raw('count(sur_survey_result.id) as total'),
            'sur_item.id as surveyItemId',
            'sur_item.itemtexten',
            'sur_item.itemtextbn',
            'sur_item.color_code',
            'sur_survey_result.date',
        ])
            ->join('sur_item', 'sur_survey_result.item_id', '=', 'sur_item.id')
            ->where('sur_survey_result.survey_id',$input['survey_id'])

            ->where('sur_survey_result.created_at','>=', $startDate.' 00:00:00')->where('sur_survey_result.created_at','<=', $endDate.' 23:59:59');
        if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $surveyResult->where('sur_survey_result.organization_id',$userInfo->organization_id);
        }
        $totalResult = $surveyResult->groupBy('sur_survey_result.date')->get();
        $surveyResult->where('sur_survey_result.item_id', $input['item_id']);
        $surveyResults = $surveyResult->groupBy('sur_survey_result.date')->get();

//dd(count($surveyResults));
        $data = '';
//        $dataWithColor.='am5.color(0x'.$item->color_code.'),';
        $dataWithColor = '';
        if (count($surveyResults)>0){
            $allResultDate =[];
            foreach ($surveyResults as $value) {
                $allResultDate[$value->date]= $value;
                $dataWithColor.='am5.color(0x'.$value->color_code.'),';
            }
            $data = '';
            $totalResponse = 0;
            $response = array();
            foreach ($allDates as $date){
                $date = date("d-m-Y", strtotime($date));
                if (isset($allResultDate[$date])){
                    $data .= "{ item:'" . $allResultDate[$date]->date . "', value:" . $allResultDate[$date]->total . "}, ";
                    $totalResponse = $totalResponse+$allResultDate[$date]->total;
                    $response['totalResponse'] = $totalResponse;
                    $response['item'] = $allResultDate[$date]->itemtexten;
                }else{
                    $data .= "{ item:'" . $date . "', value:0}, ";
                }
            }
        }else{
            $response['totalResponse'] = 0;
            $itemData = SurveyItem::find($input['item_id']);
            $response['item'] = $itemData->itemtexten;
        }


        if (count($totalResult)>0){
            $totalResultDate =[];
            foreach ($totalResult as $value) {
                $totalResultDate[$value->date]= $value;
            }
            $totalallResponse = 0;
            foreach ($allDates as $date){
                $date = date("d-m-Y", strtotime($date));
                if (isset($totalResultDate[$date])){
                    $totalallResponse = $totalallResponse+$totalResultDate[$date]->total;
                    $response['total'] = $totalallResponse;
                }
            }
        }else{
            $response['total'] = 0;
        }

        $response['data'] = $data;
        $response['dataWithColor'] = $dataWithColor;
        return $response;
    }

    private function getDatesFromRange($start, $end){
        $dates = array($start);
        while(end($dates) < $end){
            $dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
        }
        return $dates;
    }

    public function surveyWiseItem(){
        $surveyId = $_GET['surveyId'];
        $surveyItem = SurveyItem::where('survey_id',$surveyId);
        if(session()->get('locale') == 'en'){
            $surveyItem = $surveyItem->pluck('itemtexten','id')->all();
        }else{
            $surveyItem = $surveyItem->pluck('itemtextbn','id')->all();
        }
//        $surveyItem[''] = 'Choose Item';
        krsort($surveyItem);
        $response['items'] = $surveyItem;
//        dd($response);
        return $response;
    }


    public function statusChange(){
        $tableName = $_GET['table'];
        $id = $_GET['id'];
        $value = $_GET['value'];

        $response = [];

//        echo $id;

        $data = DB::table($tableName)->where('id',$id);
        $data->update([
            'status' => $value,
            'updated_by' => Auth::user()->id,
        ]);

        DB::commit();

        if ($data){
            if ($value == 0){
                $response['value'] = 1;
            }else{
                $response['value'] = 0;
            }
            $response['id'] = $id;
            return $response;
        }
    }

    public function passwordChange(){
        $ModuleTitle = "Password Change";
        $PageTitle = "Password Change";

        return view('User::user.passwordchange',compact('PageTitle','ModuleTitle'));
    }

    public function updatePassword(Request $request){
        $input = $request->all();

        $request->validate([
            'password' => 'required',
            'confirmed' => 'required_with:password|same:password'
        ]);
        $UserUpdateModel = User::where('id',Auth::user()->id)->first();
//        $Password = $input['password'];
//        $input['password'] = password_hash($Password,PASSWORD_DEFAULT)
        $password['password'] = password_hash($input['password'],PASSWORD_DEFAULT);
        $UserUpdateModel->update($password);
        $UserUpdateModel->save();
        Session::flash('message', 'Password Change Successfully!');
        return redirect()->back();
    }

    public function dbBackup(){
        $DBUSER="root";
        $DBPASSWD="nourishLive";
        $DATABASE="survey";

        $filename = "survey-" . date("d-m-Y") . ".sql.gz";
        $mime = "application/x-gzip";


        header( "Content-Type: " . $mime );
        header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
        $cmd = "mysqldump -u $DBUSER --password=$DBPASSWD $DATABASE | gzip --best";
        passthru( $cmd );

        exit(0);
    }
}
