<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use App\Http\Requests\BrandsRequest;

class BrandsController extends Controller
{
    public function listBrands() {
        $title = 'Danh sách thương hiệu';
        $brands = Brands::paginate(5)
        ->withQueryString();

        return view('backend.brands.list', compact('title', 'brands'));
    }

    public function addBrands() {
        $title = 'Thêm sản phẩm';
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

    public function editBrands($id) {
        $title = 'Sửa thương hiệu';
        $brand = Brands::find($id);
        return view('backend.brands.edit', compact('title', 'brand'));
    }
}
