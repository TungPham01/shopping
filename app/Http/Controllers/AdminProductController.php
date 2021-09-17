<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\Helper;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use Illuminate\Http\Request;
use App\Components\Recusive;
use DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProductAddRequest;
use Illuminate\Support\Facades\File;

class AdminProductController extends Controller
{
    private  $category;
    private  $product;
    private  $productImage;
    private  $tag;
    private  $productTag;

    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category= $category;
        $this->product= $product;
        $this->productImage= $productImage;
        $this->tag= $tag;
        $this->productTag= $productTag;
    }

    public  function index(Request $request) {
//        latest: lấy cái mới nhất
        $products = $this->product->latest()->paginate(config('constant.admin.paginate'));
        $page = $request->page ?? 1;
        return view('admin.product.index',compact('products','page'));
    }

    public  function  create() {
        $htmlOption = $this->getCategory($parentId = 0);
        return view('admin.product.add',compact('htmlOption'));
    }

    public function getCategory($parentId) {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);

        return $htmlOption;
    }

    public function store(ProductAddRequest $request) {
        DB::beginTransaction();
        try{
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
                'views_count' => 1
            ];
            logger('Đã xong thêm product.' );
            $dataUploadFeatureImage = Helper::storeHelperUpload($request,'feature_image_path', 'product');

            // nếu có upload ảnh mới thì xóa ảnh cũ trong storage đi và cập nhật ảnh mới ở dưới
            if(!empty($dataUploadFeatureImage)){
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);

            // thêm dữ liệu vào bảng product_image(bảng có nhiều ảnh, ảnh chi tiết)
            if($request->hasFile('image_path')){
                foreach($request->image_path as $fileItem){
                    $dataProductImageDetail = Helper::storeHelperUploadMultiple($fileItem,'product');
                    // C2:
                    $product->productImage()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
//                  C1:  $this->productImage->create([
//                        'product_id' => $product->id,
//                        'image_path' => $dataProductImageDetail['file_path'],
//                        'image_name' => $dataProductImageDetail['file_name'],
//                    ]);
                }
            }

            // thêm dữ liệu vào bảng tags
            if(!empty($request->tags)){
                foreach($request->tags as $tagItem){
                    // thêm vào bảng tags
                    // firstOrCreate: trả về bản ghi phu hợp, nếu k có thì sẽ thêm mới (trống trùng nhau)
                    $tag = $this->tag->firstOrCreate([
                        'name' => $tagItem
                    ]);
                    // thêm vào bảng productTag
//               C1:  $this->productTag->create([
//                    'product_id' => $product->id,
//                    'tag_id' => $tag->id
//                ]);
                    $tagIds[] = $tag->id;
                }
            }

           //C2:
            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message: '. $exception->getMessage() . '-------- Line: ' . $exception->getLine());
            echo $exception->getMessage() .'-------- Line: ' . $exception->getLine() ;
        }

    }

    public function edit($id) {
        $product = $this->product->findOrFail($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit',compact('htmlOption','product'));
    }

    public function update(Request $request, $id){
        DB::beginTransaction();
        try{
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            logger('Đã xong thêm product.' );
            if(!empty($request->feature_image_path)){
                $fileImage = public_path($this->product->find($id)->feature_image_path);
                File::delete($fileImage);
            }
            $dataUploadFeatureImage = Helper::storeHelperUpload($request,'feature_image_path', 'product');
            if(!empty($dataUploadFeatureImage)){
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->find($id)->update($dataProductUpdate);
            // chỉ trả về true false update k trả về đối tượng nên cần gọi lại đối tượng đó
            $product = $this->product->find($id);

            // thêm dữ liệu vào bảng product_image(bảng có nhiều ảnh, ảnh chi tiết)
            if($request->hasFile('image_path')){
                $this->productImage->where('product_id',$id)->delete();
                dd($this->productImage);
                if ($this->productImage->file_path) {
                    Storage::delete($product->product_image);
                }
                foreach($request->image_path as $fileItem){
                    $dataProductImageDetail = Helper::storeHelperUploadMultiple($fileItem,'product');
                    // C2:
                    $product->productImage()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
//                  C1:  $this->productImage->create([
//                        'product_id' => $product->id,
//                        'image_path' => $dataProductImageDetail['file_path'],
//                        'image_name' => $dataProductImageDetail['file_name'],
//                    ]);
                }
            }

            // thêm dữ liệu vào bảng tags
            if(!empty($request->tags)){
                $this->productTag->where('product_id',$id)->delete();
                foreach($request->tags as $tagItem){
                    // thêm vào bảng tags
                    // firstOrCreate: trả về bản ghi phu hợp, nếu k có thì sẽ thêm mới (trống trùng nhau)
                    $tag = $this->tag->firstOrCreate([
                        'name' => $tagItem
                    ]);
                    // thêm vào bảng productTag
//               C1:  $this->productTag->create([
//                    'product_id' => $product->id,
//                    'tag_id' => $tag->id
//                ]);
                    $tagIds[] = $tag->id;
                }
            }

            //C2: sync: trong quan hệ (n-n) chỉ lấy các giá trị tag có trong $tagIds, cái nào k có sẽ xóa đi
            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message: '. $exception->getMessage() . '-------- Line: ' . $exception->getLine());
            echo $exception->getMessage() .'-------- Line: ' . $exception->getLine() ;
        }

    }

    public function delete($id){
        try{
            $this->product->find($id)->delete();
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
