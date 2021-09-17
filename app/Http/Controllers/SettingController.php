<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\AddSettingRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index(Request $request) {
        $setting = $this->setting->latest()->paginate(config('constant.admin.paginate'));
        $page = $request->page ?? 1;
        return view('admin.setting.index',compact('setting','page'));
    }

    public function create() {
        return view('admin.setting.add');
    }

    public function store(AddSettingRequest $request){
        try{
            $this->setting->create($request->all());
            Session::flash('message', 'Thêm thành công!!!');
            Session::flash('status', 'alert-success');
            return redirect()->route('setting.index');
        }catch (\Exception $exception){
            Log::error($exception->getMessage() . '---------' . $exception->getLine());
            Session::flash('message', 'Thêm thất bại!!!');
            Session::flash('status', 'alert-danger');
            return redirect()->route('setting.index');
        }
    }

    public function edit($id){
        $setting = $this->setting->find($id);
        return view('admin.setting.edit',compact('setting'));
    }

    public function update($id,UpdateSettingRequest $request){
        try{
            $setting = Setting::find($id)->update($request->all());
            Session::flash('message', 'Cập nhật thành công!!!');
            Session::flash('status', 'alert-success');
            return redirect()->route('setting.index');
        }catch (\Exception $exception){
            Log::error($exception->getMessage() . '---------' . $exception->getLine());
            Session::flash('message', 'Cập nhật thất bại!!!');
            Session::flash('status', 'alert-danger');
            return redirect()->route('setting.index');
        }
    }

    public function delete($id){
        try{
            $this->setting->find($id)->delete();
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
