@extends('admin.template')

@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="company_management" ng-init="login_user_type = '{{ LOGIN_USER_TYPE }}'; company_doc=''; errors = {{ json_encode($errors->getMessages()) }};">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ __('messages.admin.manage_company_page.add_company') }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('messages.admin.home') }}</a></li>
      <li><a href="{{ url(LOGIN_USER_TYPE.'/company') }}">{{ __('messages.admin.manage_company_page.companies') }}</a></li>
      <li class="active">{{ __('messages.admin.add') }}</li>
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
            <h3 class="box-title">{{ __('messages.admin.manage_company_page.add_company_form') }}</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          {!! Form::open(['url'=>'admin/add_company', 'class'=>'form-horizontal', 'files'=>true, 'id'=>'company_form']) !!}
          <div class="box-body">
            <span class="text-danger">(*){{ __('messages.admin.fields_are_mandatory') }}</span>
            <div class="form-group">
              <label for="input_name" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.name') }} <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'input_name', 'placeholder' => 'Name']) !!}
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_vat_number" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.vat_number') }}</label>
              <div class="col-md-7 col-sm-offset-1">
                {!! Form::text('vat_number', '', ['class' => 'form-control', 'id' => 'input_vat_number', 'placeholder' => 'VAT Number']) !!}
                <span class="text-danger">{{ $errors->first('vat_number') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_email" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.email') }} <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                {!! Form::text('email', '', ['class' => 'form-control', 'id' => 'input_email', 'placeholder' => 'Email']) !!}
                <span class="text-danger">{{ $errors->first('email') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_password" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.password') }} <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                {!! Form::text('password', '', ['class' => 'form-control', 'id' => 'input_password', 'placeholder' => 'Password']) !!}
                <span class="text-danger">{{ $errors->first('password') }}</span>
              </div>
            </div>

            {!! Form::hidden('user_type','Company', ['class' => 'form-control', 'id' => 'user_type', 'placeholder' => 'Select']) !!}
            <div class="form-group">
              <label for="input_country_code" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.country_code') }}<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
               
                {!! Form::select('country_code', $country_code_option, '', ['class' => 'form-control', 'id' => 'input_country_code', 'placeholder' => 'Select']) !!}

                <span class="text-danger">{{ $errors->first('country_code') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.mobile_number') }} <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                {!! Form::text('mobile_number', '', ['class' => 'form-control', 'id' => 'mobile_number', 'placeholder' => 'Mobile Number']) !!}
                <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
              </div>
            </div> 

            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.status') }} <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                {!! Form::select('status', array('Active' => 'Active', 'Inactive' => 'Inactive', 'Pending' => 'Pending'), '', ['class' => 'form-control', 'id' => 'input_status', 'placeholder' => 'Select']) !!}
                <span class="text-danger">{{ $errors->first('status') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.address_line') }} <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                {!! Form::text('address_line','', ['class' => 'form-control', 'id' => 'address_line', 'placeholder' => 'Address Line']) !!}
                <span class="text-danger">{{ $errors->first('address_line') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.city') }} </label>
              <div class="col-md-7 col-sm-offset-1">
                {!! Form::text('city','', ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'City']) !!}
                <span class="text-danger">{{ $errors->first('city') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.state') }}</label>
              <div class="col-md-7 col-sm-offset-1">
                {!! Form::text('state','', ['class' => 'form-control', 'id' => 'state', 'placeholder' => 'State']) !!}
                <span class="text-danger">{{ $errors->first('state') }}</span>
              </div>
            </div> 

            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.postal_code') }} <em class="text-danger">*</em> </label>
              <div class="col-md-7 col-sm-offset-1">

                {!! Form::text('postal_code','', ['class' => 'form-control', 'id' => 'postal_code', 'placeholder' => 'Postal Code']) !!}
                <span class="text-danger">{{ $errors->first('postal_code') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_profile" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.profile') }}</label>
              <div class="col-md-7 col-sm-offset-1">
                {!! Form::file('profile', ['class' => 'form-control', 'id' => 'input_profile', 'accept' => 'image/*']) !!}
                <span class="text-danger">{{ $errors->first('profile') }}</span>
              </div>
            </div>

            <div class="col-sm-12">
              <label class="col-sm-3"></label>
              <div class="loading d-none" id="company_loading"></div>
            </div>

            <div ng-repeat="doc in company_doc" ng-cloak ng-if="company_doc">
              <div class="form-group">
              <label class="col-sm-3 control-label">@{{doc.document_name}} <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="file" name="file_@{{doc.id}}" class="form-control">
                <span class="text-danger">@{{ errors['file_'+doc.id][0] }}</span>
              </div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label" ng-if="doc.expiry_required=='1'">Expire Date <em class="text-danger">*</em></label>
            <div class="col-md-7 col-sm-offset-1" ng-if="doc.expiry_required=='1'">
              <input type="text" min="{{ date('Y-m-d') }}" name="expired_date_@{{doc.id}}" class="form-control document_expired" placeholder="Expire date" autocomplete="off">
              <span class="text-danger">@{{ errors['expired_date_'+doc.id][0] }}</span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"> @{{doc.document_name}} Status<em class="text-danger">*</em></label>
            <div class="col-md-7 col-sm-offset-1">
              <select class ='form-control' name='@{{doc.doc_name}}_status'>
                <option value="0" ng-selected="doc.status==0">Pending</option>
                <option value="1" ng-selected="doc.status==1">Approved</option>
                <option value="2" ng-selected="doc.status==2">Rejected</option>
              </select>
            </div>
          </div>

          </div>

          <div class="form-group">
            <label for="input_service_fee" class="col-sm-3 control-label">{{ __('messages.admin.manage_company_page.form.company_commission') }}<em class="text-danger">*</em></label>
            <div class="col-md-7 col-sm-offset-1">
              <div class="input-group"> 
                {!! Form::text('company_commission', 0, ['class' => 'form-control', 'id' => 'input_service_fee', 'placeholder' => 'Company Commission']) !!}
                <div class="input-group-addon" style="background-color:#eee;">%</div>
                <span class="text-danger">{{ $errors->first('company_commission') }}</span>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <button type="submit" class="btn btn-info" name="submit" value="submit">{{ __('messages.admin.submit') }}</button>
            <a href="{{url(LOGIN_USER_TYPE.'/company')}}"><span class="btn btn-default">{{ __('messages.admin.cancel') }}</span></a>
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
  var datepicker_format = 'dd-mm-yy';
  $('#license_exp_date').datepicker({ 'dateFormat': datepicker_format, maxDate: new Date()});
  $(function () {
    $("#yearDate").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '1950:' + new Date().getFullYear().toString(),
      dateFormat: datepicker_format,
    });
    $('.ui-datepicker').addClass('notranslate');
  });
  $('#insurance_exp_date').datepicker({ 'dateFormat': datepicker_format, maxDate: new Date()});
  $(function () {
    $("#yearDate").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '1950:' + new Date().getFullYear().toString(),
      dateFormat: datepicker_format,
    });
    $('.ui-datepicker').addClass('notranslate');
  });
</script>
@endpush
