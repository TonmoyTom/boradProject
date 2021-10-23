@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
      Subject
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
    
                <form action="{{route('answers.store')}}" method="POST"  >
                @csrf

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label" style="color: #000;">SubJects</label>
                    <select class="custom-select" id="inputGroupSelect01" name="qus_id"  >
                        <option style="color: #000;" >Choose...</option>
                        @foreach ($qustion as $item)
                        <option style="color: #000;" value="{{$item->id}}">{{$item->name}}..</option>
                        @endforeach
                    </select>
                    
                    
                  </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label" style="color: #000;">Name</label>
                    <input type="text" class="form-control" name="name" style="color: #000;" placeholder="Name">
  
                    
                  </div>

                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label" style="color: #000;">Year</label>
                    <input type="number" class="form-control" name="points"  style="color: #000;" >
  
                    
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

