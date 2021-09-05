<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menuRecusive;
    public function __construct(MenuRecusive $menuRecusive)
    {
        $this->menuRecusive = $menuRecusive;
    }

    public function index() {
//        $menus = Menu::orderBy('name','asc')->paginate(10);
        $menus = Menu::paginate(config('constant.admin.paginate'));
        return view('admin.menus.index',compact('menus'));
    }

    public function create(){
        $optionSelect = $this->menuRecusive->menuRecusive();
        return view('admin.menus.add',compact('optionSelect'));
    }

    public  function store(Request $request) {
        Menu::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('menus.index')->with('status','Thêm thành công!');;
    }

    public function edit($id) {
        $menus = Menu::find($id);
        $optionSelect = $this->menuRecusive->menuRecusive($menus->parent_id);
        return view('admin.menus.edit',compact('optionSelect','menus'));
    }

    public  function update(Request $request,$id) {
//        dd($request->all());
        Menu::find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('menus.index')->with('status','Sửa thành công!');
    }

    public function delete($id) {
        Menu::find($id)->delete();
        return redirect()->route('menus.index')->with('status','Xóa thành công!');
    }
}
