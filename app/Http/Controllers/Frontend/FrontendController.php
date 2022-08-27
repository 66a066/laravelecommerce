<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Rating;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $featured_products=Product::where('trending','1')->take(15)->get();
        $featured_categories=Category::where('popular','1')->take(15)->get();
        return view('frontend.index',compact('featured_products','featured_categories'));
    }

    public function category()
    {
        $categories=Category::where('status','0')->get();
        return view('frontend.category',compact('categories'));
    }

    public function viewcategory($slug)
    {
        if(Category::where('slug',$slug)->exists())
        {
            $category=Category::where('slug',$slug)->first();
            $products=Product::where('category_id',$category->id)->where('status','0')->get();
            return view('frontend.products.index',compact('category','products'));
        }
        else{
            return redirect('/')->with('status','Slug doesnot exists');
        }
    }

    public function viewproduct($cat_slug,$prod_slug)
    {
        if(Category::where('slug',$cat_slug)->exists())
        {
            if(Product::where('slug',$prod_slug)->exists())
            {
                $product=Product::where('slug',$prod_slug)->first();
                $ratings=Rating::where('product_id',$product->id)->get();
                $stars_sum=Rating::where('product_id',$product->id)->sum('stars_rated');
                $user_rating=Rating::where('product_id',$product->id)->where('user_id',Auth::id())->first();
                $reviews=Review::where('product_id',$product->id)->get();
                if($ratings->count() > 0)
                {
                   $ratings_value=$stars_sum/$ratings->count();
                }
                else{
                    $ratings_value=0;
                }
                return view('frontend.products.view',compact('product','reviews','ratings','user_rating','ratings_value'));
            }
            else{
                return redirect('/')->with('status','The Link Was Broken');   
            }
        }
        else{
            return redirect('/')->with('status','No such category found');
        }
    }

    public function productlistAjax()
    {
        $products=Product::select('name')->where('status','0')->get();
        $data=[];
        foreach($products as $item)
        {
            $data[]=$item['name'];
        }
        return $data;
    }

    public function searchProduct(Request $request)
    {
        $searched_product=$request->product_name;
        if($searched_product != "")
        {
            $product=Product::where("name","LIKE","%$searched_product%")->first();
            if($product)
            {
                return redirect('category/'.$product->category->slug.'/'.$product->slug);
            }
            else{
                return redirect()->back()->with('status',"Product Not Found");
            }
        }
        else{
            return redirect()->back();
        }
    }
}
