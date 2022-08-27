<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $product_id=$request->input('product_id');
        $product_qty=$request->input('product_qty');
        if(Auth::check())
        {
            $prod_check=Product::where('id',$product_id)->first();
            if($prod_check)
            {
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json(['status' => $prod_check->name." Already Added to Cart"]);
                }
                else
                {
                    $cartItem=new Cart();
                    $cartItem->user_id=Auth::id();
                    $cartItem->product_id=$product_id;
                    $cartItem->product_qty=$product_qty;
                    $cartItem->save();
                    return response()->json(['status' => $prod_check->name." Added to Cart Successfully"]);
                }
            }
        }
        else{
            return response()->json(['status' => "Please Login to Continue.."]);
        }
    }

    public function viewcart()
    {
        $carts=Cart::where('user_id',Auth::id())->get();
        return view('frontend.cart',compact('carts'));
    }

    public function deleteProduct(Request $request)
    {
        
        if(Auth::check())
        {
            $product_id=$request->input('prod_id');
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    $cartItem=Cart::where('product_id',$product_id)->first();
                    $cartItem->delete();
                    return response()->json(['status' => "Product Deleted Successfully"]);
                }
        }
        else{
            return response()->json(['status' => "Please Login to Continue.."]);
        }
    }

    public function updateProduct(Request $request)
    {
        $product_id=$request->input('prod_id');
        $product_qty=$request->input('prod_qty');
        if(Auth::check())
        {
            $product_id=$request->input('prod_id');
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    $cartItem=Cart::where('product_id',$product_id)->first();
                    $cartItem->product_qty=$product_qty;
                    $cartItem->update();
                    return response()->json(['status' => "Quantity Updated Successfully"]);
                }
        }
        else{
            return response()->json(['status' => "Please Login to Continue.."]);
        }
    }

    public function cartCount()
    {
        $cartcount=Cart::where('user_id',Auth::id())->count();
        return response()->json(['count' => $cartcount]);
    }
}
