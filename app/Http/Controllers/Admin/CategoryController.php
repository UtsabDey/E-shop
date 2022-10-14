<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'required',
            'status' => 'nullable',
            'popular' => 'nullable',
            'meta_title' => 'required|string',
            'meta_keywords' => 'required|string',
            'meta_description' => 'required|string',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->description = $request->description;
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('images/uploads/category', $photo_name);
            $category->image = $photo_name;
        }
        $category->status = $request->status == true ? '1' : '0';
        $category->popular = $request->popular == true ? '1' : '0';
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();

        return redirect()->route('category.index')->with('status', 'Category added successfully');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
