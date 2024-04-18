<?php

namespace App\Modules\Role\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Configuration\ConfigurationHelper;
use App\Modules\Organization\Models\Organization;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use DB;
use Image;
use File;
use Storage;
use App;
Use Auth;

class RoleController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {
        ConfigurationHelper::Language();
        $ModuleTitle = 'Role Management';
        $PageTitle = 'Roles list';
        $TableTitle = 'Roles list';

        $roles = Role::orderBy('id','DESC')->paginate(10);

        return view("Role::role.index", compact('ModuleTitle','PageTitle','TableTitle','roles'));

    }

    public function create(){
        $ModuleTitle = 'Role Management';
        $PageTitle = 'Roles list';
        $TableTitle = 'Roles list';

        $permission = Permission::get();

        return view("Role::role.create", compact('ModuleTitle','PageTitle','TableTitle','permission'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        Session::flash('message','Role created successfully');
        return redirect()->route('admin.role.index');
    }

    public function edit($id){
        $role = Role::find($id);
        $permission = Permission::get();

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $ModuleTitle = 'Role Management';
        $PageTitle = 'Role Update';

        return view("Role::role.edit", compact('role','ModuleTitle','PageTitle','permission','rolePermissions'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        Session::flash('message','Role updated successfully');
        return redirect()->route('admin.role.index');
    }

    public function roleDelete($id){
        DB::table('roles')->where('id', $id)->delete();

        Session::flash('message','Role deleted successfully');
        return redirect()->route('admin.role.index');
    }

}
