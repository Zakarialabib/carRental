<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::whereSlug($slug)->get();

        return view('front.showPage', compact('page'));
    }
}
