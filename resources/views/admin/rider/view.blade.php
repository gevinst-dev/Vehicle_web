@extends('admin.template')

@section('main')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('messages.admin.manage_riders_page.title')}}
        <small>    {{__('messages.admin.control_panel')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i>     {{__('messages.admin.home')}}</a></li>
        <li class="active">    {{__('messages.admin.manage_riders_page.riders')}}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Manage Riders</h3> -->
              @if(Auth::guard('admin')->user()->can('create_rider'))
                <div style="float:right;"><a class="btn btn-success" href="{{ url('admin/add_rider') }}">{{__('messages.admin.manage_riders_page.add_rider')}}</a></div>
              @endif
            </div>
            <!-- /.box-header -->
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
