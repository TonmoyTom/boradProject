@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
      User Create
    </div>
<div class="card-body">
    <div class="form-group">
        
        <div class="row justify-content-center">
            <div class="col-lg-10 col-sm-6 col-md-6">
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
    
                <form action="{{route('users.store')}}" method="POST"  >
                @csrf
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label" style="color: #000;">Name</label>
                    <input type="text" class="form-control" name="name" style="color: #000;">
  
                    
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label " style="color: #000;">Eamil</label>
                    <input type="email" class="form-control" name="email" >
  
                   
                  </div>
                  <div class="form-group">
                    <label for="role" style="color: #000;">Role</label>
                    <select class="custom-select js-example-basic-multiple" id="inputGroupSelect01" name="roles[]" multiple >
                        <option style="color: #000;" >Choose...</option>
                        @foreach ($role as $item)
                        <option style="color: #000;" value="{{$item->id}}">{{$item->name}}..</option>
                        @endforeach
                    </select>
                    <p class=" btn-success" style="font-size: 16px;">If you want to create a user, you do not have to select a role.</p>
                    @error('roles')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label" style="color: #000;">Password</label>
                    <input type="password" class="form-control" name="password" style="color: #000;">
  
                   
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label" style="color: #000;">Confirm Password</label>
                    <input type="password" class="form-control" name="cpassword" style="color: #000;">
                  </div>
                  <div class="form-group" style="margin-left: 19px;">
                    <input type="hidden" name="isAdmin" value="0"/>
                    <input type="checkbox" class="form-check-input" name="isAdmin"  value="1">
                    <label class="form-check-label" for="checkPermission" style="font-size: 16px;">Can be Access the Dashboard</label>
                </div>
                 
                    <div class="form-group" >
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

