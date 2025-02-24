@extends('admin.template')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{__('messages.admin.manage_emails_page.send_email')}}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i>       {{__('messages.admin.home')}}</a></li>
      <li class="active">      {{__('messages.admin.manage_emails_page.send_email')}}</li>
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
            <h3 class="box-title">      {{__('messages.admin.manage_emails_page.send_email_form')}}</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          {!! Form::open(['url' => 'admin/send_email', 'class' => 'form-horizontal']) !!}
          <div class="box-body">
            <span class="text-danger">(*)      {{__('messages.admin.fields_are_mandatory')}}</span>
            <div class="form-group">
              <label class="col-sm-3 control-label">      {{__('messages.admin.manage_emails_page.form.email_to')}}<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
              <div class="col-sm-4">
                <input type="radio" name="to" value="to_all" class="send_to">
                {{__('messages.admin.manage_send_message_page.all')}}
              </div>
              <div class="col-sm-8">
                <input type="radio" name="to" value="to_specific" class="send_to" checked>
                {{__('messages.admin.manage_send_message_page.specific_users')}}
              </div>
            </div>
            </div>
            <div class="form-group" id="email_textbox">
              <label for="input_email" class="col-sm-3 control-label">{{__('messages.admin.manage_emails_page.form.email_address')}}<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                {!! Form::text('email', '', ['class' => 'form-control', 'id' => 'input_email', 'placeholder' => 'Enter Email Addresses of Users']) !!}
                <span class="text-danger">{{ $errors->first('email') }}</span>
                <input type="hidden" id="email_address_list" value="{{ $email_address_list }}">
                <span class="small"> {{__('messages.admin.manage_emails_page.notes')}} </span>
              </div>
            </div>
            <div class="form-group">
              <label for="input_subject" class="col-sm-3 control-label">{{__('messages.admin.manage_emails_page.form.subject')}}<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                {!! Form::text('subject', '', ['class' => 'form-control', 'id' => 'input_subject', 'placeholder' => 'Subject']) !!}
                <span class="text-danger">{{ $errors->first('subject') }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="input_message" class="col-sm-3 control-label">{{__('messages.admin.manage_emails_page.form.message')}}<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <textarea id="txtEditor" name="txtEditor"></textarea>
                <textarea id="message" name="message" hidden="true">{{ old('message') }}</textarea>
                <span class="text-danger">{{ $errors->first('message') }}</span>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <button type="submit" class="btn btn-info" name="submit" value="submit">{{__('messages.admin.submit')}}</button>
            <a href="{{url('admin/send_email')}}" class="btn btn-default">{{__('messages.admin.cancel')}}</a>
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
@stop
@push('scripts')
<script type="text/javascript">
  $("#txtEditor").Editor(); 
  $('.Editor-editor').html($('#message').val());

  $('.send_to').click(function(){
    if($(this).val() == 'to_specific')
      $('#email_textbox').show();
    else
      $('#email_textbox').hide();
  });

  var email_address = $('#email_address_list').val();
  email_address = $.parseJSON(email_address)
  function split( val ) {
    return val.split( /,\s*/ );
  }

  function extractLast( term ) {
    return split( term ).pop();
  }

  // don't navigate away from the field on tab when selecting an item
  $("#input_email").bind( "keydown", function( event ) {
    if(event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active) {
      event.preventDefault();
    }
  }).autocomplete({
      minLength: 0,
      source: function( request, response ) {
        // delegate back to autocomplete, but extract the last term
        response( $.ui.autocomplete.filter(
          email_address, extractLast( request.term ) ) );
      },
      focus: function() {
        // prevent value inserted on focus
        return false;
      },
      select: function( event, ui ) {
        var terms = split( this.value );
        // remove the current input
        terms.pop();
        // add the selected item
        terms.push( ui.item.value );
        // add placeholder to get the comma-and-space at the end
        terms.push( "" );
        this.value = terms.join( ", " );
        return false;
      }
    });
</script>
@endpush