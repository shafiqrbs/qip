<?php

namespace App\Modules\SurveyItem\Http\Controllers;
use App\Modules\Configuration\ConfigurationHelper;
use App\Http\Controllers\Controller;

use App\Modules\Survey\Models\Survey;
use App\Modules\SurveyItem\Models\SurveyItem;
use App\Modules\SurveyItem\Requests;


use DB;
use Illuminate\Support\Facades\Http;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;

class SurveyItemController extends Controller
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
        $ModuleTitle = __('SurveyItem::ControllerMsg.ModuleTitle');
        $PageTitle = __('SurveyItem::ControllerMsg.PageTitleAdd');
        $TableTitle = __('SurveyItem::ControllerMsg.TableTitle');

        $allSurveyItem = SurveyItem::orderby('id','desc')->paginate(10);
//        dd($allOrganization);

        return view("SurveyItem::SurveyItem.index", compact('ModuleTitle','PageTitle','TableTitle','allSurveyItem'));
    }

    public function create(){
        $ModuleTitle = __('SurveyItem::ControllerMsg.ModuleTitle');
        $PageTitle = __('SurveyItem::ControllerMsg.PageTitleAdd');
        $TableTitle = __('SurveyItem::ControllerMsg.TableTitle');

        if(session()->get('locale') == 'bn'){
            $survey = Survey::where('status','1')->pluck('namebn','id')->all();
        }else{
            $survey = Survey::where('status','1')->pluck('nameen','id')->all();
        }

        return view("SurveyItem::SurveyItem.create", compact('ModuleTitle','PageTitle','TableTitle','survey'));
    }

    public function store(Requests\SurveyItem $request)
    {
        $input = $request->all();
        $input['color_code']=str_replace("#", "", $input['color_code']);

        DB::beginTransaction();
        try {
            if ($itemData = SurveyItem::create($input)) {
                $itemData->save();
            }

            DB::commit();
            Session::flash('message',__('SurveyItem::FormValidation.DataAdd'));
            return redirect()->route('admin.surveyitem.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function edit($id){
        $ModuleTitle = __('SurveyItem::ControllerMsg.ModuleTitle');
        $PageTitle = __('SurveyItem::ControllerMsg.PageTitleUpdate');

        $data = SurveyItem::where('status','1')->where('id',$id)->first();
        if(session()->get('locale') == 'bn'){
            $survey = Survey::where('status','1')->pluck('namebn','id')->all();
        }else{
            $survey = Survey::where('status','1')->pluck('nameen','id')->all();
        }

        return view("SurveyItem::SurveyItem.edit", compact('data','ModuleTitle','PageTitle','survey'));
    }


    public function update(Requests\SurveyItem $request,$id){
        $input = $request->all();
        $input['color_code']=str_replace("#", "", $input['color_code']);

        $UpdateModel = SurveyItem::where('id',$id)->first();

        DB::beginTransaction();
        try {
            $UpdateModel->update($input);
            $UpdateModel->save();

            DB::commit();

            Session::flash('message', __('SurveyItem::FormValidation.UpdateData'));
            return redirect()->route('admin.surveyitem.index');
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
            $data = SurveyItem::where('id',$id);
            $data->update([
                'status' => 0,
                'updated_by' => Auth::user()->id,
            ]);
            DB::commit();
            Session::flash('message', __('SurveyItem::FormValidation.RemoveList'));
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
            $surveyResultExists = DB::table('sur_survey_result')->where('item_id',$id)->count();
            if ($surveyResultExists == 0){
                $DeleteModel = SurveyItem::where('id', $id)
                    ->select('*')
                    ->first();

                $DeleteModel->delete();
                Session::flash('delete', __('SurveyItem::FormValidation.DeleteMsg'));
                DB::commit();
                return redirect()->back();
            }else{
                Session::flash('delete','Already use this item');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function getsurveyitem(){
        $appUrl=env('APP_URL');
        $response = Http::withHeaders([
            'x-api-key' => 'survey',
            'x-api-value' => 'survey@123',
            'x-api-secret' => 'survey'
        ])->get($appUrl.'api/surveyitem/getsurveyitem');
        $body = $response->getBody()->getContents();
        $allOrganization = json_decode($body);
        return $allOrganization;
    }
}
