<?php

namespace App\Modules\Organization\Http\Controllers;
use App\Modules\Configuration\ConfigurationHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\Organization\Models\Organization;
use App\Modules\Organization\Requests;

use App\Support\Collection;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Session;


use DB;
use Image;
use File;
use Storage;
use App;
Use Auth;

class OrganizationController extends Controller
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
        $ModuleTitle = __('Organization::ControllerMsg.ModuleTitle');
        $PageTitle = __('Organization::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Organization::ControllerMsg.TableTitle');

        $allOrganization = Organization::orderby('id','desc')->paginate(10);

        return view("Organization::organization.index", compact('ModuleTitle','PageTitle','TableTitle','allOrganization'));
    }

    public function create(){
        $ModuleTitle = __('Organization::ControllerMsg.ModuleTitle');
        $PageTitle = __('Organization::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Organization::ControllerMsg.TableTitle');

        return view("Organization::organization.create", compact('ModuleTitle','PageTitle','TableTitle'));
    }

    public function store(Requests\Organization $request)
    {
        $input = $request->all();

        $EmailExistsOrNot = Organization::where('email', $input['email'])->count();

        if ($EmailExistsOrNot == 0){
            DB::beginTransaction();
            try {
                if ($organizationData = Organization::create($input)) {
                    $organizationData->save();
                }

                DB::commit();
                Session::flash('message',__('Organization::FormValidation.DataAdd'));
                return redirect()->route('admin.organization.index');
            } catch (\Exception $e) {
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
        }else{
            Session::flash('validate',__('Organization::FormValidation.emailExists'));
            return redirect()->back()->withInput($input);
        }
    }


    public function edit($id){
        $ModuleTitle = __('Organization::ControllerMsg.ModuleTitle');
        $PageTitle = __('Organization::ControllerMsg.PageTitleUpdate');

        $data = Organization::where('status','1')->where('id',$id)->first();

        return view("Organization::organization.edit", compact('data','ModuleTitle','PageTitle'));
    }


    public function update(Requests\Organization $request,$id){
        $input = $request->all();

        $EmailExistsOrNot = Organization::where('email', $input['email'])->count();
        $EmailToId = Organization::where('email',$input['email'])->first();

        if ($EmailExistsOrNot == 0 || ($EmailExistsOrNot == 1 && $id == $EmailToId->id)) {
            $UpdateModel = Organization::where('id',$id)->first();

            DB::beginTransaction();
            try {
                $UpdateModel->update($input);
                $UpdateModel->save();

                DB::commit();

                Session::flash('message', __('Organization::FormValidation.UpdateData'));
                return redirect()->route('admin.organization.index');
            } catch (\Exception $e) {
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
        }else{
            Session::flash('validate', __('Organization::FormValidation.emailExists'));
            return redirect()->back()->withInput($input);
        }
    }

    public function inactive($id){
        DB::beginTransaction();
        try {
            $data = Organization::where('id',$id);
            $data->update([
                'status' => 0,
                'updated_by' => Auth::user()->id,
            ]);
            DB::commit();
            Session::flash('message', __('Organization::FormValidation.RemoveList'));
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
            $organizationExists = DB::table('sur_survey_organization')->where('organization_id',$id)->count();
//            dd($organizationExists);
            if ($organizationExists == 0){
                $DeleteModel = Organization::where('id', $id)
                    ->select('*')
                    ->first();

                $DeleteModel->delete();
                Session::flash('delete', __('Organization::FormValidation.DeleteMsg'));
                DB::commit();
                return redirect()->back();
            }else{
//                Session::flash('delete', __('Organization::FormValidation.DeleteMsg'));
                Session::flash('delete', 'Already use this organization');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public  function getorganizationdata(){
        $appUrl=env('APP_URL');
        $response = Http::withHeaders([
            'x-api-key' => 'survey',
            'x-api-value' => 'survey@123',
            'x-api-secret' => 'survey'
        ])->get($appUrl.'api/organization/getorganizationdata');
        $body = $response->getBody()->getContents();
        $allOrganization = json_decode($body);
        return $allOrganization;
    }
}
