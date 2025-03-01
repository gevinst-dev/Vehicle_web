@extends('admin.template')

@section('main')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('messages.admin.manage_wallet_and_promo.add_promo_code') }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('messages.admin.home') }}</a></li>
        <li><a href="{{ url(LOGIN_USER_TYPE.'/promo_code') }}">        {{ __('messages.admin.manage_wallet_and_promo.promo_code') }}</a></li>
        <li class="active">Add</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">        {{ __('messages.admin.manage_wallet_and_promo.add_promo_code_form') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['url' => 'admin/add_promo_code', 'class' => 'form-horizontal']) !!}
              <div class="box-body">
              <span class="text-danger">(*){{ __('messages.admin.fields_are_mandatory') }}</span>
                <div class="form-group">
                  <label for="input_promo_code" class="col-sm-3 control-label">{{ __('messages.admin.manage_wallet_and_promo.form.promo_code') }}<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    {!! Form::text('code', '', ['class' => 'form-control', 'id' => 'input_promo_code', 'placeholder' => {{ __('messages.admin.manage_wallet_and_promo.form.promo_code') }}]) !!}
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="input_amount" class="col-sm-3 control-label">{{ __('messages.admin.manage_wallet_and_promo.form.amount') }}<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    {!! Form::text('amount', '', ['class' => 'form-control', 'id' => 'input_amount', 'placeholder' => {{ __('messages.admin.manage_wallet_and_promo.form.amount') }}]) !!}
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="input_currency_code" class="col-sm-3 control-label">{{ __('messages.admin.manage_wallet_and_promo.form.currency_code') }}</label>
                  <div class="col-md-7 col-sm-offset-1">
                    {!! Form::select('currency_code',$currency, '', ['class' => 'form-control', 'id' => 'input_currency_code', 'placeholder' => 'Select']) !!}
                    <span class="text-danger">{{ $errors->first('currency_code') }}</span>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="input_expired_at" class="col-sm-3 control-label">{{ __('messages.admin.manage_wallet_and_promo.form.expire_date') }}<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    {!! Form::text('expire_date', '', ['class' => 'form-control', 'id' => 'input_expired_at', 'placeholder' => {{ __('messages.admin.manage_wallet_and_promo.form.expire_date') }}, 'autocomplete' => 'off']) !!}
                    <span class="text-danger">{{ $errors->first('expire_date') }}</span>
                  </div>
                </div>
               <div class="form-group">
                  <label for="input_status" class="col-sm-3 control-label">{{ __('messages.admin.manage_wallet_and_promo.form.status') }}<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    {!! Form::select('status', array('Active' => 'Active', 'Inactive' => 'Inactive'), '', ['class' => 'form-control', 'id' => 'input_status', 'placeholder' => 'Select']) !!}
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
               <button type="submit" class="btn btn-info" name="submit" value="submit">{{ __('messages.admin.submit') }}</button>
                 <button type="submit" class="btn btn-default" name="cancel" value="cancel">{{ __('messages.admin.cancel') }}</button>
              </div>
              <!-- /.box-footer -->
            {!! Form::close() !!}
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
  @push('scripts')
    <script>
    $('#input_expired_at').datepicker({ startDate: "today",autoclose: true});
    </script>
  @endpush