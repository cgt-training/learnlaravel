<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use Illuminate\Support\Facades\DB;
use App\Post;
use App\Tag;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$AllPosts = DB::table('posts')->get();
        $AllPosts = Post::orderBy('id', 'asc')->paginate(5);
        return view('post.index', ['AllPosts' => $AllPosts]);
        // each(array)cho '<pre>'; print_r($AllPosts); die;
        //return view('post.index')->with('AllPosts',$AllPosts);
    }

    // public function pagination(Request $request){
    //     $total_records = $request->totalrecords;
    //     $AllPosts = Post::orderBy('id', 'asc')->paginate($total_records);
    //     return view('post.index', ['AllPosts' => $AllPosts]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategories = DB::table('categories')->get();
        $allTags = DB::table('tags')->get();
        //echo '<pre>'; print_r($allCategories); die;
        return view('post.create', ['allCategories' => $allCategories, 'tags' => $allTags]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, array(
                'title'        => 'required|max:255',
                'slug'         => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id'  => 'required',
                'tags'         => 'required',
                'body'         => 'required'
            ));
        // store in the database
        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        // $post->category_id = $request->category_id;
        $post->body = $request->body;
        // if ($request->hasFile('featured_img')) {
        //   $image = $request->file('featured_img');
        //   $filename = time() . '.' . $image->getClientOriginalExtension();
        //   $location = public_path('images/' . $filename);
        //   Image::make($image)->resize(800, 400)->save($location);
        //   $post->image = $filename;
        // }
        $post->save();
        
        $post->tags()->sync($request->tags, false);
        
        Session::flash('success', 'The blog post was successfully save!');
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postfind = DB::table('posts')->where('id', $id)->get();
        //echo '<pre>'; print_r($postfind[0]->title); die;
        return view('post.show')->with('data',$postfind);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        // return the view and pass in the var we previously created
        $allcat = [];
        $allCategories = DB::table('categories')->get();
            foreach($allCategories as $allCategoriess) {
               $allcat[$allCategoriess->id] = $allCategoriess->cat_name;
            }

        $alltag = [];
        $allTags = DB::table('tags')->get();
            foreach($allTags as $allTagss) {
               $alltag[$allTagss->id] = $allTagss->name;
            }    

        // $tagsss = $post::find($id)->post_tag;
        // echo '<pre>'; print_r($alltag); die;

            //echo '<pre>'; print_r($allcat); die;
        return view('post.edit')->withPost($post)->withAllcat($allcat)->withTags($alltag);
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
        $post = POST::find($id);
        // echo '<pre>'; print_r($post->slug); die;
        if($request->input('slug') == $post->slug) {
            $this->validate($request, array(
                'title'         => 'required|max:255',
                'category_id'  => 'required',
                'body'          => 'required'
            ));
        } else {
            $this->validate($request, array(
                    'title'         => 'required|max:255',
                    'slug'         => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                    'category_id'  => 'required',
                    'body'          => 'required'
            ));
        }    
       // $post = POST::find($id);
       $post->title = $request->title;
       $post->slug = $request->slug;
       $post->category_id = $request->category_id;
       $post->body =  $request->body;
       $post->save();

       if(isset($request->tags)){
            $post->tags()->sync($request->tags);
       } else {
            $post->tags()->sync(array());
       }

       Session::flash('success', 'The blog post was successfully update!');
       return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
