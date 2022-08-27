@extends('layouts.frontend')
@section('title',$product->name)
@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{url('/add-rating')}}">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Rate {{$product->name}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="rating-css">
            <div class="star-icon">
              @if($user_rating)
              @for($i=1; $i<=$user_rating->stars_rated; $i++)
              <input type="radio" value="{{$i}}" name="product_rating" checked id="rating{{$i}}">
              <label for="rating{{$i}}" class="fa fa-star"></label>
              @endfor
              @for($j=$user_rating->stars_rated+1;$j<=5; $j++)
              <input type="radio" value="{{$j}}" name="product_rating" id="rating{{$j}}">
              <label for="rating{{$j}}" class="fa fa-star"></label>
              @endfor
              @else
              <input type="radio" value="1" name="product_rating" checked id="rating1">
              <label for="rating1" class="fa fa-star"></label>
              <input type="radio" value="2" name="product_rating" id="rating2">
              <label for="rating2" class="fa fa-star"></label>
              <input type="radio" value="3" name="product_rating" id="rating3">
              <label for="rating3" class="fa fa-star"></label>
              <input type="radio" value="4" name="product_rating" id="rating4">
              <label for="rating4" class="fa fa-star"></label>
              <input type="radio" value="5" name="product_rating" id="rating5">
              <label for="rating5" class="fa fa-star"></label>
              @endif
              
              
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
  <div class="container">
    <h6 class="mb-0">
      <a href="{{url('category')}}">
        Collections
      </a> /
      <a href="{{url('category/'.$product->category->slug)}}">
        {{$product->category->name}}
      </a> /
      <a href="{{url('category/'.$product->category->slug .'/'.$product->slug)}}">
        {{$product->name}}
      </a>
    </h6>
  </div>
</div>
<div class="container pb-5">
  <div class="product_data">
    <div>
      <div class="row">
        <div class="col-md-4 border-right">
          <img src="{{asset('assets/product/'.$product->product_image)}}" class="w-100" alt="Product Image">
        </div>
        <div class="col-md-8">
          <h2 class="mb-0">
            {{$product->name}}
            @if($product->trending == '1')
            <label style="font-size: 16px;" class="float-end badge bg-danger tending_tag">Trending</label>
            @endif
          </h2>
          <hr>
          <label class="me-3">Original Price : <s>Rs {{$product->original_price}}</s></label>
          <label class="fw-bold">Selling Price : Rs {{$product->selling_price}}</label>
          <div class="rating">
            @php $ratenum=number_format($ratings_value) @endphp
            @for($i=1; $i<=$ratenum; $i++)
            <i class="fa fa-star checked"></i>
            @endfor
            @for($j=$ratenum+1;$j<=5; $j++)
            <i class="fa fa-star"></i>
            @endfor
            @if($ratings->count() > 0)
            <span>{{$ratings->count() }} Ratings</span>
            @else
            No Ratings
            @endif
          </div>
          <p class="mt-3">
            {!! $product->small_description !!}
          </p>
          <hr>
          @if($product->qty > 0)
          <label class="badge bg-success">In Stock</label>
          @else
          <label class="badge bg-danger">Out Of Stock</label>
          @endif
          <div class="row mt-2">
            <div class="col-md-2">
              <input type="hidden" value="{{$product->id}}" class="product_id">
              <label for="Quantity">Quantity</label>
              <div class="input-group text-center mb-3">
                <button class="input-group-text decreament-btn">-</button>
                <input type="text" name="quantity" value="1" class="form-control qty-input" />
                <button class="input-group-text increament-btn">+</button>
              </div>
            </div>
            <div class="col-md-10">
              <br />
              @if($product->qty > 0)
              <button type="button" class="btn btn-primary me-3 addToCartBtn float-start">Add To Cart <i class="fa fa-shopping-cart"></i></button>
              @endif
              <button type="button" class="btn btn-success me-3 float-start addToWishlist">Add To Wishlist <i class="fa fa-heart"></i></button>
            </div>
          </div>
        </div>
        <div class="clol-md-12">
        <hr>
        <h3>Description</h3>
        <p class="mt-3">
          {!! $product->description !!}
        </p>
      </div>
      <hr>
      </div>
    <div class="row">
      <div class="col-md-4">
      <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Rate this product
        </button>
        <a href="{{url('add-review/'.$product->slug.'/userreview')}}" class="btn btn-link">
          Write a review
        </a>
      </div>
      <div class="col-md-8">
        @foreach($reviews as $review)
        <div class="user-review">
        <label for="">{{$review->user->name .' '.$review->user->lname}}</label>
        @if($review->user_id ==Auth::id())
      <a href="{{url('edit-review/'.$product->slug.'/userreview')}}">edit</a>
      @endif
      <br>
      @php
      $rating=App\Models\Rating::where('product_id',$product->id)->where('user_id',$review->user->id)->first();
       @endphp
      @if($rating)
      @php $user_rated=$rating->stars_rated; @endphp
      @for($i=1; $i<=$user_rated; $i++)
            <i class="fa fa-star checked"></i>
            @endfor
            @for($j=$user_rated+1;$j<=5; $j++)
            <i class="fa fa-star"></i>
            @endfor
            @endif
      <small>{{$review->created_at->format('d M Y')}}</small>
      <p>
      {{$review->user_review}}
      </p>
        </div>
        @endforeach
      
      </div>
    </div>
    </div>
  </div>
</div>
@endsection