@extends('backend.admin_master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Chỉnh sửa hồ sơ</h4>
                            <form action="{{route('store.profile')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="name" name="name" value="{{$editData->name}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" id="email" name="email" value="{{$editData->email}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="profile_image" class="col-sm-2 col-form-label">Profile Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="profile_image" name="image">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" id="show_image" 
                                        src="{{(!empty($editData->image)) 
                                        ? Storage::url($editData->image)
                                        : 'https://picsum.photos/seed/picsum/500/500' }}" alt="Card image cap">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    {{-- <label for="" class="col-sm-2 col-form-label"></label> --}}
                                    <div class="col-sm-10">
                                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Frofile">
                                    </div>
                                </div>
                            </form>
                            <!-- end row -->
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#profile_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection