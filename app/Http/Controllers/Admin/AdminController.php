<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
	public function _construct()
	{
		$this->middleware('admin');
	}

	public function dashboard()
	{
		return view('admin.layout');
	}
}

