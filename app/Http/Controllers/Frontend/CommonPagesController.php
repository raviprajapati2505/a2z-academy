<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

class CommonPagesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     */
    public function __invoke(Request $request, $slug = '')
    {
        $title = $slug;
        if (empty($slug)) {
            $title = request()->segment(1);
        }
        $page_content = Page::where('slug', '=', $title)->first();
        if (!$page_content) {
            $page_content = Page::where('slug', '=', 'about-us')->first();
            return view('frontend.common_pages.page', compact('title', 'page_content'));
        }
        return view('frontend.common_pages.page', compact('title', 'page_content'));
    }
}
