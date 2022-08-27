<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $prod_id=$request->product_id;
        $stars_reted=$request->product_rating;
        $prod_check=Product::where('id', $prod_id)->where('status','0')->first();
        if($prod_check)
        {
            $varified_purchase=Order::where('orders.user_id',Auth::id())
            ->join('order_items','orders.id','order_items.order_id')
            ->where('order_items.product_id',$prod_id)->get();

            if($varified_purchase->count() > 0)
            {
                $existed_rating=Rating::where('user_id',Auth::id())->where('product_id',$prod_id)->first();
                if($existed_rating)
                {
                    $existed_rating->stars_rated=$stars_reted;
                    $existed_rating->update();
                }
                else{
                    Rating::create([
                        'user_id' => Auth::id(),
                        'product_id' => $prod_id,
                        'stars_rated' => $stars_reted,
                    ]);
                }
                return redirect()->back()->with('status',"Thank you for rating this product");
            }
            else{
                return redirect()->back()->with('status',"Please buy $prod_check->name first");
            }
        }
        else{
            return redirect()->back()->with('status',"The Link you follwed was broken");
        }

        //$ratings->save();
        return;
    }
}
