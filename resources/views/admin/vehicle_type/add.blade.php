@extends('admin.template')
@section('main')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			{{ __('messages.admin.manage_vehicle_type.add_vehicle_type') }}
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('messages.admin.home') }}</a></li>
			<li><a href="{{ url(LOGIN_USER_TYPE.'/vehicle_type') }}">	{{ __('messages.admin.manage_vehicle_type.title') }} </a></li>
			<li class="active">{{ __('messages.admin.add') }}</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">{{ __('messages.admin.manage_vehicle_type.form_title') }}</h3>
					</div>
					{!! Form::open(['url' => 'admin/add_vehicle_type', 'class' => 'form-horizontal','files' => true]) !!}
					<div class="box-body">
						<span class="text-danger">(*){{ __('messages.admin.fields_are_mandatory') }}</span>
						<div class="form-group">
							<label for="input_name" class="col-sm-3 control-label">{{ __('messages.admin.manage_vehicle_type.form.vehicle_name') }}<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								{!! Form::text('vehicle_name','', ['class' => 'form-control', 'id' => 'input_name', 'placeholder' => 'Name']) !!}
								<span class="text-danger">{{ $errors->first('vehicle_name') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_description" class="col-sm-3 control-label">{{ __('messages.admin.manage_vehicle_type.form.description') }}</label>
							<div class="col-md-7 col-sm-offset-1">
								{!! Form::textarea('description','', ['class' => 'form-control', 'id' => 'input_description', 'placeholder' => 'Description', 'rows' => 3]) !!}
								<span class="text-danger">{{ $errors->first('description') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_vehicle_back" class="col-sm-3 control-label">{{ __('messages.admin.manage_vehicle_type.form.vehicle_image') }}<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								{!! Form::file('vehicle_image', ['class' => 'form-control', 'id' => 'input_vehicle_back', 'accept' => 'image/*']) !!}
								<span class="text-danger">{{ $errors->first('vehicle_image') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_active_image" class="col-sm-3 control-label">{{ __('messages.admin.manage_vehicle_type.form.vehicle_active_image') }}<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								{!! Form::file('active_image', ['class' => 'form-control', 'id' => 'input_active_image', 'accept' => 'image/*']) !!}
								<span class="text-danger">{{ $errors->first('active_image') }}</span>
							</div>
						</div>

						<div class="form-group">
							<label for="input_active_image" class="col-sm-3 control-label">{{ __('messages.admin.manage_vehicle_type.form.vehicle_app_icon') }}<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								{!! Form::file('app_image', ['class' => 'form-control', 'id' => 'input_app_image', 'accept' => 'image/*']) !!}
								<span class="text-danger">{{ $errors->first('app_image') }}</span>
							</div>
						</div>
						
						<div class="form-group">
							<label for="input_pool" class="col-sm-3 control-label"> {{ __('messages.admin.manage_vehicle_type.form.is_pool') }} <em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								{!! Form::select('is_pool', array('No' => 'No', 'Yes' => 'Yes'),'', ['class' => 'form-control', 'id' => 'input_pool']) !!}
								<span class="text-danger">{{ $errors->first('is_pool') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">{{ __('messages.admin.manage_vehicle_type.form.status') }}<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								{!! Form::select('status', array('Active' => 'Active', 'Inactive' => 'Inactive'),'', ['class' => 'form-control', 'id' => 'input_status', 'placeholder' =>  __('messages.admin.manage_vehicle_type.form.status')]) !!}
								<span class="text-danger">{{ $errors->first('status') }}</span>
							</div>
						</div>
					</div>
					<div class="box-footer text-center">
						<button type="submit" class="btn btn-info" name="submit" value="submit">{{ __('messages.admin.submit') }}</button>
						<button type="submit" class="btn btn-default" name="cancel" value="cancel">{{ __('messages.admin.cancel') }}</button>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
