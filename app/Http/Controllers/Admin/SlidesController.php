<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlidesRequest;
use App\Models\Slides;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SlidesController extends Controller
{
    public function listSlides() {
        $title = 'Danh sách slides';
        $slides = Slides::paginate(5)
        ->withQueryString();
        return view('backend.slides.list', compact('title', 'slides'));
    }

    public function addSlides() {
        $title = 'Thêm Slide';
        return view('backend.slides.add', compact('title'));
    }

    public function postSlides(SlidesRequest $request) {
        $params = $request->except('_token');
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $params['image'] = uploadFile('images/slides', $request->file('image'));
        }
        $slides = Slides::create($params);
        if ($slides->id) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Thêm hình ảnh thành công'
            ];

            return redirect()->route('slide.list')->with($notification);
        }
    }

    public function editSlides(Request $request, $id) {
        $title = 'Chỉnh sửa slide';
        $slide = Slides::find($id);

        $request->session()->put('id', $slide->id);
        return view('backend.slides.edit', compact('title', 'slide'));
    }

    public function updateSlides(SlidesRequest $request) {
        $id = session('id');
        $slide = Slides::find($id);
        $params = $request->except('_token');
        // dd($params);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $resultDL = Storage::delete('/public/slides' . $slide->image);
            if ($resultDL) {
                $params['image'] = uploadFile('images/slides', $request->file('image'));
            } else {
                $params['image'] = $slide->image;
            }
        }

        // dd($params);
        $result = Slides::where('id', $id)
        ->update($params);

        if ($result) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Sửa slide thành công'
            ];
            return redirect()->route('slide.list')->with($notification);
        }
    }

    public function deleteSlides($id) {
        $result = Slides::where('id', $id)->delete();
        if ($result) {
            $notification = [
                'alert-type' => 'success',
                'message' => 'Xóa slide thành công'
            ];
            return redirect()->route('slide.list')->with($notification);
        }
    }
}
