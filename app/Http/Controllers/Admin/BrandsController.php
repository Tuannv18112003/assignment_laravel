<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use App\Http\Requests\BrandsRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class BrandsController extends Controller
{
    public function listBrands() {
        $title = 'Danh sách thương hiệu';
        $brands = Brands::paginate(5)
        ->withQueryString();

        return view('backend.brands.list', compact('title', 'brands'));
    }

    public function addBrands() {
        $title = 'Thêm thương hiệu';
        return view('backend.brands.add', compact('title'));
    }

    public function postBrands(BrandsRequest $request) {
        $params = $request->except('_token');
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $params['image'] = uploadFile('images/brands', $request->file('image'));
        }
        $brands = Brands::create($params);
        if ($brands->id) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Thêm danh mục thành công'
            ];

            return redirect()->route('brand.list')->with($notification);
        }
    }

    public function editBrands(BrandsRequest $request , $id) {
        $title = 'Sửa thương hiệu';
        $brand = Brands::find($id);
        $request->session()->put('id', $brand->id);
        return view('backend.brands.edit', compact('title', 'brand'));
    }

    public function updateBrands(BrandsRequest $request) {
        $id = session('id');
        $brand = Brands::find($id);
        $params = $request->except('_token');
        // dd($params);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $resultDL = Storage::delete('/public/brands' . $brand->image);
            if ($resultDL) {
                $params['image'] = uploadFile('images', $request->file('image'));
            } else {
                $params['image'] = $brand->image;
            }
        }

        $result = Brands::where('id', $id)
        ->update($params);

        if ($result) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Sửa thương hiệu thành công'
            ];
            return redirect()->route('brand.list')->with($notification);
        }
    }

    public function deleteBrands($id)
    {
        $result = Brands::where('id', $id)->delete();
        if ($result) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Xóa danh mục thành công'
            ];
            return redirect()->route('brand.list')->with($notification);
        }
    }
}
