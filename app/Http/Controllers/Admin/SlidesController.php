<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slides;
use Illuminate\Http\Request;

class SlidesController extends Controller
{
    public function listSlides() {
        $title = 'Danh sách thương hiệu';
        $slides = Slides::paginate(5)
        ->withQueryString();
        return view('backend.slides.list', compact('title', 'slides'));
    }

    public function addSlides() {}

    public function postSlides() {}
}
