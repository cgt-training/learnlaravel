<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Comment;
use App\Post;
use Session;

class CommentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //print_r($request->all());die;
        $this->validate($request, array(
            'name'        => 'required|max:30',
            'email'       => 'required',
            'comment'     => 'required'
        ));
        // $post = Post::find($post_id);
        $comment = new Comment;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->approved = true;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        // $comment->post()->associate($post);

        $comment->save();
        Session::flash('success', 'The blog Comment was successfully save!');
        return redirect()->route('blog.single', [$request->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
                'name'         => 'required|max:255',
                'email'  => 'required',
                'comment'          => 'required'
            ));
       $comment = Comment::find($id);
       $comment->name = $request->name;
       $comment->email = $request->email;
       $comment->post_id = $request->post_id;
       $comment->comment = $request->comment;
       $comment->save();
       Session::flash('success', 'The blog Comment was successfully update!');
       return redirect()->route('blog.single', [$request->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {//echo '<pre>'; print_r($id); die;
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('blog.single', [$request->slug]);
    }
}
