@extends('layouts.admin.master')

@section('page_title') {{ env('APP_NAME') }} | Dashboard @endsection

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Total Users</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $usersCount }}</h1>
                    <small>Total Users</small>
                </div>
            </div>
        </div>
    </div>
@endsection
