<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index()  {
        $categories = $this->category->latest()->paginate(5);

        return view('admin.category.index',compact('categories'));
    }

    private $category;

    public function __construct(Category $category)
    {
        $this->category =$category;
    }

    public function create() {
//        sử dụng để tạo ra MENU ĐA CẤP thủ công
//        foreach($data as $value){
//            if($value['parent_id'] == 0) {
//                echo "<option>" . $value['name']."</option>";
//
//                foreach($data as $value2){
//                    if($value2['parent_id'] == $value['id']){
//                        echo "<option>" . $value2['name']."</option>";
//
//                        foreach($data as $value3){
//                            if($value3['parent_id'] == $value2['id']){
//                                echo "<option>" . $value3['name']."</option>";
//                            }
//                        }
//                    }
//                }
//            }
//        }
        $htmlOption = $this->getCategory($parentId = 0);

        return view('admin.category.add',compact('htmlOption'));
    }

    // Hàm đệ quy MENU đa cấp, thay vào đó sử dụng trong componens
//    public function categoryRecusive($id,$text= ''){
//        $data = Category::all();
//        foreach($data as $value){
//            if($value['parent_id'] == $id){
//                $this->htmlSelect .=  "<option>" . $text . $value['name'] . "</option>";
//                $this->categoryRecusive($value['id'],$text . '-');
//            }
//        }
//        return $this->htmlSelect;
//    }

    public function store(Request $request){
        $this->category->create([
            'name' => $request->name,
            'parent_id' =>$request->parent_id,
            'slug' =>Str::slug($request->name)
        ]);
        return redirect(route('categories.index'))->with('status','Thêm thành công');
    }

    public function getCategory($parentId) {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);

        return $htmlOption;
    }

    public function edit($id){
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.category.edit',compact('category','htmlOption'));
    }

    public function update( $id, Request $request) {
        $category = $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' =>$request->parent_id,
            'slug' =>Str::slug($request->name)
        ]);
        return redirect(route('categories.index'))->with('status','Sửa thành công');
    }

    public function delete($id){
        $this->category->find($id)->delete();
        return redirect(route('categories.index'))->with('status','Xóa thành công');
    }
}
