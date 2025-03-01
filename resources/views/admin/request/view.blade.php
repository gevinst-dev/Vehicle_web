@extends('admin.template')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{__('messages.admin.manage_trips.manage_ride_requests')}}
        <small>{{ __('messages.admin.control_panel')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('messages.admin.home')}}</a></li>
            <li class="active">        {{__('messages.admin.manage_trips.ride_requests')}} </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="height: 54px;">
                        <!-- <h3 class="box-title"> Manage Ride Requests </h3> -->
                    </div>
                    <div class="box-body">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
    <link rel="stylesheet" href="{{ url('css/buttons.dataTables.css') }}">
    <script src="{{ url('js/dataTables.buttons.js') }}"></script>
    <script src="{{ url('js/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush