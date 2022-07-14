<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminSystemRequest;
use App\Http\Requests\UpdateAdminSystemRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdminSystemController extends Controller
{
    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index(Request $request) {
        $users = $this->user->latest()->paginate(config('constant.admin.paginate'));
        $page = $request->page ?? 1;
        return view('admin.users.index',compact('users','page'));
    }

    public function create() {
        $roles = $this->role->all();
        return view('admin.users.add', compact('roles'));
    }

    public function store(AdminSystemRequest $request){
        try{
            $postData = [
              'name' => $request->name ?? '',
              'email' => $request->email ?? '',
              'password' => Hash::make($request->password)
            ];
            $user = $this->user->create($postData);
            $roles = $request->role_id;
            $user->roles()->attach($roles);
            // foreach($roles as $role) {
            //     DB::table('role_user')->insert([
            //         'role_id' => $role,
            //         'user_id' => $user->id
            //     ]);
            // }
            Session::flash('message', 'Thêm thành công!!!');
            Session::flash('status', 'alert-success');
            return redirect()->route('users.index');
        }catch (\Exception $exception){
            Log::error($exception->getMessage() . '---------' . $exception->getLine());
            Session::flash('message', 'Thêm thất bại!!!');
            Session::flash('status', 'alert-danger');
            return redirect()->back();
        }
    }

    public function edit($id){
        $user = $this->user->find($id);
        $roles = $this->role->all();
        $roleOfUser = $user->roles;
        return view('admin.users.edit',compact('user', 'roleOfUser', 'roles'));
    }

    public function update($id,UpdateAdminSystemRequest $request){
        try{

            $postData = $request->all();
            $user = User::findOrFail($id);
            $user->name = $postData['name'];
            $user->email = $postData['email'];
            if( $postData['password'] != ''){
                $user->password = Hash::make($postData['password']) ;
            }
            $roles = $request->role_id;
            User::findOrFail($id)->roles()->sync($roles);
            $user->save();
            Session::flash('message', 'Cập nhật thành công!!!');
            Session::flash('status', 'alert-success');
            return redirect()->route('users.index');
        }catch (\Exception $exception){
            Log::error($exception->getMessage() . '---------' . $exception->getLine());
            Session::flash('message', 'Cập nhật thất bại!!!');
            Session::flash('status', 'alert-danger');
            return redirect()->route('users.index');
        }
    }

    public function delete($id){
        try{
            $this->user->find($id)->delete();
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
