<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdminRoleController extends Controller
{
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index(Request $request) {
        $roles = $this->role->latest()->paginate(config('constant.admin.paginate'));
        $page = $request->page ?? 1;
        return view('admin.roles.index',compact('roles','page'));
    }

    public function create() {
        $permissionParent = $this->permission->where('parent_id', 0)->get();
        return view('admin.roles.add', compact('permissionParent'));
    }

    public function store(Request $request){
        try{
            $postData = [
              'name' => $request->name ?? '',
              'display_name' => $request->display_name ?? '',
            ];
            $role = $this->role->create($postData);
            $role->permissions()->attach($request->permission_id);
            Session::flash('message', 'Thêm thành công!!!');
            Session::flash('status', 'alert-success');
            return redirect()->route('roles.index');
        }catch (\Exception $exception){
            Log::error($exception->getMessage() . '---------' . $exception->getLine());
            Session::flash('message', 'Thêm thất bại!!!');
            Session::flash('status', 'alert-danger');
            return redirect()->route('roles.index');
        }
    }

    public function edit($id){
        $role = $this->role->find($id);
        $permissionParent = $this->permission->where('parent_id', 0)->get();
        $permissionsChecked = $role->permissions;
        return view('admin.roles.edit',compact('role', 'permissionParent', 'permissionsChecked'));
    }

    public function update($id,Request $request){
        try{
            $postData = $request->all();
            $role = $this->role->findOrFail($id);
            $role->name = $postData['name'];
            $role->display_name = $postData['display_name'];
            $role->save();

            $this->role->find($id)->permissions()->sync($request->permission_id);
            Session::flash('message', 'Cập nhật thành công!!!');
            Session::flash('status', 'alert-success');
            return redirect()->route('roles.index');
        }catch (\Exception $exception){
            Log::error($exception->getMessage() . '---------' . $exception->getLine());
            Session::flash('message', 'Cập nhật thất bại!!!');
            Session::flash('status', 'alert-danger');
            return redirect()->route('roles.index');
        }
    }

    public function delete($id){
        try{
            $this->role->find($id)->permissions()->detach();
            $this->role->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ],200);
        }catch (\Exception $exception){
            Log::error('Message: '. $exception->getMessage() . '-------- Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ],500);
        }
    }
}
