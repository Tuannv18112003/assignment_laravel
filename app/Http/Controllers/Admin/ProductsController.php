<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Models\Brands;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;
// use Image;

class ProductsController extends Controller
{
    public function addProducts() {
        $title = 'Thêm sản phẩm';
        $brands = Brands::all();

        return view('backend.products.add', compact('title', 'brands'));
    }

    public function postProducts(ProductsRequest $request) {
        // dd($request->except('_token'));
        $params = $request->except('_token');
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $params['image'] = uploadFile('images/products', $request->file('image'));
        }

        // dd($params)
        
        $products = Products::create($params);
        if ($products->id) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Thêm sản phẩm thành công'
            ];
            
            return redirect()->route('product.list')->with($notification);
        }
    }

    public function listProducts() {
        $title = 'Danh sách sản phẩm';
        $products = Products::paginate(10)
        ->withQueryString();

        foreach ($products as $product) {
            if($product->image) {
                $imagePath = public_path('storage/' . $product->image);
                $resizedImage = Image::make($imagePath)->resize(300, 200);
                $resizedImage->save($imagePath);

                $product->save();
            }
        }

        return view('backend.products.list', compact('title', 'products'));
    }

    public function getEditProducts(ProductsRequest $request, $id) {
        $title = 'Chỉnh sửa sản phẩm';
        $product = Products::find($id);
        $brands = Brands::all();
        return view('backend.products.edit', compact('title', 'product', 'brands'));
    }

    public function editProducts(ProductsRequest $request) {
       $id = $request->id;
        $product = Products::find($id);
        $params = $request->except('_token');
        // dd($params);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $resultDL = Storage::delete('/public/products' . $product->image);
            if ($resultDL) {
                $params['image'] = uploadFile('images/products', $request->file('image'));
            } else {
                $params['image'] = $product->image;
            }
        }

        // DB::enableQueryLog();
        $result = Products::where('id', $id)
        ->update($params);
        // dd(DB::getQueryLog())

        if($result) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Sửa sản phẩm thành công'
            ];
            return redirect()->route('product.list')->with($notification);
        }
    }

    public function deleteProducts($id) {
        $result = Products::where('id', $id)->delete();
        if($result) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Xóa sản phẩm thành công'
            ];
            return redirect()->route('product.list')->with($notification);
        }
    }
}
