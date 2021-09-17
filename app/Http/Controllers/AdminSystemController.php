<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminSystemRequest;
use App\Http\Requests\UpdateAdminSystemRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdminSystemController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request) {
        $users = $this->user->latest()->paginate(config('constant.admin.paginate'));
        $page = $request->page ?? 1;
        return view('admin.users.index',compact('users','page'));
    }

    public function create() {
        return view('admin.users.add');
    }

    public function store(AdminSystemRequest $request){
        try{
            $postData = [
              'name' => $request->name ?? '',
              'email' => $request->email ?? '',
              'password' => Hash::make($request->password)
            ];
            $this->user->create($postData);
            Session::flash('message', 'Thêm thành công!!!');
            Session::flash('status', 'alert-success');
            return redirect()->route('users.index');
        }catch (\Exception $exception){
            Log::error($exception->getMessage() . '---------' . $exception->getLine());
            Session::flash('message', 'Thêm thất bại!!!');
            Session::flash('status', 'alert-danger');
            return redirect()->route('users.index');
        }
    }

    public function edit($id){
        $user = $this->user->find($id);
        return view('admin.users.edit',compact('user'));
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
