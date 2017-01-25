<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function index()
    {
    	$person_name = 'Manvendra Rajpurohit';
        return view('pages.home')->with('name',$person_name);
    }

    public function about()
    {
    	$person_name = 'Pawan Kumar';
        return view('pages.about')->with('name',$person_name);
    }

    public function contact()
    {
    	$person_name = 'Pankaj Singh';
        return view('pages.contact')->withName($person_name);
    }
}
