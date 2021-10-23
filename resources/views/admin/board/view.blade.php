@extends('layouts.admin')

@section('content')

@php
    $upper = strtoupper($boards->subjects->class);

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
                         {{$boards->id}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{$boards->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Slug
                        </th>
                        <td>
                            {{$boards->slug}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Year
                        </th>
                        <td>
                            {{$boards->year}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Subject
                        </th>
                        <td>
                            {{$boards->subjects->name}}
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
                    <tr>
                        <th>
                          Subject Slug
                        </th>
                        <td>
                            {{$boards->subjects->slug}}
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
