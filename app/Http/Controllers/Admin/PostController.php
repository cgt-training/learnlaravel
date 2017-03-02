<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Post;
use App\Tag;
use Session;
use Image;
use Storage;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AllPosts = Post::orderBy('id', 'asc')->paginate(5);
        return view('admin/post.index', ['AllPosts' => $AllPosts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (Auth::guard('admin')->user()->can('create_post')) {
        $allCategories = DB::table('categories')->get();
        $allTags = DB::table('tags')->get();
        return view('admin/post.create', ['allCategories' => $allCategories, 'tags' => $allTags]);
       }
       else {
        Session::flash('error', 'You are not Authorised');
        $AllPosts = Post::orderBy('id', 'asc')->paginate(5);
        return view('admin/post.index', ['AllPosts' => $AllPosts]);
       } 
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
                'body'         => 'required',

                'featured_img' => 'sometimes|image'
            ));
        // store in the database
        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;
        
        if ($request->hasFile('featured_img')) {
          $image = $request->file('featured_img');
          $file_name = time() . '.' . $image->getClientOriginalExtension();
          $path = public_path('images/' . $file_name);
          Image::make($image)->resize(800, 400)->save($path);
          $post->image = $file_name;
        }

        $post->save();
        
        $post->tags()->sync($request->tags, false);
        
        Session::flash('success', 'The blog post was successfully save!');
        return redirect()->route('postadmin.index', $post->id);
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
        return view('admin/post.show')->with('data',$postfind);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (Auth::guard('admin')->user()->can('edit_post')) {

        $post = Post::find($id);
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
        return view('admin/post.edit')->withPost($post)->withAllcat($allcat)->withTags($alltag);
      }
      else {
        Session::flash('error', 'You are not Authorised');
        $AllPosts = Post::orderBy('id', 'asc')->paginate(5);
        return view('admin/post.index', ['AllPosts' => $AllPosts]);
      }
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
        
        if($request->input('slug') == $post->slug) {
            $this->validate($request, array(
                'title'         => 'required|max:255',
                'category_id'  => 'required',
                'featured_img' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
                'body'          => 'required'
            ));
        } else {
            $this->validate($request, array(
                    'title'         => 'required|max:255',
                    'slug'         => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                    'category_id'  => 'required',
                    'featured_img' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
                    'body'          => 'required'
            ));
        }    
       // $post = POST::find($id);
       $post->title = $request->title;
       $post->slug = $request->slug;
       $post->category_id = $request->category_id;
       $post->body =  $request->body;

       
       //save file
       if ($request->hasFile('featured_img')) {
          $image = $request->file('featured_img');
          $file_name = time() . '.' . $image->getClientOriginalExtension();
          $path = public_path('images/' . $file_name);
          Image::make($image)->resize(800, 400)->save($path);
          
          //delete old images and save new post image
          $oldimage = $post->image;
          Storage::delete($oldimage);

         $post->image = $file_name;
        }

       

       $post->save();

       // sync id's tags and posts
       if(isset($request->tags)){
            $post->tags()->sync($request->tags);
       } else {
            $post->tags()->sync(array());
       }

       Session::flash('success', 'The blog post was successfully update!');
       return redirect()->route('postadmin.index', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (Auth::guard('admin')->user()->can('delete_post')) {
          $post = Post::findOrFail($id);
          $oldimage = $post->image;
         Storage::delete($oldimage);
           DB::table('post_tag')->where('post_id', $id)->delete();
          $post->delete();
         return redirect()->route('postadmin.index');
       }
       else {
        Session::flash('error', 'You are not Authorised');
        $AllPosts = Post::orderBy('id', 'asc')->paginate(5);
        return view('admin/post.index', ['AllPosts' => $AllPosts]);
       }
     }
}
