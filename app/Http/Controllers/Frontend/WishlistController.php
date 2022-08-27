<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists=Wishlist::where('user_id',Auth::id())->get();
        return view('frontend.wishlist',compact('wishlists'));
    }

    public function store(Request $request)
    {
        if(Auth::check())
        {
            $product_id=$request->input('product_id');
            $prod_check=Product::find($product_id);
            if($prod_check)
            {
                    $wish=new Wishlist();
                    $wish->user_id=Auth::id();
                    $wish->product_id=$product_id;
                    $wish->save();
                    return response()->json(['status' => $prod_check->name." Added to Wishlist Successfully"]);
            }
            else{
                return response()->json(['status' =>"Product does not exist"]);
            }
        }
        else{
            return response()->json(['status' => "Please Login to Continue.."]);
        }
    }

    public function destroy(Request $request)
    {
        if(Auth::check())
        {
            $product_id=$request->input('prod_id');
                if(Wishlist::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    $wish=Wishlist::where('product_id',$product_id)->first();
                    $wish->delete();
                    return response()->json(['status' => "Product removed from Wishlist Successfully"]);
                }
        }
        else{
            return response()->json(['status' => "Please Login to Continue.."]);
        }
    }

    public function wishlistcount()
    {
        $wishcount=Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['wishlist' => $wishcount]);
    }
}
