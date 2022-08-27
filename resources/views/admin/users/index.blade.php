@extends('layouts.admin')

@section('title')
Users
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Registered Users</h2>
            <!-- <a class="au-btn au-btn-icon au-btn--blue btn-sm" href="">
            add Product</a> -->
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name.' '.$user->lname}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->pnumber}}</td>
                        <td>
                            <a href="{{url('view-user/'.$user->id)}}" class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>

@endsection