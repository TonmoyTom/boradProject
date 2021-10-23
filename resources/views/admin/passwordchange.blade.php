@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
      Passwoard Change
    </div>
<div class="card-body">
    <div class="form-group">
        
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-6 col-md-6">
                <div class="well well-sm">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>    
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
    
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>    
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
    
                <form action="{{url('/admin/password/change/store')}}" method="POST"  id="updatePasswordForm" name="updatePasswordForm">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Name </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name="name"  id="admin_name" value="{{$admindetails->name}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Email </label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control"  name="email" id="admin_email" value="{{$admindetails->email}}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Old Password </label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control"  name="old_password" id="old_password">
                    <span id="chkoldpwd" ></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">New Password </label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control"  name="new_password" id="new_password"  require>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Confirm Passsword</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control"  name="confirm_pass" id="confirm_pass" require>
                    </div>
                </div>
                 
                    <div class="form-group">
                        <button class="btn btn-success" type="submit" >Submit</button>
                        <a class="btn btn-info" href="{{ route('admin.home') }}">
                           Back
                        </a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>


@endsection

