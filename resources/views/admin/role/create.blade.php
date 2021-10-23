@extends('layouts.admin')
@section('content')

  <div class="card">
    <div class="card-header">
     Role Create
    </div>

    <div class="card-body">
        <form method="POST" action="{{route("role.store")}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">Role Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="title" value="{{ old('name', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input"  id="checkPermissionAll" value="" >
                    <label class="form-check-label" for="checkPermissionAll" style="color: #000;">All</label>
                </div>
                <hr>
                @php $i = 1; @endphp
                @foreach ($premission_groups as $groups)
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $groups->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                            <label class="form-check-label" for="checkPermission">{{ $groups->name }}</label>
                          </div>
                    </div>
                    <div class="col-lg-3 role-{{ $i }}-management-checkbox">
                        @php
                        $permissions = App\User::getpermissionsByGroupName($groups->name);
                        $j = 1;
                        @endphp
                        @foreach ($permissions as $item)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $item->id }}" value="{{ $item->name }}">
                            <label class="form-check-label" for="checkPermission{{ $item->id }}">{{ $item->name }}</label>
                        </div>
                          @php  $j++; @endphp
                        @endforeach
                    </div>
                </div>
                @php  $i++; @endphp
                <br>
                <hr>
                @endforeach
                
                
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit" name="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
  </div>
@endsection

@section('scripts')
     <script>
         /**
         * Check all the permissions
         */
         $("#checkPermissionAll").click(function(){
             if($(this).is(':checked')){
                 // check all the checkbox
                 $('input[type=checkbox]').prop('checked', true);
             }else{
                 // un check all the checkbox
                 $('input[type=checkbox]').prop('checked', false);
             }
         });
         function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');
            if(groupIdName.is(':checked')){
                 classCheckBox.prop('checked', true);
             }else{
                 classCheckBox.prop('checked', false);
             }
         }
     </script>
@endsection





