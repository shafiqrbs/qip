<?php

namespace App\Modules\SurveyResult\Http\Controllers;

use App\Entity\Admin\Bank;
use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use App\Modules\Survey\Models\Survey;
use App\Modules\SurveyResult\Models\SurveyResult;
use App\Modules\Survey\Models\SurveyOrganization;
use App\Modules\SurveyItem\Models\SurveyItem;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use App\Modules\SurveyResult\Requests;

use App\Support\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;


use DB;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;

class SurveyResultController extends Controller{

    public function __construct()
    {
        $Language = ConfigurationHelper::Language();
    }

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        ConfigurationHelper::Language();
        $ModuleTitle = __('SurveyResult::ControllerMsg.ModuleTitle');
        $PageTitle = __('SurveyResult::ControllerMsg.PageTitleAdd');
        $TableTitle = __('SurveyResult::ControllerMsg.TableTitle');

        $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();
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

        $selectOrganization = Organization::where('status',1);
        if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $selectOrganization->where('id',$userInfo->organization_id);
        }
        $selectOrganization = $selectOrganization->pluck('name','id')->all();
        $selectOrganization[''] = 'Choose Organization';
        ksort($selectOrganization);

        $allSurveyResults = SurveyResult::orderby('id','desc');
        if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $allSurveyResults->where('organization_id',$userInfo->organization_id);
        }
        $allSurveyResults = $allSurveyResults->paginate(20);

        if($request->get('survey_result_search_form_submit')=='survey_result_search_form_submit'){
            $input = $request->all();
            $allSurveyResults = SurveyResult::orderby('id','desc');
            if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
                $allSurveyResults->where('organization_id',$userInfo->organization_id);
            }

            if ((isset($input['startdate']) && !empty($input['startdate'])) && (isset($input['enddate']) && !empty($input['enddate']))){
                $startDate = date("Y-m-d", strtotime($input['startdate']));
                $endDate = date("Y-m-d", strtotime($input['enddate']));
                $allSurveyResults->where('sur_survey_result.created_at','>=', $startDate.' 00:00:00')->where('sur_survey_result.created_at','<=', $endDate.' 23:59:59');
            }

            if (isset($input['survey_id']) && !empty($input['survey_id'])){
                 $allSurveyResults->where('sur_survey_result.survey_id', $input['survey_id'] );
            }

            if (isset($input['item_id']) && !empty($input['item_id'])){
                if ($input['item_id'] != 'all'){
                    $allSurveyResults->where('sur_survey_result.item_id', $input['item_id'] );
                }
            }

            if (isset($input['device_id']) && !empty($input['device_id'])){
                $allSurveyResults->where('sur_survey_result.device_id', $input['device_id'] );
            }

            if (isset($input['organization_id']) && !empty($input['organization_id'])){
                $allSurveyResults->where('sur_survey_result.organization_id', $input['organization_id']);
            }

            $allSurveyResults = $allSurveyResults->paginate(20)->appends(request()->query());

            $surveyItem = '';
            if (isset($input['survey_id']) && !empty($input['survey_id'])){
                $surveyItem = SurveyItem::where('survey_id',$input['survey_id']);
                if(session()->get('locale') == 'en'){
                    $surveyItem = $surveyItem->pluck('itemtexten','id')->all();
                }else{
                    $surveyItem = $surveyItem->pluck('itemtextbn','id')->all();
                }
                $surveyItem['all'] = 'All';
                ksort($surveyItem);
            }

            return view("SurveyResult::SurveyResult.index", compact('ModuleTitle','PageTitle','TableTitle','allSurveyResults','surveySelect','input','surveyItem','selectOrganization'));
        }

        return view("SurveyResult::SurveyResult.index", compact('ModuleTitle','PageTitle','TableTitle','allSurveyResults','surveySelect','selectOrganization'));
    }

    public function create(){
        $ModuleTitle = __('SurveyResult::ControllerMsg.ModuleTitle');
        $PageTitle = __('SurveyResult::ControllerMsg.PageTitleAdd');
        $TableTitle = __('SurveyResult::ControllerMsg.TableTitle');

        $Organization = Organization::where('status','1')->pluck('name','id')->all();
        $Organization[''] = 'Choose Organization';
        ksort($Organization);

        $Item = SurveyItem::where('status','1')->pluck('itemtexten','id')->all();
        $Item[''] = 'Choose Item';
        ksort($Item);

        if(session()->get('locale') == 'bn'){
            $survey = Survey::where('status','1')->pluck('namebn','id')->all();
        }else{
            $survey = Survey::where('status','1')->pluck('nameen','id')->all();
        }

        return view("SurveyResult::SurveyResult.create", compact('ModuleTitle','PageTitle','TableTitle','Organization','Item','survey'));
    }

    public function store(Requests\SurveyResult $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['date'] = date('d-m-Y');

        DB::beginTransaction();
        try {
            if ($SurveyResultData = SurveyResult::create($input)) {
                $SurveyResultData->save();
            }

            DB::commit();
            Session::flash('message',__('SurveyResult::FormValidation.DataAdd'));
            return redirect()->route('admin.surveyresult.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function edit($id){
        $ModuleTitle = __('SurveyResult::ControllerMsg.ModuleTitle');
        $PageTitle = __('SurveyResult::ControllerMsg.PageTitleUpdate');

        $data = SurveyResult::where('status','1')->where('id',$id)->first();

        $Organization = Organization::where('status','1')->pluck('name','id')->all();
        $Organization[''] = 'Choose Organization';
        ksort($Organization);

        $Item = SurveyItem::where('status','1')->pluck('itemtexten','id')->all();
        $Item[''] = 'Choose Item';
        ksort($Item);

        if(session()->get('locale') == 'bn'){
            $survey = Survey::where('status','1')->pluck('namebn','id')->all();
        }else{
            $survey = Survey::where('status','1')->pluck('nameen','id')->all();
        }

        return view("SurveyResult::SurveyResult.edit", compact('data','ModuleTitle','PageTitle','Organization','Item','survey'));
    }


    public function update(Requests\SurveyResult $request,$id){
        $input = $request->all();
        $UpdateModel = SurveyResult::where('id',$id)->first();

        DB::beginTransaction();
        try {
            $UpdateModel->update($input);
            $UpdateModel->save();

            DB::commit();

            Session::flash('message', __('SurveyResult::FormValidation.UpdateData'));
            return redirect()->route('admin.surveyresult.index');
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
            $data = SurveyResult::where('id',$id);
            $data->update([
                'status' => 0,
                'updated_by' => Auth::user()->id,
            ]);
            DB::commit();
            Session::flash('message', __('SurveyResult::FormValidation.RemoveList'));
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
            $DeleteModel = SurveyResult::where('id', $id)
                ->select('*')
                ->first();

            $DeleteModel->delete();
            Session::flash('delete', __('SurveyResult::FormValidation.DeleteMsg'));
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function getsurveyresult(){
        $appUrl=env('APP_URL');
        $response = Http::withHeaders([
            'x-api-key' => 'survey',
            'x-api-value' => 'survey@123',
            'x-api-secret' => 'survey'
        ])->get($appUrl.'api/surveyresult/getsurveyresult');
        $body = $response->getBody()->getContents();
        $allResult = json_decode($body);
        dd($allResult);
        return $allResult;
    }

    public function getsurveyresultGroupBy(){
        $appUrl=env('APP_URL');
        $response = Http::withHeaders([
            'x-api-key' => 'survey',
            'x-api-value' => 'survey@123',
            'x-api-secret' => 'survey'
        ])->get($appUrl.'api/surveyresult/getsurveyresultGroupBy');
        $body = $response->getBody()->getContents();
        $allResult = json_decode($body);
        dd($allResult);
        return $allResult;
    }

    public function downloadCSV(Request $request){
        set_time_limit(0);
        ignore_user_abort(true);
        $array = array();

        $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();

//        if($request->get('survey_result_download_excel')=='survey_result_download_excel') {
            $input = $request->all();
            $allSurveyResults = SurveyResult::orderby('id', 'desc');
            if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
                $allSurveyResults->where('organization_id',$userInfo->organization_id);
            }
            if(isset($input['organization_id']) && !empty(isset($input['organization_id']))){
                $allSurveyResults->where('organization_id',$input['organization_id']);
            }
//            ->where('organization_id', $userInfo->organization_id);

            if ((isset($input['startdate']) && !empty($input['startdate'])) && (isset($input['enddate']) && !empty($input['enddate']))) {
                $startDate = date("Y-m-d", strtotime($input['startdate']));
                $endDate = date("Y-m-d", strtotime($input['enddate']));
                $allSurveyResults->where('sur_survey_result.created_at', '>=', $startDate . ' 00:00:00')->where('sur_survey_result.created_at', '<=', $endDate . ' 23:59:59');
            }

            if (isset($input['survey_id']) && !empty($input['survey_id'])) {
                $allSurveyResults->where('sur_survey_result.survey_id', $input['survey_id']);
            }

            if (isset($input['item_id']) && !empty($input['item_id'])) {
                if ($input['item_id'] != 'all') {
                    $allSurveyResults->where('sur_survey_result.item_id', $input['item_id']);
                }
            }

            if (isset($input['device_id']) && !empty($input['device_id'])){
                $allSurveyResults->where('sur_survey_result.device_id', $input['device_id'] );
            }

            if (isset($input['user_id']) && !empty($input['user_id'])){
                $allSurveyResults->where('sur_survey_result.user_id', $input['user_id'] );
            }

            $allSurveyResults = $allSurveyResults->get();
//        }else{
//            $allSurveyResults = SurveyResult::where('status',1)->where('organization_id',$userInfo->organization_id)->orderby('id','desc')->get();
//        }

//        dd($allSurveyResults);

        $html = \Illuminate\Support\Facades\View::make('SurveyResult::SurveyResult._excel',compact('allSurveyResults'));
        $contents = $html->render();
        if($request->get('survey_result_download_excel')=='survey_result_download_excel'){
            $fileName = 'survey_result.xls';

            header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=$fileName");

            echo $contents;
            die;
        }else{
            // Configure Dompdf according to your needs
            $pdfOptions = new Options();
            $pdfOptions->set('defaultFont', 'Arial');

            // Instantiate Dompdf with our options
            $dompdf = new Dompdf($pdfOptions);

            // Load HTML to Dompdf
            $dompdf->loadHtml($contents);

            // (Optional) Setup the paper size and orientation 'portrait' or 'landscape'
            $dompdf->setPaper('legal', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();
            $fileName = 'survey_result'.'_'.time().".pdf";

            // Output the generated PDF to Browser (force download)
            $dompdf->stream($fileName, [
                "Attachment" => true
            ]);

            die();
        }
    }

}
