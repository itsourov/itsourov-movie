<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function faq()
    {
        return view('pages.faq');
    }
    public function contact()
    {
        return view('pages.contact');
    }
    public function pricing()
    {
        return view('subscription.pricing');
    }
}
