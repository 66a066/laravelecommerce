@extends('layouts.frontend')
@section('title')
Checkout
@endsection
@section('content')
<div class="container mt-5">
  <form method="POST" action="{{url('place-order')}}" class="require-validation" data-cc-on-file="false" id="payment-form">
    @csrf
    <div class="row">
      <div class="col-md-7">
        <div class="card">
          <div class="card-body">
            <h6>Basic Details</h6>
            <hr>
            <div class="row checkout-form">
              <div class="col-md-6">
                <label for="">First Name</label>
                <input type="text" class="form-control fname" value="{{Auth::user()->name}}" name="fname" placeholder="Enter First Name" />
                <span id="fname_err" class="text-danger"></span>
              </div>
              <div class="col-md-6">
                <label for="">Last Name</label>
                <input type="text" class="form-control lname" value="{{Auth::user()->lname}}" name="lname" placeholder="Enter Last Name" />
                <span id="lname_err" class="text-danger"></span>
              </div>
              <div class="col-md-6 mt-3">
                <label for="">Email</label>
                <input type="text" class="form-control email" name="email" value="{{Auth::user()->email}}" placeholder="Enter Email" />
                <span id="email_err" class="text-danger"></span>
              </div>
              <div class="col-md-6 mt-3">
                <label for="">Phone Number</label>
                <input type="text" class="form-control pnumber" name="pnumber" value="{{Auth::user()->pnumber}}" placeholder="Enter Phone Number" />
                <span id="pnumber_err" class="text-danger"></span>
              </div>
              <div class="col-md-6 mt-3">
                <label for="">Address 1</label>
                <input type="text" class="form-control address1" name="address1" value="{{Auth::user()->address1}}" placeholder="Enter Address 1" />
                <span id="address1_err" class="text-danger"></span>
              </div>
              <div class="col-md-6 mt-3">
                <label for="">Address 2</label>
                <input type="text" class="form-control address2" name="address2" value="{{Auth::user()->address2}}" placeholder="Enter Address 2" />
                <span id="address2_err" class="text-danger"></span>
              </div>
              <div class="col-md-6 mt-3">
                <label for="">City</label>
                <input type="text" class="form-control city" name="city" value="{{Auth::user()->city}}" placeholder="Enter City" />
                <span id="city_err" class="text-danger"></span>
              </div>
              <div class="col-md-6 mt-3">
                <label for="">State</label>
                <input type="text" class="form-control state" name="state" value="{{Auth::user()->state}}" placeholder="Enter State" />
                <span id="state_err" class="text-danger"></span>
              </div>
              <div class="col-md-6 mt-3">
                <label for="">Country</label>
                <input type="text" class="form-control country" name="country" value="{{Auth::user()->country}}" placeholder="Enter Country" />
                <span id="country_err" class="text-danger"></span>
              </div>
              <div class="col-md-6 mt-3">
                <label for="">Pin Code</label>
                <input type="text" class="form-control pcode" name="pcode" value="{{Auth::user()->pcode}}" placeholder="Enter Pin Code" />
                <span id="pcode_err" class="text-danger"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="card">
          <div class="card-body">
            <h6>Order Details</h6>
            <hr>
            @if($cartItems->count() > 0)
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <td>Name</td>
                  <td>Quantity</td>
                  <td>Price</td>
                </tr>
              </thead>
              <tbody>
                @php $total=0; @endphp
                @foreach($cartItems as $item)
                <tr>
                  <td>{{$item->product->name}}</td>
                  <td>{{$item->product_qty}}</td>
                  <td>{{$item->product->selling_price}}</td>
                </tr>
                @php $total += $item->product->selling_price * $item->product_qty; @endphp
                @endforeach
              </tbody>

            </table>
            <div class="card-footer">
              <h6>Grand Total
                <div class="float-end">RS {{number_format($total)}}</div>
              </h6>
            </div>
            <hr>
            <input type="hidden" name="payment_mode" value="COD">
            <button type="submit" class="btn btn-success w-100">Place Order | COD</button>
            <button type="submit" name="Jazzcash_btn" value="Jazzcash_btn" class="btn btn-secondary w-100 mt-3 ">Pay with JazzCash</button>
            <button type="button" class="btn btn-primary w-100 mt-3 razorpay_btn">Pay with Razorpay</button>
            
            <button type="button" class="btn btn-danger btn-block w-100 mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#StripeCardModal">Stripe - Pay Online</button>
            @include('frontend.stripepaymodal')
            <!-- <div id="paypal-button-container"></div> -->
            @else
            <div class="card-body text-center">
              <h2>No products in cart</h2>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{asset('frontend/js/stripe-checkout.js')}}"></script>
<script src="{{asset('frontend/js/jazzcash-checkout.js')}}"></script>
<!-- <script src="https://www.paypal.com/sdk/js?client-id=ATLXKmwIN5o3rdWvdyNMrehscR-E3zISkJw2ERgc0_17PNlbscIHtzSsH1pv4O4ydnE5Iw8FlDvLwuQa"></script>

<script>
  paypal.Buttons({ -->
    <!-- // Sets up the transaction when a payment button is clicked -->
    <!-- createOrder: (data, actions) => {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '{{ $total }}' // Can also reference a variable or function
          }
        }]
      });
    }, -->
    <!-- Finalize the transaction after payer approval -->
    <!-- onApprove: (data, actions) => {
      return actions.order.capture().then(function(orderData) { -->
        <!-- // Successful capture! For dev/demo purposes:
        // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
        // const transaction = orderData.purchase_units[0].payments.captures[0];
        // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
        // When ready to go live, remove the alert and show a success message within this page. For example:
        // const element = document.getElementById('paypal-button-container');
        // element.innerHTML = '<h3>Thank you for your payment!</h3>';
        // Or go to another URL:  actions.redirect('thank_you.html'); -->
        <!-- var fname = $('.fname').val();
        var lname = $('.lname').val();
        var email = $('.email').val();
        var pnumber = $('.pnumber').val();
        var address1 = $('.address1').val();
        var address2 = $('.address2').val();
        var city = $('.city').val();
        var state = $('.state').val();
        var country = $('.country').val();
        var pcode = $('.pcode').val();

        if (!fname) {
          fname_err = "First Name is required";
          $('#fname_err').html('');
          $('#fname_err').html(fname_err);
        } else {
          fname_err = "";
          $('#fname_err').html('');
        }
        if (!lname) {
          lname_err = "Last Name is required";
          $('#lname_err').html('');
          $('#lname_err').html(lname_err);
        } else {
          lname_err = "";
          $('#lname_err').html('');
        }
        if (!email) {
          email_err = "Email is required";
          $('#email_err').html('');
          $('#email_err').html(email_err);
        } else {
          email_err = "";
          $('#email_err').html('');
        }
        if (!pnumber) {
          pnumber_err = "Phone Number is required";
          $('#pnumber_err').html('');
          $('#pnumber_err').html(pnumber_err);
        } else {
          pnumber_err = "";
          $('#pnumber_err').html('');
        }
        if (!address1) {
          address1_err = "Address1 is required";
          $('#address1_err').html('');
          $('#address1_err').html(address1_err);
        } else {
          address1_err = "";
          $('#address1_err').html('');
        }
        if (!address2) {
          address2_err = "Address2 is required";
          $('#address2_err').html('');
          $('#address2_err').html(address2_err);
        } else {
          address2_err = "";
          $('#address2_err').html('');
        }
        if (!city) {
          city_err = "City name  is required";
          $('#city_err').html('');
          $('#city_err').html(city_err);
        } else {
          city_err = "";
          $('#city_err').html('');
        }
        if (!state) {
          state_err = "State name is required";
          $('#state_err').html('');
          $('#state_err').html(state_err);
        } else {
          state_err = "";
          $('#state_err').html('');
        }
        if (!pcode) {
          pcode_err = "Pin Code is required";
          $('#pcode_err').html('');
          $('#pcode_err').html(pcode_err);
        } else {
          pcode_err = "";
          $('#pcode_err').html('');
        }
        if (!country) {
          country_err = "Country name is required";
          $('#country_err').html('');
          $('#country_err').html(country_err);
        } else {
          country_err = "";
          $('#country_err').html('');
        }

        if (fname_err != '' || lname_err != '' || email_err != '' || pnumber_err != '' || address1_err != '' || address2_err != '' || city_err != '' || state_err != '' || country_err != '' || pcode_err != '') {
          return false;
        } else {
          $.ajax({
            method: "POST",
            url: "/place-order",
            data: {
              'fname': fname,
              'lname': lname,
              'email': email,
              'pnumber': pnumber,
              'address1': address1,
              'address2': address2,
              'city': city,
              'state': state,
              'country': country,
              'pcode': pcode,
              'payment_mode': "Paid by Paypal",
              'payment_id': orderData.id,
            },
            success: function(response) {
              swal(response.status)
                .then((value) => {
                  window.location.href = "/my-orders";
                });
            }
          });
        }
      });
    }
  }).render('#paypal-button-container');
</script> -->

@endsection