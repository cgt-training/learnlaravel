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
	    $comments = DB::table('comments')->where('post_id', $post->id)->get();
	    return view('blog.single')->withPost($post)->withComment($comments);
	}  

	public function index()
    {
	$AllPosts = DB::table('posts')->get();
    //echo '<pre>'; print_r($AllPosts); die;
    return view('pages.home')->with('AllPosts',$AllPosts);  
	}

	public function edit($id, $slug)
    {
		$post=Post::where('slug','=',$slug)->first();
		$comments = DB::table('comments')->where('post_id', $post->id)->get();

		$getcomment = DB::table('comments')->where('id', $id)->get();
	    return view('blog.single')->withPost($post)->withComment($comments)->withGetcomment($getcomment);
	}

	public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
    	//
    }
}
