@extends('backend.admin_master')

@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6"><br>
                    <div class="card">
                        {{-- <h1>{{$editData->image}}</h1> --}}
                        <center>
                            <img class="rounded-circle avatar-xl " 
                                src="{{(!empty($adminData->image)) 
                                ? Storage::url($adminData->image)
                                : 'https://picsum.photos/seed/picsum/500/500' }}" 
                                alt="Card image cap">
                        </center>
                        <div class="card-body">
                            <h4 class="card-title">Name: {{$adminData->name}}</h4>
                            <hr>
                            <h4 class="card-title">Email: {{$adminData->email}}</h4>
                            <hr>
                            <a href="{{route('edit.profile')}}" class="btn btn-info btn-rounded waves-effect waves-light">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection