<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Page; // Import model Page
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    /**
     * Display a listing of the pages.
     * Người dùng chưa đăng nhập cũng có thể xem trang danh sách.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pages = Page::orderBy('created_at', 'desc')->paginate(3);

        return view('frontend.pages.index', compact('pages'));
    }

    /**
     * Display the specified page.
     * Người dùng chưa đăng nhập cũng có thể xem trang chi tiết.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);

        return view('frontend.pages.show', compact('page'));
    }
}
