<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products=Product::with('category')->get();
        return view('admin.product.index',compact('products'));
    }

    public function add()
    {
        $categories=Category::all();
        return view('admin.product.create',compact('categories'));
    }

    public function insert(Request $request)
    {
        return $request->all();
        $products=new Product();
        if($request->hasfile('product_image'))
        {
            $file=$request->file('product_image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('assets/product',$filename);
            $products->product_image=$filename;
        }

        $products->category_id=$request->category_id;
        $products->name=$request->name;
        $products->slug=$request->slug;
        $products->small_description=$request->small_description;
        $products->description=$request->description;
        $products->original_price=$request->original_price;
        $products->selling_price=$request->selling_price;
        $products->qty=$request->qty;
        $products->tax=$request->tax;
        $products->status=$request->input('status') == TRUE ? '1':'0';
        $products->trending=$request->input('trending') == TRUE ? '1':'0';
        $products->meta_title=$request->meta_title;
        $products->meta_descrip=$request->meta_descrip;
        $products->meta_keywords=$request->meta_keywords;
        $products->save();
        return redirect('/products')->with('status','Product Created Successfully');
    }

    public function edit($id)
    {
        $products=Product::with('category')->find($id);
        return view('admin.product.edit',compact('products'));
    }

    public function update(Request $request,$id)
    {
        $products=Product::with('category')->find($id);
        if($request->hasfile('product_image'))
        {
            $path='assets/product'.$products->product_image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file=$request->file('product_image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('assets/product',$filename);
            $products->product_image=$filename;
        }

        $products->category_id=$request->category_id;
        $products->name=$request->name;
        $products->slug=$request->slug;
        $products->small_description=$request->small_description;
        $products->description=$request->description;
        $products->original_price=$request->original_price;
        $products->selling_price=$request->selling_price;
        $products->qty=$request->qty;
        $products->tax=$request->tax;
        $products->status=$request->input('status') == TRUE ? '1':'0';
        $products->trending=$request->input('trending') == TRUE ? '1':'0';
        $products->meta_title=$request->meta_title;
        $products->meta_descrip=$request->meta_descrip;
        $products->meta_keywords=$request->meta_keywords;
        $products->update();
        return redirect('/products')->with('status','Product Updated Successfully');
    }

    public function destroy($id)
    {
        $products=Product::find($id);
        if($products->product_image)
        {
            $path='assets/product'.$products->product_image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $products->delete();
            return redirect('/products')->with('status','Product Deleted Successfully');
        }
    }
}
