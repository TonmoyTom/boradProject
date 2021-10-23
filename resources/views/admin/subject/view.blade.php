@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
       Background Detalis
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-success" href="{{ route('admin.home') }}">
                   Dashboard
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Id
                        </th>
                        <td>
                         {{$subject->id}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{$subject->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Slug
                        </th>
                        <td>
                            {{$subject->slug}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          BackGround
                        </th>
                        <td>
                            {{$subject->class}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          BackGround
                        </th>
                        <td>
                            {{$subject->backgrounds->name}}
                        </td>
                    </tr>

                    
                </tbody>
            </table>
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
        </div>
    </div>
</div>
@endsection
