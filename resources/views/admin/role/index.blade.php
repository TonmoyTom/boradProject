@extends('layouts.admin')
@section('content')


<div class="card">
    <div class="card-header">
      User List
    </div>

    <div style="margin-bottom: 10px;margin-top: 10px;" class="row">
        <div class="col-lg-8">
            <a class="btn btn-success" href="{{ route("role.create") }}">
              Add Role
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="order-listing" >
                <thead>
                    <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Name</th>
                      <th width="50%" scope="col-2">Permissions</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
      
                  <tbody>
                      @foreach ($roles as $item)
                        <tr>
                          <th scope="row">{{$loop->index*1}}</th>
                          <td>{{$item->name}}</td>
                          <td>
                           
                            @foreach($item->permissions as $parm)
                            <span class="badge badge-primary">{{$parm->name}}</span>
                            @endforeach
                          </td>
                          <td>
                            @if(Auth::user()->can('role.edit'))
                            <a class="btn btn-xs btn-info" href="{{url('admin/roles/edit/'.Crypt::encrypt($item->id))}} ">
                                Edit
                            </a>
                            @else
                            <p>Not Acess</p>
                            @endif
                            @if(Auth::user()->can('role.delete'))  
                            <form action="{{url('admin/roles/delete/'.Crypt::encrypt($item->id))}}" method="POST" style="display: inline-block;">
                                @csrf
                                    <button type="submit" id="delete" data-name="{{($item->name)}}" class="btn btn-danger delete-confirm"> 
                                    <i class="fas fa-trash-alt btn-icon-prepend"></i>
                                    Delete
                                    </button>  
                            </form>
                            @else
                            <p>Not Acess</p>
                            @endif


                        </td>
                        </tr>
                      @endforeach
                   
                  
                  </tbody>
            </table>

           
        </div>
        
    </div>
    <div class="form-group">
            
        <a class="btn btn-info" href="{{ route('admin.home') }}">
           Back
        </a>
    </div>
</div>



@endsection
{{-- @section('scripts')
@parent --}}
{{-- <script>
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('category_delete')
        let deleteButtonTrans = '{{ trans('
        global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.categories.massDestroy') }}",
            className: 'btn-danger',
            action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('Row Not Seleted')

                    return
                }

                if (confirm('Are Your Sure!')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            },
                            method: 'POST',
                            url: config.url,
                            data: {
                                ids: ids,
                                _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            order: [
                [1, 'desc']
            ],
            pageLength: 100,
        });
        $('.datatable-users:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
</script> --}}
{{-- @endsection --}}