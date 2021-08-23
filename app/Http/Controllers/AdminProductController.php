<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use App\Traits\StorageTraitImage;
use Illuminate\Http\Request;
use App\Components\Recusive;
use DB;
use Illuminate\Support\Facades\Log;

class AdminProductController extends Controller
{
    use StorageTraitImage;

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

    public  function index() {
        return view('admin.product.index');
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

    public function store(Request $request) {
//        dd($request->tags);
        DB::beginTransaction();
        try{
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            logger('Đã xong thêm product.' );
            $dataUploadFeatureImage = $this->storeTraitUpload($request,'feature_image_path', 'product');
            if(!empty($dataUploadFeatureImage)){
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);

            // thêm dữ liệu vào bảng product_image(bảng có nhiều ảnh, ảnh chi tiết)
            if($request->hasFile('image_path')){
                foreach($request->image_path as $fileItem){
                    $dataProductImageDetail = $this->storeTraitUploadMultiple($fileItem,'product');
                    // C2:
                    $product->productImage()->create([
                        'image_paath' => $dataProductImageDetail['file_path'],
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
           //C2:
            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message: '. $exception->getMessage() . 'Line: ' . $exception->getLine());
            echo $exception->getMessage() . $exception->getLine() ;
        }

    }
}
