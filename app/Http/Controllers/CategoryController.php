<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use App\Category;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AllCat = DB::table('categories')->get();
        // echo '<pre>'; print_r($AllCat); die;
        return view('category.category')->withAllcat($AllCat);
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
        $this->validate($request, array(
                'cat_name'         => 'required|max:255',
            ));
        // store in the database
        $category = new Category;
        $category->cat_name = $request->cat_name;
        $category->save();
        Session::flash('success', 'The cetegory was successfully save!');
        return redirect()->route('catogories.index');
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
        $AllCat = DB::table('categories')->get();
        // echo '<pre>'; print_r($AllCat); die;
        // return view('category.category')->with('AllCat',$AllCat);
        
        $category = Category::find($id);
        // return the view and pass in the var we previously created
        return view('category.category')->withCategory($category)->withAllcat($AllCat);
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
        $category = Category::find($id);
            $this->validate($request, array(
                    'cat_name'         => 'required|max:255',
            ));
          
       // $post = POST::find($id);
       $category->cat_name = $request->cat_name;
       $category->save();
       Session::flash('success', 'The Category was successfully update!');
       return redirect()->route('catogories.index', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('catogories.index');
    }
}
