@extends('layouts.admin')
@section('content')

  <div class="card">
    <div class="card-header">
     Role Edit
    </div>

    <div class="card-body">
        <form method="POST" action="{{url('admin/roles/edit/'.Crypt::encrypt($roles->id))}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">Role Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="title" value="{{ $roles->name }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group form-check" style= padding-left:20px;>
                <input type="checkbox" class="form-check-input"  id="checkPermissionAll" value="" {{App\User::roleHasPermissions($roles, $permission) ? 'checked' : '' }} >
                <label class="form-check-label" for="checkPermissionAll" style="color: #000; ">All</label>
            </div>
            <hr>
            @php $i = 1; @endphp
            @foreach ($premission_groups as $groups)

            @php
            
            $permissions = App\User::getpermissionsByGroupName($groups->name);
       
            $j = 1;
            @endphp 
            <div class="row "style="padding-left:20px;">
                <div class="col-lg-3">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $groups->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                        <label class="form-check-label" for="checkPermission" style="color: #000;">{{ $groups->name }}</label>
                      </div>
                </div>
                <div class="col-lg-3 role-{{ $i }}-management-checkbox">
                   
                    @foreach ($permissions as $item)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="permissions[]"  {{$roles->hasPermissionTo($item->name) ? 'checked': ''}} id="checkPermission{{ $item->id }}" value="{{ $item->name }}"
                        onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management',
                         {{ count($permissions) }})" >
                        <label class="form-check-label" for="checkPermission{{ $item->id }}" style="color: #000;">{{ $item->name }}</label>
                    </div>
                      @php  $j++; @endphp
                    @endforeach
                </div>
            </div>
            @php  $i++; @endphp
            <br>
            <hr>
            @endforeach
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





