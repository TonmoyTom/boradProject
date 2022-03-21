@extends('layouts.admin')
@section('content')




<div class="card">
    <div class="card-header">
      Subject List
    </div>

    <div style="margin-bottom: 10px;margin-top: 10px;" class="row">
        <div class="col-lg-8">
            <a class="btn btn-success" href="{{ route("boards.create") }}">
              Add Boards
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="order-listing" >
                <thead>
                    <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Background</th>
                      <th scope="col">Name</th>
                      <th scope="col" >Subject</th>
                      <th scope="col" >Class</th>
                      <th scope="col" >Year</th>
                      <th scope="col" >Status</th>
                      <th scope="col" >Approve</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                      @foreach ($qustions as $item)


                        <tr>
                          <th scope="row">{{$loop->index*1}}</th>
                          <td>{{$item->subjects->backgrounds->name}}</td>
                          <td>{{$item->name}}</td>
                          <td>{{$item->subjects->slug}}</td>
                          <td>{{strtoupper($item->subjects->class)}}</td>
                          <td>{{$item->boards->year}}</td>
                          <td>
                            @if($item->status == 1)
                            <a href="javascript:void(0)" class="updatesqustionsstatus" id="qustions-{{$item->id }}"
                                section_id ="{{$item->id}}" ><i class="fas fa-toggle-on toggle" aria-hidden="true" status="Active"></i></a>
                            @else
                            <a  href="javascript:void(0)" class="updatesqustionsstatus" id="qustions-{{$item->id }}"
                                section_id ="{{$item->id}}"><i class="fas fa-toggle-off toggle" aria-hidden="true" status="Deactive"></i></a>
                            @endif
                            </td>

                            <td>
                                @if($item->approve == 1)
                                <a >Approve</a>
                                @else
                                <a>Non-Approve</a>
                                @endif
                            </td>

                            <td>
                            <a class="btn btn-xs btn-primary" href="{{url('admin/qustions/view/'.Crypt::encrypt($item->id))}} ">
                                View
                            </a>

                            <a class="btn btn-xs btn-info" href="{{url('admin/qustions/edit/'.Crypt::encrypt($item->id))}} ">
                                Edit
                            </a>


                            <form action="{{url('admin/qustions/delete/'.Crypt::encrypt($item->id))}}" method="POST" style="display: inline-block;">
                                @csrf
                                    <button type="submit"  data-name="{{($item->slug)}}" class="btn btn-danger delete-confirm">

                                    Delete
                                    </button>
                            </form>



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
