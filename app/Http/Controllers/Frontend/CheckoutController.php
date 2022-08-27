<?php

namespace App\Http\Controllers\Frontend;

use Config;
use Stripe;
use Session;
use DateTime;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function index()
    {
        // $old_cartItems=Cart::where('user_id',Auth::id())->get();
        // foreach($old_cartItems as $item)
        // {
        //     if(!Product::where('id',$item->product_id)->where('qty','>=',$item->product_qty)->exists())
        //     {
        //         $removeItem=Cart::where('user_id',Auth::id())->where('product_id',$item->product_id)->first();
        //         $removeItem->delete();
        //     }
        // }
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        if($request->Jazzcash_btn == 'Jazzcash_btn') {
            $cartItems = Cart::where('user_id', Auth::id())->get();
        $total_price = 0;
        foreach ($cartItems as $item) {
            $total_price += $item->product->selling_price * $item->product_qty;
        }

        //Current DateTime of transaction
        $DateTime= new \DateTime();
        $pp_TxnDateTime=$DateTime->format('YmdHis');

        //Expiry DateTime of transaction
        $ExpiryDateTime=$DateTime;
        $ExpiryDateTime->modify('+' . 1 . ' hours');
        $pp_ExpiryDateTime=$ExpiryDateTime->format('YmdHis');

        //Make unique transaction id using current date
        $pp_TxnRefNo='T'.$pp_TxnDateTime;

        //--------------------------------------------------------------------------------
		//$post_data

		$post_data =  array(
			"pp_Version" 			=> Config::get('constants.jazzcash.VERSION'),
			"pp_TxnType" 			=> "MWALLET",
			"pp_Language" 			=> Config::get('constants.jazzcash.LANGUAGE'),
			"pp_MerchantID" 		=> Config::get('constants.jazzcash.MERCHANT_ID'),
			"pp_SubMerchantID" 		=> "",
			"pp_Password" 			=> Config::get('constants.jazzcash.PASSWORD'),
			"pp_BankID" 			=> "TBANK",
			"pp_ProductID" 			=> "RETL",
			"pp_TxnRefNo" 			=> $pp_TxnRefNo,
			"pp_Amount" 			=> 3000,
			"pp_TxnCurrency" 		=> Config::get('constants.jazzcash.CURRENCY_CODE'),
			"pp_TxnDateTime" 		=> $pp_TxnDateTime,
			"pp_BillReference" 		=> "billRef",
			"pp_Description" 		=> "Description of transaction",
			"pp_TxnExpiryDateTime" 	=> $pp_ExpiryDateTime,
			"pp_ReturnURL" 			=> Config::get('constants.jazzcash.RETURN_URL'),
			"pp_SecureHash" 		=> "",
			"ppmpf_1" 				=> "1",
			"ppmpf_2" 				=> "2",
			"ppmpf_3" 				=> "3",
			"ppmpf_4" 				=> "4",
			"ppmpf_5" 				=> "5",
		);
        $pp_SecureHash = $this->get_SecureHash($post_data);
		
		$post_data['pp_SecureHash'] = $pp_SecureHash;

        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->fname;
        $order->lname = $request->lname;
        $order->email = $request->email;
        $order->pnumber = $request->pnumber;
        $order->address1 = $request->address1;
        $order->address2 = $request->address2;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->country = $request->country;
        $order->pcode = $request->pcode;
        $order->payment_mode = "Paid by Jazzcash";
        $order->payment_id = $post_data['pp_TxnRefNo'];

        //To calculate the total price
        $total = 0;
        $cartItem_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItem_total as $prod) {
            $total += $prod->product->selling_price * $prod->product_qty;
        }
        $order->total_price = $total;
        $order->tracking_no = 'shop' . rand('1111', '9999');
        $order->save();

        $orderId = $order->id;

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $item->product_id,
                'qty' => $item->product_qty,
                'price' => $item->product->selling_price,
            ]);
            $prod = Product::where('id', $item->product_id)->first();
            $prod->qty = $prod->qty - $item->product_qty;
            $prod->update();
        }

        if (Auth::user()->address1 == NULL) {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->fname;
            $user->lname = $request->lname;
            $user->pnumber = $request->pnumber;
            $user->address1 = $request->address1;
            $user->address2 = $request->address2;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->pcode = $request->pcode;
            $user->update();
        }
		
		
		Session::put('post_data',$post_data);
		echo '<pre>';
		print_r($post_data);
		echo '</pre>';
		
		return view('frontend.jazzcashpayment');
        }
        if (isset($_POST['stipe_payment_btn'])) {
            //To calculate the total price
            $total = 0;
            $cartItem_total = Cart::where('user_id', Auth::id())->get();
            foreach ($cartItem_total as $prod) {
                $total += $prod->product->selling_price * $prod->product_qty;
            }

            $stripetoken = $request->input('stripeToken');
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            \Stripe\Charge::create([
                'amount' => $total * 100,
                'currency' => 'usd',
                'description' => "Thank you for purchasing with E-Shop",
                'source' => $stripetoken,
                'shipping' => [
                    'name' => $request->fname,
                    'phone' => $request->pnumber,
                    'address' => [
                        'line1' => $request->address1,
                        'line2' => $request->address2,
                        'postal_code' => $request->pcode,
                        'city' => $request->city,
                        'state' => $request->state,
                        'country' => $request->country,
                    ],
                ],
            ]);
            $order = new Order();
            $order->user_id = Auth::id();
            $order->fname = $request->fname;
            $order->lname = $request->lname;
            $order->email = $request->email;
            $order->pnumber = $request->pnumber;
            $order->address1 = $request->address1;
            $order->address2 = $request->address2;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->country = $request->country;
            $order->pcode = $request->pcode;
            $order->payment_mode = "Paid by Stripe";
            $order->payment_id = $stripetoken;

            $order->total_price = $total;
            $order->tracking_no = 'shop' . rand('1111', '9999');
            $order->save();

            $orderId = $order->id;

            $cartItems = Cart::where('user_id', Auth::id())->get();
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $orderId,
                    'product_id' => $item->product_id,
                    'qty' => $item->product_qty,
                    'price' => $item->product->selling_price,
                ]);
                $prod = Product::where('id', $item->product_id)->first();
                $prod->qty = $prod->qty - $item->product_qty;
                $prod->update();
            }

            if (Auth::user()->address1 == NULL) {
                $user = User::where('id', Auth::id())->first();
                $user->name = $request->fname;
                $user->lname = $request->lname;
                $user->pnumber = $request->pnumber;
                $user->address1 = $request->address1;
                $user->address2 = $request->address2;
                $user->city = $request->city;
                $user->state = $request->state;
                $user->country = $request->country;
                $user->pcode = $request->pcode;
                $user->update();
            }

            $cartItems = Cart::where('user_id', Auth::id())->get();
            Cart::destroy($cartItems);
            return redirect('/my-orders')->with('status','Order has been placed Successfully');
        }

        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->fname;
        $order->lname = $request->lname;
        $order->email = $request->email;
        $order->pnumber = $request->pnumber;
        $order->address1 = $request->address1;
        $order->address2 = $request->address2;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->country = $request->country;
        $order->pcode = $request->pcode;
        $order->payment_mode = $request->payment_mode;
        $order->payment_id = $request->payment_id;

        //To calculate the total price
        $total = 0;
        $cartItem_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItem_total as $prod) {
            $total += $prod->product->selling_price * $prod->product_qty;
        }
        $order->total_price = $total;
        $order->tracking_no = 'shop' . rand('1111', '9999');
        $order->save();

        $orderId = $order->id;

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $item->product_id,
                'qty' => $item->product_qty,
                'price' => $item->product->selling_price,
            ]);
            $prod = Product::where('id', $item->product_id)->first();
            $prod->qty = $prod->qty - $item->product_qty;
            $prod->update();
        }

        if (Auth::user()->address1 == NULL) {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->fname;
            $user->lname = $request->lname;
            $user->pnumber = $request->pnumber;
            $user->address1 = $request->address1;
            $user->address2 = $request->address2;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->pcode = $request->pcode;
            $user->update();
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);
        if ($request->payment_mode == "Paid by Razorpay" || $request->payment_mode == "Paid by Paypal") {
            return response()->json(['status' => "Order placed Successfully"]);
        }
        return redirect('/my-orders')->with('status', "Order placed Successfully");
    }

    public function razorPayCheck(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total_price = 0;
        foreach ($cartItems as $item) {
            $total_price += $item->product->selling_price * $item->product_qty;
        }
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $email = $request->input('email');
        $pnumber = $request->input('pumber');
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $pcode = $request->input('pcode');

        return response()->json([
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'pnumber' => $pnumber,
            'address1' => $address1,
            'address2' => $address2,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'pcode' => $pcode,
            'total_price' => $total_price,
        ]);
    }

    public function doCheckout(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total_price = 0;
        foreach ($cartItems as $item) {
            $total_price += $item->product->selling_price * $item->product_qty;
        }

        //Current DateTime of transaction
        $DateTime= new \DateTime();
        $pp_TxnDateTime=$DateTime->format('YmdHis');

        //Expiry DateTime of transaction
        $ExpiryDateTime=$DateTime;
        $ExpiryDateTime->modify('+' . 1 . ' hours');
        $pp_ExpiryDateTime=$ExpiryDateTime->format('YmdHis');

        //Make unique transaction id using current date
        $pp_TxnRefNo='T'.$pp_TxnDateTime;

        //--------------------------------------------------------------------------------
		//$post_data

		$post_data =  array(
			"pp_Version" 			=> Config::get('constants.jazzcash.VERSION'),
			"pp_TxnType" 			=> "MWALLET",
			"pp_Language" 			=> Config::get('constants.jazzcash.LANGUAGE'),
			"pp_MerchantID" 		=> Config::get('constants.jazzcash.MERCHANT_ID'),
			"pp_SubMerchantID" 		=> "",
			"pp_Password" 			=> Config::get('constants.jazzcash.PASSWORD'),
			"pp_BankID" 			=> "TBANK",
			"pp_ProductID" 			=> "RETL",
			"pp_TxnRefNo" 			=> $pp_TxnRefNo,
			"pp_Amount" 			=> $total_price,
			"pp_TxnCurrency" 		=> Config::get('constants.jazzcash.CURRENCY_CODE'),
			"pp_TxnDateTime" 		=> $pp_TxnDateTime,
			"pp_BillReference" 		=> "billRef",
			"pp_Description" 		=> "Description of transaction",
			"pp_TxnExpiryDateTime" 	=> $pp_ExpiryDateTime,
			"pp_ReturnURL" 			=> Config::get('constants.jazzcash.RETURN_URL'),
			"pp_SecureHash" 		=> "",
			"ppmpf_1" 				=> "1",
			"ppmpf_2" 				=> "2",
			"ppmpf_3" 				=> "3",
			"ppmpf_4" 				=> "4",
			"ppmpf_5" 				=> "5",
		);

        $pp_SecureHash = $this->get_SecureHash($post_data);
		
		$post_data['pp_SecureHash'] = $pp_SecureHash;

        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->fname;
        $order->lname = $request->lname;
        $order->email = $request->email;
        $order->pnumber = $request->pnumber;
        $order->address1 = $request->address1;
        $order->address2 = $request->address2;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->country = $request->country;
        $order->pcode = $request->pcode;
        $order->payment_mode = "Paid by Jazzcash";
        $order->payment_id = $post_data['pp_TxnRefNo'];

        //To calculate the total price
        $total = 0;
        $cartItem_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItem_total as $prod) {
            $total += $prod->product->selling_price * $prod->product_qty;
        }
        $order->total_price = $total;
        $order->tracking_no = 'shop' . rand('1111', '9999');
        $order->save();

        $orderId = $order->id;

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $item->product_id,
                'qty' => $item->product_qty,
                'price' => $item->product->selling_price,
            ]);
            $prod = Product::where('id', $item->product_id)->first();
            $prod->qty = $prod->qty - $item->product_qty;
            $prod->update();
        }

        if (Auth::user()->address1 == NULL) {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->fname;
            $user->lname = $request->lname;
            $user->pnumber = $request->pnumber;
            $user->address1 = $request->address1;
            $user->address2 = $request->address2;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->pcode = $request->pcode;
            $user->update();
        }
		
		
		Session::put('post_data',$post_data);
		echo '<pre>';
		print_r($post_data);
		echo '</pre>';
		
		return view('frontend.jazzcashpayment')->render();
    }

    private function get_SecureHash($data_array)
	{
		ksort($data_array);
		
		$str = '';
		foreach($data_array as $key => $value){
			if(!empty($value)){
				$str = $str . '&' . $value;
			}
		}
		
		$str = Config::get('constants.jazzcash.INTEGERITY_SALT').$str;
		
		$pp_SecureHash = hash_hmac('sha256', $str, Config::get('constants.jazzcash.INTEGERITY_SALT'));
		
		//echo '<pre>';
		//print_r($data_array);
		//echo '</pre>';
		
		return $pp_SecureHash;
	}

    public function removeCart(Request $request)
    {
        return $response = $request->input();
		echo '<pre>';
		print_r($response);
		echo '</pre>';
		
		if($response['pp_ResponseCode'] == '000')
		{
			$response['pp_ResponseMessage'] = 'Your Payment has been Successful';
			$values = array('status' => 'completed');
			DB::table('orders')
				->where('TxnRefNo',$response['pp_TxnRefNo'])
				->update(['status' => '1']);
		}
		
		// return view('payment-status',['response'=>$response]);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);
        return redirect('/my-orders')->with('status', "Order placed Successfully");
    }
}
