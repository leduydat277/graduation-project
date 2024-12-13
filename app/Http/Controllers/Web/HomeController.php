<?php

namespace App\Http\Controllers\Web;

class HomeController
{
    public function index(){
        $title = "Trang chủ";
        return view('client.index', compact('title'));
    }
    public function rooms(){
        $title = "Phòng";
        return view('client.room', compact('title'));
    }
    public function contact(){
        $title = "Liên hệ";
        return view('client.contact', compact('title'));
    }
    public function about(){
        $title = "Về chúng tôi";
        return view('client.about', compact('title'));
    }
    public function booking(){
        $title = "Đặt phòng";
        return view('client.booking', compact('title'));
    }
    public function review(){
        $title = "Đánh giá & bình luận";
        return view('client.review', compact('title'));
    }

}
