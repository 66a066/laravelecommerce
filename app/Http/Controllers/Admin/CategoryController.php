<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::all();
        return view('admin.category.index',compact('categories'));
    }

    public function add()
    {
        return view('admin.category.create');
    }

    public function insert(Request $request)
    {
        // return $request->all();
        $category=new Category();
        if($request->hasfile('category_image'))
        {
            $file=$request->file('category_image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('assets/category',$filename);
            $category->category_image=$filename;
        }

        $category->name=$request->name;
        $category->slug=$request->slug;
        $category->description=$request->description;
        $category->status=$request->input('status') == TRUE ? '1':'0';
        $category->popular=$request->input('popular') == TRUE ? '1':'0';
        $category->meta_title=$request->meta_title;
        $category->meta_descrip=$request->meta_descrip;
        $category->meta_keywords=$request->meta_keywords;
        $category->save();
        return redirect('/categories')->with('status','Category Added Successfully');
    }

    public function edit($id)
    {
        $categories=Category::find($id);
        return view('admin.category.edit',compact('categories'));
    }

    public function update(Request $request,$id)
    {
        $categories=Category::find($id);
        if($request->hasfile('category_image'))
        {
            $path='assets/category'.$categories->category_image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file=$request->file('category_image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('assets/category',$filename);
            $categories->category_image=$filename;
        }
            $categories->name=$request->name;
            $categories->slug=$request->slug;
            $categories->description=$request->description;
            $categories->status=$request->input('status') == TRUE ? '1':'0';
            $categories->popular=$request->input('popular') == TRUE ? '1':'0';
            $categories->meta_title=$request->meta_title;
            $categories->meta_descrip=$request->meta_descrip;
            $categories->meta_keywords=$request->meta_keywords;
            $categories->update();
            return redirect('/categories')->with('status','Category Updated Successfully');
    }

    public function destroy($id)
    {
        $categories=Category::find($id);
        if($categories->category_image)
        {
            $path='assets/category'.$categories->category_image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $categories->delete();
            return redirect('/categories')->with('status','Category Deleted Successfully');
        }
    }
}
