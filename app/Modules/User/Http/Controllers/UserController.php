<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use App\Modules\User\Requests;

use DB;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;

use Spatie\Permission\Models\Role;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{

//    public function __construct()
//    {
//        $Language = ConfigurationHelper::Language();
//    }
    function __construct(){
        ConfigurationHelper::Language();
//        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','create','store','edit','update','delete']]);
//        $this->middleware('permission:user-create', ['only' => ['create','store']]);
//        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:user-delete', ['only' => ['delete']]);

    }

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        ConfigurationHelper::Language();
        $ModuleTitle = __('User::ControllerMsg.ModuleTitle');
        $PageTitle = __('User::ControllerMsg.PageTitleAdd');
        $TableTitle = __('User::ControllerMsg.TableTitle');

        $Organization = Organization::where('status','1')->pluck('name','id')->all();
        $Organization[''] = 'Choose Organization';
        ksort($Organization);

        $roles = Role::pluck('name','name')->all();

        return view("User::user.create", compact('ModuleTitle','PageTitle','TableTitle','Organization','roles'));

    }

    public function store(Requests\UserRequest $request){
        $input = $request->all();
        $validation = false;
        if (!$input['organization_id']){
            if (in_array("ADMINISTRATOR", $request->roles)) {
                $validation = true;
            }
            if (in_array("ADMIN_OPERATOR", $request->roles)) {
                $validation = true;
            }
            if (in_array("ADMIN_REPORTER", $request->roles)) {
                $validation = true;
            }
        }else{
            $validation = true;
        }

        if ($validation) {
            $EmailExistsOrNot = User::where('email', $input['email'])->count();

            if ($EmailExistsOrNot == 0) {

                $Password = $input['password'];
                $input['password'] = password_hash($Password, PASSWORD_DEFAULT);

//            if ($request->file('user_image') != '') {
//                $avatar = $request->file('user_image');
//                $file_title = $name.time().'.'.$avatar->getClientOriginalExtension();
//                $input['user_image'] = $file_title;
//                $path = public_path("backend/image/UserImage/");
//
//                $target_file =  $path.basename($file_title);
//
//                $file_path = $_FILES['user_image']['tmp_name'];
//                move_uploaded_file($file_path,$target_file);
//            }else{
//                $input['user_image'] = 'defaultuser.png';
//            }

                /* Transaction Start Here */
//            dd($input);
                DB::beginTransaction();
                try {
                    if ($UserData = User::create($input)) {
                        $UserData->save();
//                        $UserData->assignRole($request->input('roles'));
                        if ($request->roles) {
                            $UserData->assignRole($request->roles);
                        }
                    }

                    DB::commit();
                    Session::flash('message', 'Information added Successfully!');
                    return redirect()->route('admin.user.index');
                } catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    print($e->getMessage());
                    exit();
                    Session::flash('danger', $e->getMessage());
                }
            } else {
                Session::flash('validate', 'Email already exists');
                return redirect()->back()->withInput($input);
            }
        }else{
            Session::flash('validate', 'Select Organization');
            return redirect()->back()->withInput($input);
        }
    }




    public function index(){
        ConfigurationHelper::Language();
        $ModuleTitle = __('User::ControllerMsg.ModuleTitle');
        $PageTitle = __('User::ControllerMsg.PageTitleAdd');
        $TableTitle = __('User::ControllerMsg.TableTitle');

        $all_user = User::orderby('id','desc');
            if( Auth::user()->hasRole('Admin')){
                $userInfo = \Illuminate\Support\Facades\DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();
                $all_user->where('organization_id',$userInfo->organization_id);
            }
        $all_user=$all_user->paginate(10);

        return view("User::user.index", compact('ModuleTitle','PageTitle','TableTitle','all_user'));

    }

    public function edit($id){
        $ModuleTitle = "Manage User Information";
        $PageTitle = "Update User Information";

        $data = User::where('status',1)->where('id',$id)->first();

        $Organization = Organization::where('status','1')->pluck('name','id')->all();
        $Organization[''] = 'Choose Organization';
        ksort($Organization);

        $roles = Role::pluck('name','name')->all();
        $userRole = $data->roles->pluck('name','name')->all();

        return view("User::user.edit", compact('data','ModuleTitle','PageTitle','Organization','roles','userRole'));

    }

    public function update(Requests\UserUpdateRequest $request,$id){
        $input = $request->all();
        $validation = false;
        if (!$input['organization_id']){
            if (in_array("ADMINISTRATOR", $request->roles)) {
                $validation = true;
            }
            if (in_array("ADMIN_OPERATOR", $request->roles)) {
                $validation = true;
            }
            if (in_array("ADMIN_REPORTER", $request->roles)) {
                $validation = true;
            }
        }else{
            $validation = true;
        }

        if ($validation) {
            $UserUpdateModel = User::where('id', $id)->first();

            if (isset($input['password'])) {
                $Password = $input['password'];
                $input['password'] = password_hash($Password, PASSWORD_DEFAULT);
            } else {
                $input['password'] = $UserUpdateModel->password;
            }

            $UserExistsOrNot = User::where('email', $input['email'])->count();
            $SlugToId = User::where('email', $input['email'])->first();

            if ($UserExistsOrNot == 0 || ($UserExistsOrNot == 1 && $id == $SlugToId->id)) {
                DB::beginTransaction();
                try {
                    $result = $UserUpdateModel->update($input);
                    $UserUpdateModel->save();

                    DB::table('model_has_roles')->where('model_id', $id)->delete();
                    $UserUpdateModel->assignRole($request->input('roles'));

                    DB::commit();

                    Session::flash('message', 'Information Updated Successfully!');
                    return redirect()->route('admin.user.index');

                } catch (\Exception $e) {
                    DB::rollback();
                    print($e->getMessage());
                    exit();
                    Session::flash('danger', $e->getMessage());
                }

            } else {
                Session::flash('validate', 'Email already exists');
                return redirect()->back()->withInput($input);
            }
        }else{
                Session::flash('validate', 'Select Organization');
                return redirect()->back()->withInput($input);
            }
    }

    public function inactive($id){
        $data = User::where('id',$id)->first();

        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            $data->update([
                'status' => '0',
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
//                $TerminalData = UserTerminal::where('user_id',$id);
//                $TerminalData->delete();

                $UserInfo = User::where('id', $id)
                    ->select('*')
                    ->first();
                File::delete(public_path() . '/backend/image/UserImage/' . $UserInfo->user_image);
                $UserInfo->delete();
                Session::flash('delete', 'Delete Successfully !');
                DB::commit();
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
