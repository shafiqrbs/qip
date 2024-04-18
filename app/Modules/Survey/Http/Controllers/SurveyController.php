<?php

namespace App\Modules\Survey\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Survey\Models\Survey;
use App\Modules\Survey\Models\SurveyOrganization;
use App\Modules\Survey\Models\SurveyOrganizationPerson;
use App\Modules\Organization\Models\Organization;
use App\Modules\Survey\Requests;


use DB;
use Illuminate\Http\Request;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;

class SurveyController extends Controller
{
    public function __construct()
    {
        $Language = ConfigurationHelper::Language();
    }

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ConfigurationHelper::Language();
        $ModuleTitle = __('Survey::ControllerMsg.ModuleTitle');
        $PageTitle = __('Survey::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Survey::ControllerMsg.TableTitle');

        $allSurvey = Survey::orderby('id','desc')->paginate(10);

        return view("Survey::survey.index", compact('ModuleTitle','PageTitle','TableTitle','allSurvey'));
    }

    public function create(){
        $ModuleTitle = __('Survey::ControllerMsg.ModuleTitle');
        $PageTitle = __('Survey::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Survey::ControllerMsg.TableTitle');
        $Organization = Organization::where('status','1')->pluck('name','id')->all();

        return view("Survey::survey.create", compact('ModuleTitle','PageTitle','TableTitle','Organization'));
    }

    public function store(Requests\Survey $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {
            if ($SurveyData = Survey::create($input)) {
                $SurveyData->save();

                foreach ($input['organization_id'] as $value){
                    $organizationData['survey_id'] = $SurveyData->id;
                    $organizationData['organization_id'] = $value;
                    SurveyOrganization::create($organizationData);
                }
            }

            DB::commit();
            Session::flash('message',__('Organization::FormValidation.DataAdd'));
            return redirect()->route('admin.survey.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function edit($id){
        $ModuleTitle = __('Survey::ControllerMsg.ModuleTitle');
        $PageTitle = __('Survey::ControllerMsg.PageTitleUpdate');

        $data = Survey::where('status','1')->where('id',$id)->first();
        $Organization = Organization::where('status','1')->pluck('name','id')->all();

        return view("Survey::survey.edit", compact('data','ModuleTitle','PageTitle','Organization'));
    }


    public function update(Requests\Survey $request,$id){
        $input = $request->all();
        $UpdateModel = Survey::where('id',$id)->first();

        DB::beginTransaction();
        try {
            $UpdateModel->update($input);
            $UpdateModel->save();

            if (isset($input['organization_id']) && !empty($input['organization_id'])){
                $deleteModel = DB::table('sur_survey_organization')->where('survey_id',$id)->delete();
                foreach ($input['organization_id'] as $value){
                    $organizationData['survey_id'] = $id;
                    $organizationData['organization_id'] = $value;
                    SurveyOrganization::create($organizationData);
                }
            }

            DB::commit();

            Session::flash('message', __('Survey::FormValidation.UpdateData'));
            return redirect()->route('admin.survey.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function inactive($id){
        DB::beginTransaction();
        try {
            $data = Survey::where('id',$id);
            $data->update([
                'status' => 0,
                'updated_by' => Auth::user()->id,
            ]);
            DB::commit();
            Session::flash('message', __('Survey::FormValidation.RemoveList'));
            return redirect()->back();
        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function delete($id){
        DB::beginTransaction();
        try {

            $surveyItemExists = DB::table('sur_item')->where('survey_id',$id)->count();

            if ($surveyItemExists == 0){
                $deleteModel = DB::table('sur_survey_organization')->where('survey_id',$id)->delete();

                $DeleteModel = Survey::where('id', $id)
                    ->select('*')
                    ->first();

                $DeleteModel->delete();
                Session::flash('delete', __('Survey::FormValidation.DeleteMsg'));
                DB::commit();
                return redirect()->back();
            }else{
                Session::flash('delete', 'Already use this survey');
                DB::commit();
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function assignperson($id){
        $ModuleTitle = __('Survey::ControllerMsg.ModuleTitle');
        $PageTitle = __('Survey::ControllerMsg.surveyCalender');

        $surveyId = $id;
        $survyName = Survey::find($id);
        return view("Survey::survey.assignperson", compact('ModuleTitle','PageTitle','surveyId','survyName'));
    }

    public function calendarassignsearch(Requests\SurveySearch $request){
        $ModuleTitle = __('Survey::ControllerMsg.ModuleTitle');
        $PageTitle = __('Survey::ControllerMsg.surveyCalender');
        $input = $request->all();

        $surveyId = $input['survey_id'];
        $surveyExists = SurveyOrganizationPerson::where('survey_id',$input['survey_id'])->where('month',$input['month'])->where('year',$input['year'])->get();
        $surveyExistsCount = count($surveyExists);

        $month['February'] = 'February';
        $month['April'] = 'April';
        $month['June'] = 'June';
        $month['September'] = 'September';
        $month['November'] = 'November';

        if ($input['month'] == 'January' || $input['month'] == 'March' || $input['month'] == 'May'|| $input['month'] == 'July'|| $input['month'] == 'August'|| $input['month'] == 'October'|| $input['month'] == 'December'){
            $days = 31;
        }elseif ($input['month'] == 'April' || $input['month'] == 'June' || $input['month'] == 'September' || $input['month'] == 'November'){
            $days = 30;
        }else{
            $days = 29;
            if ((($input['year'] % 4) == 0) && ((($input['year'] % 100) != 0) || (($input['year'] %400) == 0))){
                $days = 29;
            }else{
                $days = 28;
            }
        }

        $survyName = Survey::find($surveyId);

        if ($surveyExistsCount == 0){
            $surveyCompany = DB::table('sur_survey_organization')
                ->join('sur_organization','sur_survey_organization.organization_id','=','sur_organization.id')
                ->select('sur_organization.id','sur_organization.name','sur_organization.mobile','sur_organization.address')
                ->where('survey_id',$input['survey_id'])->get();

            return view("Survey::survey.assignperson", compact('ModuleTitle','PageTitle','surveyId','surveyCompany','surveyExistsCount','input','days','survyName'));
        }else{
            $surveyCompany = DB::table('sur_survey_organization')
                ->join('sur_organization','sur_survey_organization.organization_id','=','sur_organization.id')
                ->select('sur_organization.id','sur_organization.name','sur_organization.mobile','sur_organization.address')
                ->where('survey_id',$input['survey_id'])->get();

            return view("Survey::survey.assignperson", compact('ModuleTitle','PageTitle','surveyId','surveyCompany','surveyExistsCount','input','days','survyName'));
        }
//        dd($surveyExistsCount);
    }

    public function calendarassignstore(){
        $month = $_GET['month'];
        $personNumber = $_GET['personNumber'];
        $date = $_GET['date'];
        $organizationId = $_GET['organizationId'];
        $surveyId = $_GET['surveyId'];
        $year = $_GET['year'];

        if ($month == 'January'){
            $date = $date.'-01-'.$year;
        }elseif ($month == 'February'){
            $date = $date.'-02-'.$year;
        }elseif ($month == 'March'){
            $date = $date.'-03-'.$year;
        }elseif ($month == 'April'){
            $date = $date.'-04-'.$year;
        }elseif ($month == 'May'){
            $date = $date.'-05-'.$year;
        }elseif ($month == 'June'){
            $date = $date.'-06-'.$year;
        }elseif ($month == 'July'){
            $date = $date.'-07-'.$year;
        }elseif ($month == 'August'){
            $date = $date.'-08-'.$year;
        }elseif ($month == 'September'){
            $date = $date.'-09-'.$year;
        }elseif ($month == 'October'){
            $date = $date.'-10-'.$year;
        }elseif ($month == 'November'){
            $date = $date.'-11-'.$year;
        }else{
            $date = $date.'-12-'.$year;
        }
//        echo $month.' '.$personNumber.' '.$date.' '.$organizationId.' '.$surveyId.' '.$year;
        $modelExists = SurveyOrganizationPerson::where('survey_id',$surveyId)->where('month',$month)->where('year',$year)->where('organization_id',$organizationId)->where('date',$date)->first();
        if ($modelExists){
            $data = SurveyOrganizationPerson::where('id',$modelExists->id);
            $data->update([
                'person' => $personNumber,
            ]);
            $response['insertMessage'] = 'Success';
        }else{
            $input['month'] = $month;
            $input['year'] = $year;
            $input['survey_id'] = $surveyId;
            $input['organization_id'] = $organizationId;
            $input['person'] = $personNumber;
            $input['date'] = $date;
            $input['ordering'] = $_GET['date'];
            $SurveyOrganizationPerson = SurveyOrganizationPerson::create($input);
            if ($SurveyOrganizationPerson){
                $response['insertMessage'] = 'Success';
            }
        }
        return $response;
    }

    public function downloadExcel(Request $request){
        $input = $request->all();
        $personData = DB::table('sur_survey_organization_person')
                                    ->where('sur_survey_organization_person.survey_id',$input['survey_id'])
                                    ->where('sur_survey_organization_person.month',$input['month'])
                                    ->where('sur_survey_organization_person.year',$input['year'])
                                    ->join('sur_survey','sur_survey.id','=','sur_survey_organization_person.survey_id')
                                    ->join('sur_organization','sur_organization.id','=','sur_survey_organization_person.organization_id')
                                    ->select('sur_survey_organization_person.month','sur_survey_organization_person.year','sur_survey_organization_person.date','sur_survey_organization_person.person','sur_survey.nameen as surveyNameEN','sur_survey.namebn as surveyNameBN','sur_organization.name as organizationName')
                                    ->orderBy('sur_survey_organization_person.organization_id','ASC')
                                    ->orderBy('sur_survey_organization_person.ordering','ASC')
                                    ->get();


        $html = \Illuminate\Support\Facades\View::make('Survey::survey._excel',compact('personData','input'));
        $contents = $html->render();

        $fileName = 'survey_calendar_person.xlsx';

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=$fileName");

        echo $contents;
        die;
    }
}
