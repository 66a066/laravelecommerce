@extends('layouts.admin')

@section('title')
Category
@endsection

@section('content')
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <strong>Update Category</strong>
    </div>
    <form action="{{url('update-category/'.$categories->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card-body card-block">
        <div class="has-success form-group">
          <label for="inputIsValid" class=" form-control-label">Name</label>
          <input type="text" id="inputIsValid" name="name" value="{{$categories->name}}" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Slug</label>
          <input type="text" id="inputIsValid" name="slug" value="{{$categories->slug}}" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Description</label>
          <textarea type="text" rows="3" name="description" id="inputIsValid" class="is-valid form-control-success form-control" required>{{$categories->description}}</textarea>
        </div>
        <div class="has-success form-group">
          <label for="inputIsValid" class=" form-control-label">Status</label>
          <input type="checkbox" name="status" {{$categories->status == "1" ? 'checked' : ''}}>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Popular</label>
          <input type="checkbox" name="popular" {{$categories->popular == "1" ? 'checked' : ''}}>
        </div>
        @if($categories->category_image)
        <img src="{{asset('assets/category/'.$categories->category_image)}}"  class="cate-image" alt="image here">
        @endif
        <div class="has-success form-group">
          <label for="inputIsvalid" class=" form-control-label">Category Image</label>
          <input type="file" id="inputIsvalid" name="category_image" class="is-valid form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsvalid" class="form-control-label">Meta Title</label>
          <input type="text" id="inputIsvalid" name="meta_title" value="{{$categories->meta_title}}" class="is-valid form-control">
        </div>
        <div class="has-success form-group">
          <label for="inputIsvalid" class="form-control-label">Meta Description</label>
          <textarea type="text" rows="3" name="meta_descrip" id="inputIsvalid" class="is-valid form-control">{{$categories->meta_descrip}}</textarea>
        </div>
        <div class="has-success form-group">
          <label for="inputIsvalid" class="form-control-label">Meta Keywords</label>
          <textarea type="text" name="meta_keywords" rows="3" id="inputIsvalid" class="is-valid form-control">{{$categories->meta_title}}</textarea>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm">
          <i class="fa fa-dot-circle-o"></i> Update
        </button>
      </div>
    </form>
  </div>
</div>
@endsection