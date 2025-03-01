<!-- Add the sidebar's background. This div must be placed Immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>

<!-- jQuery 2.1.4 -->
<script src="<?php echo e(asset('admin_assets/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/plugins/jQueryUI/jquery-ui.min.js')); ?>"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo e(asset('js/angular.js')); ?>"></script>
<script src="<?php echo e(asset('js/angular-sanitize.js')); ?>"></script>

<script> 
	var app = angular.module('App', ['ngSanitize']);
	var APP_URL = <?php echo json_encode(url('/')); ?>; 
	var COMPANY_ADMIN_URL = <?php echo json_encode(url('/'.LOGIN_USER_TYPE)); ?>; 
	var LOGIN_USER_TYPE = '<?php echo LOGIN_USER_TYPE; ?>';
	var popup_code  = <?php echo session('error_code') ? session('error_code') : 0; ?>;
	var STRIPE_PUBLISH_KEY = "<?php echo e(payment_gateway('publish','Stripe')); ?>";
</script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap 3.3.5 -->
<script src="<?php echo e(asset('admin_assets/bootstrap/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/dist/js/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
<?php if(!isset($exception)): ?>   
	<?php if(Route::current()->uri() == 'admin/dashboard' || Route::current()->uri() == 'company/dashboard'): ?>
		<!-- Morris.js charts -->
		<script src="<?php echo e(asset('admin_assets/plugins/morris/raphael-min.js')); ?>"></script>
		<script src="<?php echo e(asset('admin_assets/plugins/morris/morris.min.js')); ?>"></script>
		<!-- datepicker -->

		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="<?php echo e(asset('admin_assets/dist/js/dashboard.js')); ?>"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/add_user' || Route::current()->uri() == 'admin/edit_user/{id}'): ?>
		<script src="<?php echo e(asset('admin_assets/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/add_coupon_code' || Route::current()->uri() == 'admin/edit_coupon_code/{id}'): ?>
		<script src="<?php echo e(asset('admin_assets/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/driver' || Route::current()->uri() == 'admin/vehicle' || Route::current()->uri() == 'company/vehicle' || Route::current()->uri() == 'admin/rider' || Route::current()->uri() == 'admin/admin_user' || Route::current()->uri() == 'admin/vehicle_type'|| Route::current()->uri() == 'admin/rating' || Route::current()->uri() == 'company/rating' ||  Route::current()->uri() == 'admin/request' ||  Route::current()->uri() == 'company/request' ||  Route::current()->uri() == 'admin/cancel_trips' ||  Route::current()->uri() == 'company/cancel_trips' ||  Route::current()->uri() == 'admin/trips' ||  Route::current()->uri() == 'company/trips' ||  Route::current()->uri() == 'admin/payments' ||  Route::current()->uri() == 'company/payments'|| Route::current()->uri() == 'admin/pages' || Route::current()->uri() == 'admin/metas' || Route::current()->uri() == 'admin/promo_code' || Route::current()->uri() == 'admin/statements/{type}' || Route::current()->uri() == 'company/statements/{type}' || Route::current()->uri() == 'admin/view_driver_statement/{driver_id}' || Route::current()->uri() == 'company/view_driver_statement/{driver_id}' || Route::current()->uri() == 'admin/currency' || Route::current()->uri() == 'admin/locations' || Route::current()->uri() == 'admin/roles' || Route::current()->uri() == 'admin/manage_fare' || Route::current()->uri() == 'admin/language' || Route::current()->uri() == 'admin/help_category' || Route::current()->uri() == 'admin/help_subcategory' || Route::current()->uri() == 'admin/help' || Route::current()->uri() == 'admin/country' || Route::current()->uri() == 'admin/payout/overall' || Route::current()->uri() == 'company/payout/overall' || Route::current()->uri() == 'admin/payout/company/overall' || Route::current()->uri() == 'admin/weekly_payout/{driver_id}' || Route::current()->uri() == 'company/weekly_payout/{driver_id}' || Route::current()->uri() == 'admin/weekly_payout/company/{company_id}' || Route::current()->uri() == 'admin/per_week_report/{driver_id}/{start_date}/{end_date}' || Route::current()->uri() == 'company/per_week_report/{driver_id}/{start_date}/{end_date}' || Route::current()->uri() == 'admin/per_week_report/company/{company_id}/{start_date}/{end_date}' || Route::current()->uri() == 'admin/per_day_report/{driver_id}/{date}' || Route::current()->uri() == 'company/per_day_report/{driver_id}/{date}' || Route::current()->uri() == 'admin/per_day_report/company/{company_id}/{date}' || Route::current()->uri() == 'admin/later_booking' || Route::current()->uri() == 'company/later_booking' || Route::current()->uri() == 'admin/company' || Route::current()->uri() == 'company/driver' || Route::current()->uri() == 'admin/cancel-reason' || Route::current()->uri() == 'admin/vehicle_make' || Route::current()->uri() == 'admin/vehicle_model' || Route::current()->uri() == 'admin/documents' || Route::current()->uri() == 'admin/support'|| Route::current()->uri() == 'admin/mobile_app_version'): ?>
		<script src="<?php echo e(url('admin_assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
		<script src="<?php echo e(url('admin_assets/plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/add_room' || Route::current()->uri() == 'admin/edit_room/{id}' || Route::current()->uri() == 'admin/edit_rider/{id}' || Route::current()->uri() == 'admin/add_rider' || Route::current()->uri() == 'admin/edit_page/{id}' || Route::current()->uri() == 'admin/add_page/{id}' || Route::current()->uri() == 'admin/later_booking' || Route::current()->uri() == 'company/later_booking' || Route::current()->uri() == 'admin/add_company' || Route::current()->uri() == 'admin/edit_company/{id}' || Route::current()->uri() == 'admin/company' || Route::current()->uri() == 'company/edit_company/{id}'): ?>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($map_key); ?>&sensor=false&libraries=places"></script>
		<script src="<?php echo e(url('admin_assets/plugins/jQuery/jquery.validate.js')); ?>"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/add_vehicle' || Route::current()->uri() == 'admin/edit_vehicle/{id}' || Route::current()->uri() == 'company/add_vehicle' || Route::current()->uri() == 'company/edit_vehicle/{id}' || Route::current()->uri() == 'admin/add-vehicle-make' || Route::current()->uri() == 'admin/edit-vehicle-make/{id}'): ?>
		<script src="<?php echo e(url('admin_assets/plugins/jQuery/jquery.validate.js')); ?>"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/trips' || Route::current()->uri() == 'admin/payments'): ?>
		<script src="<?php echo e(url('admin_assets/dist/js/reports.js')); ?>"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/add_page' || Route::current()->uri() == 'admin/edit_page/{id}' || Route::current()->uri() == 'admin/send_email' || Route::current()->uri() == 'admin/add_help' || Route::current()->uri() == 'admin/edit_help/{id}'): ?>
		<script src="<?php echo e(url('admin_assets/plugins/editor/editor.js')); ?>"></script>
		<script type="text/javascript"> 
			$("[name='submit']").click(function(){
				$('#content').text($('#txtEditor').Editor("getText"));
				$('#message').text($('#txtEditor').Editor("getText"));
				$('#answer').text($('#txtEditor').Editor("getText"));
			});
		</script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/map' || Route::current()->uri() == 'company/map' || Route::current()->uri() == 'admin/detail_request/{id}' || Route::current()->uri() == 'company/detail_request/{id}'): ?>
		<script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($map_key); ?>&sensor=false&callback=initMap&libraries=geometry"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/heat-map' || Route::current()->uri() == 'company/heat-map'): ?>
		<script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($map_key); ?>&libraries=visualization"></script>
		<script src="<?php echo e(url('admin_assets/dist/js/heat_map.js')); ?>"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/map' || Route::current()->uri() == 'company/map'): ?>
		<script src="<?php echo e(url('admin_assets/dist/js/map.js')); ?>"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/manual_booking/{id?}' || Route::current()->uri() == 'company/manual_booking/{id?}'): ?>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($map_key); ?>&sensor=false&libraries=places"></script>
		<script src="<?php echo e(url('admin_assets/dist/js/manual_booking.js')); ?>"></script>
		<script src="<?php echo e(url('admin_assets/dist/js/moment.min.js')); ?>"></script>
		<script src="<?php echo e(url('admin_assets/dist/js/bootstrap-datetimepicker.min.js')); ?>"></script>
		<script src="<?php echo e(url('js/selectize.js')); ?>"></script>
		<script src="<?php echo e(url('admin_assets/plugins/jQuery/jquery.validate.js')); ?>"></script>
		<script src="<?php echo e(url('admin_assets/dist/js/jquery.multiselect.js')); ?>"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/detail_request/{id}' || Route::current()->uri() == 'company/detail_request/{id}'): ?>
		<script src="<?php echo e(url('admin_assets/dist/js/request.js?v='.$version)); ?>"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/add_location' || Route::current()->uri() == 'admin/edit_location/{id}'): ?>
		<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($map_key); ?>&libraries=drawing,places,geometry"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/add_manage_fare' || Route::current()->uri() == 'admin/edit_manage_fare/{id}' || Route::current()->uri() == 'admin/add_company' || Route::current()->uri() == 'admin/edit_company/{id}' || Route::current()->uri() == 'company/edit_company/{id}'): ?>
		<script src="<?php echo e(url('admin_assets/dist/js/moment.min.js')); ?>"></script>
	<?php endif; ?>

	<?php if(Route::current()->uri() == 'admin/referral_settings'): ?>
		<script src="<?php echo e(url('admin_assets/bootstrap/js/bootstrap-toggle.min.js')); ?>"></script>
	<?php endif; ?>

<?php endif; ?>

<!-- AdminLTE App -->
<script src="<?php echo e(url('admin_assets/dist/js/demo.js')); ?>"></script>
<script src="<?php echo e(url('admin_assets/dist/js/app.js')); ?>"></script>
<script src="<?php echo e(url('admin_assets/dist/js/common.js?v='.$version)); ?>"></script>
<?php if(Route::current()->uri() == 'company/payout_preferences'): ?>
	<?php echo Html::script('js/common.js?v='.$version); ?>

<?php endif; ?>

<?php echo $__env->yieldPushContent('scripts'); ?>

<script type="text/javascript">
  $(document).ready(function() {
    if(popup_code == 1) {
      $('#payout_popup').modal('show');
    }
  });
</script>


<script type="text/javascript">


	function preventBack()
	{
		previous_url = document.referrer.substr(document.referrer.lastIndexOf('/') + 1)
		if (previous_url == "signin" || previous_url == "" || previous_url == "signin_company") {
			window.history.forward();
		}
	}
	setTimeout("preventBack()", 0);

</script>
<!-- get in tuch pop_up_email -->

<?php if(CheckGetInTuchpopup()): ?>
  <script src="<?php echo e(asset('admin_assets/plugins/jQuery/jquery.validate.js')); ?>"></script>
  <?php echo Html::script('js/pop_up_email.js?v='.$version); ?>

  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
  </script>
<?php endif; ?>


<!-- get in tuch pop_up_email -->
<?php if(CheckGetInTuchpopup()): ?>
  <?php echo $__env->make('popup_email', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if(env('Live_Chat') == "true"): ?>
<script>
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/57223b859f07e97d0da57cae/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
  })();
</script>
<?php endif; ?>

</body>
</html>
<?php /**PATH C:\laragon\www\ridein25\resources\views/admin/common/foot.blade.php ENDPATH**/ ?>