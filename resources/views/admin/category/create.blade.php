@extends('layouts.admin')

@section('title')
Category
@endsection

@section('content')
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <strong>Add Category</strong>
    </div>
    <form action="{{url('/insert')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card-body card-block">
        <div class="has-success form-group">
          <label for="inputIsValid" class=" form-control-label">Name</label>
          <input type="text" id="inputIsValid" name="name" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Slug</label>
          <input type="text" id="inputIsValid" name="slug" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Description</label>
          <textarea type="text" rows="3" name="description" id="inputIsValid" class="is-valid form-control-success form-control" required></textarea>
        </div>
        <div class="has-success form-group">
          <label for="inputIsValid" class=" form-control-label">Status</label>
          <input type="checkbox" name="status">
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Popular</label>
          <input type="checkbox" name="popular">
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Category Image</label>
          <input type="file" id="inputIsInvalid" name="category_image" class="is-invalid form-control">
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Meta Title</label>
          <input type="text" id="inputIsInvalid" name="meta_title" class="is-invalid form-control">
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Meta Description</label>
          <textarea type="text" rows="3" name="meta_descrip" id="inputIsInvalid" class="is-invalid form-control"></textarea>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Meta Keywords</label>
          <textarea type="text" name="meta_keywords" rows="3" id="inputIsInvalid" class="is-invalid form-control"></textarea>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm">
          <i class="fa fa-dot-circle-o"></i> Submit
        </button>
      </div>
    </form>
  </div>
</div>
@endsection