@extends('layouts.frontend')
@section('title')
Category
@endsection
@section('content')
@include('layouts.inc.slider')
<div class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h2>
      All Categories
    </h2>
    <div class="row">
        @foreach($categories as $category)
        <div class="col-md-3 mb-3">
          <a href="{{url('category/'.$category->slug)}}">
          <div class="card">
            <img class="featured-images" src="{{asset('assets/category/'.$category->category_image)}}" alt="Category Image">
            <div class="card-body">
              <h5>{{$category->name}}</h5>
              <p>
                {{$category->description}}
              </p>
            </div>
          </div>
          </a>
        </div>
        @endforeach
    </div>
      </div>
    </div>
  </div>
</div>
@endsection