<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
	public function getSingle($slug)
    {
	    $post=Post::where('slug','=',$slug)->first();
	    return view('blog.single')->withPost($post);
	}  

	public function index()
    {
	$AllPosts = DB::table('posts')->get();
    //echo '<pre>'; print_r($AllPosts); die;
    return view('pages.home')->with('AllPosts',$AllPosts);  
	}
}
