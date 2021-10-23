@extends('layouts.admin')

@section('content')

@php
    $upper = strtoupper($qustions->subjects->class);

@endphp
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
                         {{$qustions->id}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{$qustions->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Slug
                        </th>
                        <td>
                            {{$qustions->slug}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Board
                        </th>
                        <td>
                            {{$qustions->boards->year}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Subject
                        </th>
                        <td>
                            {{$qustions->subjects->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Class
                        </th>
                        <td>
                            {{ $upper}}
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
