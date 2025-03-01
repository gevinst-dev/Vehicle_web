<aside class="main-sidebar">
	<section class="sidebar">
		<a href="<?php echo e(url(LOGIN_USER_TYPE.'/dashboard')); ?>" class="logo">
	      <span class="logo-mini"><b><?php echo e($site_name); ?></b></span>
	      <span class="logo-lg"><b><?php echo e($site_name); ?></b></span>
	    </a>
		<!-- <div class="user-panel">
			<div class="pull-left image">
				<?php
					if(LOGIN_USER_TYPE=='company'){
						$user = Auth::guard('company')->user();
						$company_user = true;
						$first_segment = 'company';
					}
					else{
						$user = Auth::guard('admin')->user();
						$company_user = false;
						$first_segment = 'admin';
					}
				?>
				<?php if(!$company_user || $user->profile ==null): ?>
					<img src="<?php echo e(url('admin_assets/dist/img/avatar04.png')); ?>"  class="img-circle" alt="User Image">
				<?php else: ?>
					<img src="<?php echo e($user->profile); ?>"  class="img-circle" alt="User Image">
				<?php endif; ?>
			</div>
			<div class="pull-left info">
				<p><?php echo e((!$company_user)?$user->username:$user->name); ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div> -->
		<ul class="sidebar-menu">
			<!-- <li class="header">MAIN NAVIGATION</li> -->
			<li class="<?php echo e((Route::current()->uri() == $first_segment.'/dashboard') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/dashboard')); ?>"><i class="fa fa-dashboard"></i><span><?php echo e(__('messages.admin.dashboard')); ?></span></a></li>

			<?php if(@$user->can('manage_admin')): ?>
			<li class="treeview <?php echo e((Route::current()->uri() == 'admin/admin_user' || Route::current()->uri() == 'admin/roles') ? 'active' : ''); ?>">
				<a href="#">
					<i class="fa fa-user-plus"></i> <span><?php echo e(__('messages.admin.manage_admin.title')); ?></span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo e((Route::current()->uri() == 'admin/admin_user') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/admin_user')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('messages.admin.manage_admin.admin_users')); ?></span></a></li>
					<li class="<?php echo e((Route::current()->uri() == 'admin/roles') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/roles')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('messages.admin.manage_admin.role_and_permissions')); ?></span></a></li>
				</ul>
			</li>
			<?php endif; ?>
			<?php if($company_user && $user->id != 1): ?>
			<li class="<?php echo e((Route::current()->uri() == $first_segment.'/payout_preferences') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/payout_preferences')); ?>"><i class="fa fa-paypal"></i><span>Payout Preferences</span></a></li>
			<?php endif; ?>

			<?php if(@$user->can('view_company')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/company') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/company')); ?>"><i class="fa fa-building"></i><span><?php echo e(__('messages.admin.manage_company')); ?></span></a></li>
			<?php endif; ?>
			<?php if($company_user || @$user->can('view_driver')): ?>
			<li class="<?php echo e((Route::current()->uri() == $first_segment.'/driver') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/driver')); ?>"><i class="fa fa-dribbble"></i><span><?php echo e(__('messages.admin.manage_drivers')); ?></span></a></li>
			<?php endif; ?>
			<?php if(@$user->can('view_rider')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/rider') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/rider')); ?>"><i class="fa fa-users"></i><span><?php echo e(__('messages.admin.manage_riders')); ?></span></a></li>
			<?php endif; ?>

			<?php if(@$user->can('view_documents')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/documents') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/documents')); ?>"><i class="fa fa-users"></i><span><?php echo e(__('messages.admin.manage_documents')); ?></span></a></li>
			<?php endif; ?>
			
			<?php if($company_user || @$user->can('manage_send_message')): ?>
			<li class="<?php echo e((Route::current()->uri() == $first_segment.'/send_message') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/send_message')); ?>"><i class="fa fa-bullhorn"></i><span><?php echo e(__('messages.admin.send_messages')); ?></span></a></li>
			<?php endif; ?>
			<?php if(@$user->can('manage_email_settings') || @$user->can('manage_send_email')): ?>
			<li class="treeview <?php echo e((Route::current()->uri() == 'admin/email_settings' || Route::current()->uri() == 'admin/send_email') ? 'active' : ''); ?>">
				<a href="#">
					<i class="fa fa-envelope-o"></i>
					<span><?php echo e(__('messages.admin.manage_emails.title')); ?></span><i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php if(@$user->can('manage_send_email')): ?>
					<li class="<?php echo e((Route::current()->uri() == 'admin/send_email') ? 'active' : ''); ?>">
						<a href="<?php echo e(url('admin/send_email')); ?>"><i class="fa fa-circle-o"></i>
							<span><?php echo e(__('messages.admin.manage_emails.send_mail')); ?></span>
						</a>
					</li>
					<?php endif; ?>
					<?php if(@$user->can('manage_email_settings')): ?>
					<li class="<?php echo e((Route::current()->uri() == 'admin/email_settings') ? 'active' : ''); ?>">
						<a href="<?php echo e(url('admin/email_settings')); ?>"><i class="fa fa-circle-o"></i>
							<span><?php echo e(__('messages.admin.manage_emails.email_settings')); ?></span>
						</a>
					</li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>

			<?php if((($company_user && @$user->status == 'Active') || @$user->can('manage_manual_booking')) || ($company_user || @$user->can('manage_manual_booking'))): ?>
			<li class="treeview <?php echo e((Route::current()->uri() == $first_segment.'/manual_booking/{id?}' || Route::current()->uri() == $first_segment.'/later_booking') ? 'active' : ''); ?>">
				<a href="#">
					<i class="fa fa-taxi"></i>
					<span> <?php echo e(__('messages.admin.manage_manual_booking.title')); ?></span><i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php if(($company_user && @$user->status == 'Active') || @$user->can('manage_manual_booking')): ?>
					<li class="<?php echo e((Route::current()->uri() == $first_segment.'/manual_booking/{id?}') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/manual_booking')); ?>"><i class="fa fa-address-book" aria-hidden="true"></i><span> <?php echo e(__('messages.admin.manage_manual_booking.manual_booking')); ?></span></a></li>
					<?php endif; ?>
					<?php if($company_user || @$user->can('manage_manual_booking')): ?>
					<li class="<?php echo e((Route::current()->uri() == $first_segment.'/later_booking') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/later_booking')); ?>"><i class="fa fa-list-alt"></i><span> <?php echo e(__('messages.admin.manage_manual_booking.view_manual')); ?></span></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>
			<?php if(@$user->can('view_vehicle_make')): ?>
				<li class="<?php echo e((Route::current()->uri() == 'admin/vehicle_make' || Route::current()->uri() == 'admin/add-vehicle-make' || Route::current()->uri() == 'admin/edit-vehicle-make/{id}') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/vehicle_make')); ?>"><i class="fa fa fa-car"></i><span><?php echo e(__('messages.admin.vehicle_make')); ?></span></a></li>
			<?php endif; ?>

			<?php if(@$user->can('view_vehicle_model')): ?>
				<li class="<?php echo e((Route::current()->uri() == 'admin/vehicle_model' || Route::current()->uri() == 'admin/add-vehicle_model' || Route::current()->uri() == 'admin/edit-vehicle_model/{id}') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/vehicle_model')); ?>"><i class="fa fa fa-car"></i><span><?php echo e(__('messages.admin.vehicle_model')); ?></span></a></li>
			<?php endif; ?>

			<?php if(($company_user || @$user->can('manage_vehicle')) || $user->can('manage_vehicle_type')): ?>
			<li class="treeview <?php echo e((Route::current()->uri() == 'admin/vehicle_type' || Route::current()->uri() == $first_segment.'/vehicle') ? 'active' : ''); ?>">
				<a href="#">
					<i class="fa fa-taxi"></i>
					<span><?php echo e(__('messages.admin.manage_vehicle_type.title')); ?></span><i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php if($company_user || @$user->can('manage_vehicle')): ?>
					<li class="<?php echo e((Route::current()->uri() == $first_segment.'/vehicle') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/vehicle')); ?>"><i class="fa fa-taxi"></i><span><?php echo e(__('messages.admin.manage_vehicle_type.vehicles')); ?></span></a></li>
					<?php endif; ?>
					<?php if(@$user->can('manage_vehicle_type')): ?>
					<li class="<?php echo e((Route::current()->uri() == 'admin/vehicle_type') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/vehicle_type')); ?>"><i class="fa fa-car"></i><span><?php echo e(__('messages.admin.manage_vehicle_type.vehicle_types')); ?></span></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>

			<?php if(@$user->can('view_additional_reason')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/additional-reasons') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/additional-reasons')); ?>"><i class="fa fa fa-comment"></i><span><?php echo e(__('messages.admin.additional_reasons')); ?></span></a></li>
			<?php endif; ?>

			<?php if(@$user->can('view_manage_reason')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/cancel-reason') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/cancel-reason')); ?>"><i class="fa fa fa-ban"></i><span><?php echo e(__('messages.admin.manage_cancel_reason')); ?></span></a></li>
			<?php endif; ?>

			<?php if(@$user->can('manage_locations')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/locations') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/locations')); ?>"><i class="fa fa-map-o"></i><span> <?php echo e(__('messages.admin.manage_locations')); ?></span></a></li>
			<?php endif; ?>

			<?php if(@$user->can('manage_peak_based_fare')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/manage_fare') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/manage_fare')); ?>"><i class="fa fa fa-dollar"></i><span><?php echo e(__('messages.admin.manage_fare')); ?></span></a></li>
			<?php endif; ?>

			<?php if($company_user || @$user->can('manage_requests') || @$user->can('manage_trips') || @$user->can('manage_cancel_trips') || @$user->can('manage_payments') || @$user->can('manage_rating')): ?>
			<li class="treeview <?php echo e((Route::current()->uri() == $first_segment.'/request' || Route::current()->uri() == $first_segment.'/trips' || Route::current()->uri() == $first_segment.'/cancel_trips' || Route::current()->uri() == $first_segment.'/payments' || Route::current()->uri() == $first_segment.'/rating') ? 'active' : ''); ?>">
				<a href="#">
					<i class="fa fa-taxi"></i>
					<span><?php echo e(__('messages.admin.manage_trips.title')); ?></span><i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php if($company_user || @$user->can('manage_requests')): ?>
					<li class="<?php echo e((Route::current()->uri() == $first_segment.'/request') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/request')); ?>"><i class="fa fa-paper-plane-o"></i><span><?php echo e(__('messages.admin.manage_trips.manage_ride_requests')); ?></span></a></li>
					<?php endif; ?>

					<?php if($company_user || @$user->can('manage_trips')): ?>
					<li class="<?php echo e((Route::current()->uri() == $first_segment.'/trips') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/trips')); ?>"><i class="fa fa-taxi"></i><span><?php echo e(__('messages.admin.manage_trips.manage_trips')); ?></span></a></li>
					<?php endif; ?>

					<?php if($company_user || @$user->can('manage_cancel_trips')): ?>
					<li class="<?php echo e((Route::current()->uri() == $first_segment.'/cancel_trips') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/cancel_trips')); ?>"><i class="fa fa-chain-broken"></i><span><?php echo e(__('messages.admin.manage_trips.manage_canceled_trips')); ?></span></a></li>
					<?php endif; ?>
					
					<?php if($company_user || @$user->can('manage_payments')): ?>
					<li class="<?php echo e((Route::current()->uri() == $first_segment.'/payments') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/payments')); ?>"><i class="fa fa-usd"></i><span><?php echo e(__('messages.admin.manage_trips.manage_payments')); ?></span></a></li>
					<?php endif; ?>
					
					<?php if($company_user || @$user->can('manage_rating')): ?>
					<li class="<?php echo e((Route::current()->uri() == $first_segment.'/rating') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/rating')); ?>"><i class="fa fa-star"></i><span><?php echo e(__('messages.admin.manage_trips.ratings')); ?></span></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>

			<?php if($company_user || @$user->can('manage_driver_payments') || @$user->can('manage_company_payments')): ?>
			<li class="treeview <?php echo e((Route::current()->uri() == 'admin/payout/overall' || Route::current()->uri() == 'admin/payout/company/overall' || Route::current()->uri() == 'company/payout/overall') ? 'active' : ''); ?>">
				<a href="#">
					<i class="fa fa-dollar" aria-hidden="true"></i> <span><?php echo e(__('messages.admin.manage_payouts.title')); ?></span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php if(@$user->can('manage_company_payment')): ?>
					<li class="<?php echo e((Route::current()->uri() == 'admin/payout/company/overall') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/payout/company/overall')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('messages.admin.manage_payouts.company_payouts')); ?></span></a></li>
					<?php endif; ?>
					<?php if($company_user || @$user->can('manage_driver_payments')): ?>
					<li class="<?php echo e((Route::current()->uri() == $first_segment.'/payout/overall') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/payout/overall')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('messages.admin.manage_payouts.driver_payouts')); ?></span></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>
			<?php if($company_user || @$user->can('manage_owe_amount')): ?>
			<li class="<?php echo e((Route::current()->uri() == $first_segment.'/owe') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/owe')); ?>"><i class="fa fa-money"></i><span><?php echo e(__('messages.admin.manage_owe_amount')); ?></span></a></li>
			<?php endif; ?>

			<?php if($company_user ||  @$user->can('manage_statements')): ?>
			<li class="treeview <?php echo e((Route::current()->uri() == $first_segment.'/statements/{type}') ? 'active' : ''); ?>">
				<a href="#">
					<i class="fa fa-area-chart"></i> <span><?php echo e(__('messages.admin.manage_statements.title')); ?></span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo e((request()->type == 'overall') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/statements/overall')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('messages.admin.manage_statements.overall_statements')); ?></span></a></li>
					<li class="<?php echo e((request()->type == 'driver') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/statements/driver')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('messages.admin.manage_statements.drivers_statments')); ?></span></a></li>
				</ul>
			</li>
			<?php endif; ?>
			<?php if(@$user->can('manage_wallet') || @$user->can('manage_promo_code')): ?>
			<li class="treeview <?php echo e((Route::current()->uri() == 'admin/wallet/{user_type}' || Route::current()->uri() == 'admin/promo_code') ? 'active' : ''); ?>">
				<a href="#">
					<i class="fa fa-google-wallet"></i> <span> <?php echo e(__('messages.admin.manage_wallet_and_promo.title')); ?></span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php if($company_user || @$user->can('manage_wallet')): ?>
					<li class="treeview <?php echo e((@$navigation == 'manage_wallet') ? 'active' : ''); ?>">
						<a href="<?php echo e(route('wallet',['user_type' => 'Rider'])); ?>"><i class="fa fa-circle-o"></i>
							<span> <?php echo e(__('messages.admin.manage_wallet_and_promo.manage_wallet_amount')); ?></span>
						</a>
					</li>
					<?php endif; ?>
					<?php if(@$user->can('manage_promo_code')): ?>
					<li class="<?php echo e((Route::current()->uri() == 'admin/promo_code') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/promo_code')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('messages.admin.manage_wallet_and_promo.manage_promo_code')); ?></span></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>

			<?php if(@$user->can('manage_rider_referrals') || @$user->can('manage_driver_referrals')): ?>
			<li class="treeview <?php echo e((Route::current()->uri() == 'admin/referrals/rider' || Route::current()->uri() == 'admin/referrals/driver') ? 'active' : ''); ?>">
				<a href="#">
					<i class="fa fa-users"></i>
					<span> <?php echo e(__('messages.admin.referrals.title')); ?></span><i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php if(@$user->can('manage_rider_referrals')): ?>
					<li class="<?php echo e((Route::current()->uri() == 'admin/referrals/rider') ? 'active' : ''); ?>">
						<a href="<?php echo e(url('admin/referrals/rider')); ?>"><i class="fa fa-circle-o"></i>
							<span><?php echo e(__('messages.admin.referrals.riders')); ?> </span>
						</a>
					</li>
					<?php endif; ?>
					<?php if(@$user->can('manage_driver_referrals')): ?>
					<li class="<?php echo e((Route::current()->uri() == 'admin/referrals/driver') ? 'active' : ''); ?>">
						<a href="<?php echo e(url('admin/referrals/driver')); ?>"><i class="fa fa-circle-o"></i>
							<span> <?php echo e(__('messages.admin.referrals.drivers')); ?> </span>
						</a>
					</li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>
			<?php if($company_user || $user->can('manage_map') || $user->can('manage_heat_map')): ?>
			<li class="treeview <?php echo e((Route::current()->uri() == $first_segment.'/map' || Route::current()->uri() == $first_segment.'/heat-map') ? 'active' : ''); ?>">
				
				<a href="#">
					<i class="fa fa-map-marker" aria-hidden="true"></i> <span> <?php echo e(__('messages.admin.manage_map.title')); ?></span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php if($user->can('manage_map') || $company_user ): ?>
						<li class="<?php echo e((Route::current()->uri() == $first_segment.'/map') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/map')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('messages.admin.manage_map.map_view')); ?></span></a></li>
					<?php endif; ?>

					<?php if($user->can('manage_heat_map') || $company_user ): ?>
					<li class="<?php echo e((Route::current()->uri() == $first_segment.'/heat-map') ? 'active' : ''); ?>"><a href="<?php echo e(url($first_segment.'/heat-map')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('messages.admin.manage_map.heat_map')); ?></span></a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>
			<?php if(@$user->can('manage_mobile_app_version')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/mobile_app_version') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/mobile_app_version')); ?>"><i class="fa fa-level-up"></i><span><?php echo e(__('messages.admin.manage_mobile_app_version.title')); ?></span></a></li>
			<?php endif; ?>

			<?php if(@$user->can('manage_api_credentials')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/api_credentials') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/api_credentials')); ?>"><i class="fa fa-gear"></i><span><?php echo e(__('messages.admin.api_credentials.title')); ?></span></a></li>
			<?php endif; ?>
			<?php if(@$user->can('manage_payment_gateway')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/payment_gateway') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/payment_gateway')); ?>"><i class="fa fa-paypal"></i><span><?php echo e(__('messages.admin.payment_gateway.title')); ?></span></a></li>
			<?php endif; ?>
			<?php if(@$user->can('manage_fees')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/fees') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/fees')); ?>"><i class="fa fa-dollar"></i><span><?php echo e(__('messages.admin.mange_fees.title')); ?></span></a></li>
			<?php endif; ?>
			<?php if(@$user->can('manage_referral_settings')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/referral_settings') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/referral_settings')); ?>"><i class="fa fa-users"></i><span><?php echo e(__('messages.admin.manage_referral_settings.title')); ?></span></a></li>
			<?php endif; ?>
			<?php if(@$user->can('manage_metas')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/metas') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/metas')); ?>"><i class="fa fa-bar-chart"></i><span><?php echo e(__('messages.admin.manage_metas.title')); ?></span></a></li>
			<?php endif; ?>
			<?php if(@$user->can('manage_country')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/country') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/country')); ?>"><i class="fa fa-globe"></i><span><?php echo e(__('messages.admin.manage_country.title')); ?></span></a></li>
			<?php endif; ?>
			<?php if(@$user->can('manage_currency')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/currency') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/currency')); ?>"><i class="fa fa-eur"></i><span><?php echo e(__('messages.admin.manage_currency.title')); ?></span></a></li>
			<?php endif; ?>
			<?php if(@$user->can('manage_language')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/language') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/language')); ?>"><i class="fa fa-language"></i><span><?php echo e(__('messages.admin.manage_language.title')); ?></span></a></li>
			<?php endif; ?>
			<?php if(@$user->can('manage_static_pages')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/pages') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/pages')); ?>"><i class="fa fa-newspaper-o"></i><span><?php echo e(__('messages.admin.manage_static_pages.title')); ?></span></a></li>
			<?php endif; ?>
			
			<?php if(@$user->can('manage_help')): ?>
			<li class="treeview <?php echo e((Route::current()->uri() == 'admin/help' || Route::current()->uri() == 'admin/help_category' || Route::current()->uri() == 'admin/help_subcategory') ? 'active' : ''); ?>">
				<a href="#">
					<i class="fa fa-support"></i> <span><?php echo e(__('messages.admin.manage_help.title')); ?></span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo e((Route::current()->uri() == 'admin/help') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/help')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('messages.admin.manage_help.help')); ?></span></a></li>
					<li class="<?php echo e((Route::current()->uri() == 'admin/help_category') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/help_category')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('messages.admin.manage_help.category')); ?></span></a></li>
					<li class="<?php echo e((Route::current()->uri() == 'admin/help_subcategory') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/help_subcategory')); ?>"><i class="fa fa-circle-o"></i><span><?php echo e(__('messages.admin.manage_help.subcategory')); ?></span></a></li>
				</ul>
			</li>
			<?php endif; ?>
			<?php if(@$user->can('manage_join_us')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/join_us') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/join_us')); ?>"><i class="fa fa-share-alt"></i><span><?php echo e(__('messages.admin.join_us_links.title')); ?></span></a></li>
			<?php endif; ?>
			<?php if(@$user->can('manage_support')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/support') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/support')); ?>"><i class="fa fa-globe"></i><span><?php echo e(__('messages.admin.manage_support.title')); ?></span></a></li>
			<?php endif; ?>
			<?php if(@$user->can('manage_site_settings')): ?>
			<li class="<?php echo e((Route::current()->uri() == 'admin/site_setting') ? 'active' : ''); ?>"><a href="<?php echo e(url('admin/site_setting')); ?>"><i class="fa fa-cogs"></i><span><?php echo e(__('messages.admin.site_setting.title')); ?></span></a></li>
			<?php endif; ?>
		</ul>
	</section>
</aside>
<?php /**PATH C:\laragon\www\ridein25\resources\views/admin/common/navigation.blade.php ENDPATH**/ ?>