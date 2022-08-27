<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index($product_slug)
    {
       $product=Product::where('slug',$product_slug)->where('status','0')->first();
       if($product)
       {
        $product_id=$product->id;
        $review=Review::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            if($review)
            {
                return view('frontend.reviews.edit',compact('review','product'));
            }
            else{
                $varified_purchase=Order::where('orders.user_id',Auth::id())
                ->join('order_items','orders.id','order_items.order_id')
                ->where('order_items.product_id',$product_id)->get();
                return view('frontend.reviews.index',compact('product','varified_purchase'));   
            }
       }
       else{
        return redirect()->back()->with('status',"The link you follwed was broken");
       }
    }

    public function store(Request $request)
    {
        $prod_id=$request->product_id;
        $product=Product::where('id',$prod_id)->where('status','0')->first();
        if($product)
        {
            $user_review=$request->user_review;
            $new_review=Review::create([
                'user_id' => Auth::id(),
                'product_id' => $prod_id,
                'user_review' => $user_review,
            ]);
            $category_slug=$product->category->slug;
            $product_slug=$product->slug;
            if($new_review)
            {
                return redirect('category/'.$category_slug.'/'.$product_slug)->with('status',"Thank you for writing a review");
            }

        }
        else{
            return redirect()->back()->with('status',"The link you follwed was broken");
        }
    }

    public function edit($product_slug)
    {
        $product=Product::where('slug',$product_slug)->where('status','0')->first();
        if($product)
        {
            $product_id=$product->id;
            $review=Review::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            if($review)
            {
                return view('frontend.reviews.edit',compact('review'));

            }
            else{
                return redirect()->back()->with('status',"The link you follwed was broken");
            }
        }
        else{
            return redirect()->back()->with('status',"The link you follwed was broken");
        }
    }

    public function update(Request $request)
    {
        $user_review=$request->user_review;
        if($user_review != '')
        {
            $review_id=$request->review_id;
            $review=Review::where('id',$review_id)->where('user_id',Auth::id())->first();
            if($review)
            {
                $review->user_review=$request->user_review;
                $review->update();
                return redirect('category/'.$review->product->category->slug.'/'.$review->product->slug)->with('status',"Review Updated Successfully");
            }
            else{
                return redirect()->back()->with('status',"You cannot submit an empty review");
            }
           
        }
        else{
            return redirect()->back()->with('status',"The link you follwed was broken");
        }
    }
}
