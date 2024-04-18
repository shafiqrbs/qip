<?php

namespace App\Modules\Configuration\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use Illuminate\Http\Request;
use App\Modules\Configuration\Requests;
use App\Modules\Configuration\Models\Configuration;

use DB;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;
class ConfigurationController extends Controller
{

    public function __construct()
    {
        ConfigurationHelper::Language();
    }

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
//    public function welcome()
//    {
//        return view("Configuration::welcome");
//    }

    public function index(){
        ConfigurationHelper::Language();
        $ModuleTitle = __('Configuration::ControllerMsg.ModuleTitle');
        $PageTitle = __('Configuration::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Configuration::ControllerMsg.TableTitle');

//        $ModuleTitle = "Manage Configuration ";
//        $PageTitle = " Configuration list";
//        $TableTitle = " Configuration list";

        $AllConfiguration = Configuration::where('status',1)->orderby('id','desc')->paginate(10);

        return view("Configuration::configuration.index", compact('ModuleTitle','PageTitle','TableTitle','AllConfiguration'));
    }

    public function create(){
        ConfigurationHelper::Language();
        $ModuleTitle = __('Configuration::ControllerMsg.ModuleTitle');
        $PageTitle = __('Configuration::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Configuration::ControllerMsg.TableTitle');

//        $AllBrand = Brand::where('status',1)->orderby('id','desc')->paginate(10);

        return view("Configuration::configuration.create", compact('ModuleTitle','PageTitle','TableTitle'));
    }

    public function store(Requests\Configuration $request){
        $input = $request->all();

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            // Store brand data
            if ($ConfigurationData = Configuration::create($input)) {
                $ConfigurationData->save();
            }

            DB::commit();
            Session::flash('message', 'Information added Successfully!');
//                return redirect()->back();
            return redirect()->route('admin.configuration.index');
        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function edit($id){
        ConfigurationHelper::Language();
        $ModuleTitle = __('Configuration::ControllerMsg.ModuleTitle');
        $PageTitle = __('Configuration::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Configuration::ControllerMsg.TableTitle');

        $data = Configuration::where('status','1')->where('id',$id)->first();

        return view("Configuration::configuration.edit", compact('data','ModuleTitle','PageTitle','TableTitle'));

    }

    public function update(Requests\Configuration $request,$id){
        ConfigurationHelper::Language();
        $input = $request->all();
        $UpdateModel = Configuration::where('id',$id)->first();

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            // update Configuration data
            $UpdateModel->update($input);
            $UpdateModel->save();
            DB::commit();

            Session::flash('message', __('Configuration::FormValidation.UpdateData'));
            return redirect()->back();

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function inactive($id){
        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            $data = Configuration::where('id',$id);
            $data->update([
                'status' => 0,
                'updated_by' => Auth::user()->id,
            ]);
            DB::commit();
            Session::flash('message', 'Remove from List');
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
        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            $ConfigurationModel = Configuration::where('id', $id)
                ->select('*')
                ->first();
            $ConfigurationModel->delete();

            DB::commit();
            Session::flash('delete', 'Delete Successfully !');
            return redirect()->back();
        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }
}
