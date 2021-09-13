<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\SliderAddRequest;
use App\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    // biến lưu trữ đối tượng: sd ở đoạn $this->slider
    private $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index() {
        // cấu hình constant cho paginate dễ dàng ở nh nơi
        $sliders = $this->slider->latest()->paginate(config('constant.admin.paginate'));
        return view('admin.sliders.index',compact('sliders'));
    }

    public function create() {
        return view('admin.sliders.add');
    }

    public function store(SliderAddRequest $request) {
        try{
            $PostData = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $dataImage = Helper::storeTraitUpload($request,'image_path','slider');

            // nếu có file update lên thì gán giá trị
            if(!empty($dataImage)){
                $PostData['image_name'] = $dataImage['file_name'];
                $PostData['image_path'] = $dataImage['file_path'];
            }
            $this->slider->create($PostData);
            Session::flash('message', 'Thêm thành công!!!');
            Session::flash('status', 'alert-success');
            return redirect()->route('sliders.index');
        }catch (\Exception $exception){
            Log::error('Lỗi: '. $exception->getMessage() . '------Line: ' . $exception->getLine());
            Session::flash('message', 'Thêm thất bại!!!');
            Session::flash('status', 'alert-danger');
            return redirect()->route('sliders.index');
        }
    }

    public function edit($id){
        $slider  = $this->slider->find($id);
        return view('admin.sliders.edit',compact('slider'));
    }

    public function update($id,Request $request){
        try{
            $UpdateData = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $dataImage = Helper::storeTraitUpload($request,'image_path','slider');

            // nếu có upload ảnh mới thì xóa ảnh cũ trong storage đi và cập nhật ảnh mới ở dưới
            if(!empty($request->image_path)){
                $fileImage = public_path($this->slider->find($id)->image_path);
                File::delete($fileImage);
            }

            // nếu có file update lên thì gán giá trị
            if(!empty($dataImage)){
                $UpdateData['image_name'] = $dataImage['file_name'];
                $UpdateData['image_path'] = $dataImage['file_path'];
            }
            $this->slider->find($id)->update($UpdateData);
            Session::flash('message', 'Thêm thành công!!!');
            Session::flash('status', 'alert-success');
            return redirect()->route('sliders.index');
        }catch (\Exception $exception){
            Log::error('Lỗi: '. $exception->getMessage() . '------Line: ' . $exception->getLine());
            Session::flash('message', 'Thêm thất bại!!!');
            Session::flash('status', 'alert-danger');
            return redirect()->route('sliders.index');
        }
    }

    public function delete($id) {
        try{
            $this->slider->find($id)->delete();
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
