<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Slider;
use App\Traits\StorageTraitImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    use StorageTraitImage;
    // biến lưu trữ đối tượng: sd ở đoạn $this->slider
    private $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index() {
        // cấu hình constant cho paginate dễ dàng ở nh nơi
        $sliders = $this->slider->paginate(config('constant.admin.paginate'));
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
            $dataImage = $this->storeTraitUpload($request,'image_path','slider');

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
}
