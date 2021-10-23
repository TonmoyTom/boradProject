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
                         {{$answer->id}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Qustion
                        </th>
                        <td>
                            {{$answer->qustions->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Answer
                        </th>
                        <td>
                            {{$answer->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Subject
                        </th>
                        <td>
                            {{$answer->qustions->boards->subjects->name}}
                        </td>
                    </tr>

                    <tr>
                        <th>
                          Right
                        </th>
                        <td>

                            @if ($answer->points == 1)
                                Correct
                            @else
                                InCorrect
                            @endif
                           
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
