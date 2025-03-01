<?php $__env->startSection('main'); ?>
<div class="content-wrapper" ng-controller="payout_preferences">
	<section class="content-header">
		<h1> Payout <small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(url(LOGIN_USER_TYPE.'/dashboard')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Payout</li>
		</ol>
	</section>
	<section class="content">
		<div class="payout_setup" id="payout_setup">
			<div class="panel row-space-4">
				<div class="box-header">
					<?php echo app('translator')->get('messages.account.payout_methods'); ?>
				</div>
				<div class="panel-body" id="payout_intro" ng-init="payouts=<?php echo e($payouts); ?>">
					<p class="payout_intro">
						<?php echo app('translator')->get('messages.account.payout_methods_desc'); ?>.
					</p>
					<div class="scroll_table">
						<table class="table table-striped" id="payout_methods">
							<thead ng-if="payouts.length">
								<tr class="text-truncate">
									<th> <?php echo app('translator')->get('messages.account.method'); ?> </th>
									<th> <?php echo app('translator')->get('messages.account.details'); ?> </th>
									<th> <?php echo app('translator')->get('messages.driver_dashboard.status'); ?> </th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody ng-if="payouts.length">
								<tr ng-repeat="payout in payouts" ng-if="payout.id != 0" ng-cloak>
									<td>
										{{ payout.value }}
										<span class="label label-info" ng-show="payout.is_default"> <?php echo app('translator')->get('messages.account.default'); ?> </span>
									</td>
									<td>
										{{ payout.preference_id }} <span class="lang-chang-label" ng-show="payout.payout_data.currency_code != ''">  ({{ payout.payout_data.currency_code }}) </span>
									</td>
									<td>
										<?php echo app('translator')->get('messages.account.ready'); ?>
									</td>
									<td class="payout-options" >
										<li class="dropdown-trigger list-unstyled" ng-hide="payout.is_default">
											<a href="javascript:void(0);" class="link-reset text-truncate" id="payout-options-{{ payout.id }}">
												<?php echo app('translator')->get('messages.account.options'); ?>
												<i class="icon icon-caret-down"></i>
											</a>
											<ul data-sticky="true" data-trigger="#payout-options-{{ payout.id }}" class="tooltip tooltip-top-left list-unstyled dropdown-menu" aria-hidden="true">
												<li>
													<a rel="nofollow" data-method="post" class="link-reset menu-item" href="<?php echo e(route('company.update_payout_settings')); ?>?payout_id={{payout.id}}&action=delete"> <?php echo app('translator')->get('messages.account.remove'); ?> </a>
												</li>
												<li>
													<a rel="nofollow" data-method="post" class="link-reset menu-item" href="<?php echo e(route('company.update_payout_settings')); ?>?payout_id={{payout.id}}&action=default"> <?php echo app('translator')->get('messages.account.set_default'); ?> </a>
												</li>
											</ul>
										</li>
									</td>
								</tr>
							</tbody>
							<tfoot>
							<tr id="add_payout_method_section">
								<td colspan="4">
									<a href="javascript:void(0);" class="btn btn-primary pop-striped" data-toggle="modal" data-target="#payout_popup-address">
										<?php echo app('translator')->get('messages.account.add_payout_method'); ?>
									</a>
									<span class="text-muted lang-left">
										<?php echo app('translator')->get('messages.account.direct_deposit'); ?>, <span>Mtn,PayPal </span><span class="lang-left">etc...</span>
									</span>
								</td>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="modal poppayout fade" id="payout_popup-address" aria-hidden="false" tabindex="-1">
		<div id="modal-add-payout-set-address" class="modal-content">
			<div class="panel-header">
				<button type="button" class="close" data-dismiss="modal"></button>
				<?php echo app('translator')->get('messages.account.add_payout_method'); ?>
			</div>
			<div class="flash-container payout-flash-message" ng-show="show_address_error">
				<div class="alert alert-danger">
					<a class="close alert-close" href="javascript:void(0);"><i class="icon alert-icon icon-alert-alt"></i> </a>
					<p class="text-center" ng-show="address_error"> <?php echo app('translator')->get('messages.account.blank_address'); ?> </p>
					<p class="text-center" ng-show="city_error"> <?php echo app('translator')->get('messages.account.blank_city'); ?> </p>
					<p class="text-center" ng-show="country_error"> <?php echo app('translator')->get('messages.account.blank_country'); ?> </p>
					<p class="text-center" ng-show="postal_error"> <?php echo app('translator')->get('messages.account.blank_post'); ?> </p>
				</div>
			</div>
			<?php echo Form::open(['class' => 'modal-add-payout-pref', 'method' => 'POST', 'id' => 'address']); ?>

			<div class="panel-body">
				<div class="payout_popup_view">
					<label for="payout_info_payout_country"> <?php echo app('translator')->get('messages.account.country'); ?> <em class="text-danger">*</em> </label>
					<div class="payout_input_field">
						<div class="select" ng-init="country=''">
							<?php echo Form::select('country_dropdown', $country,  old('country',$default_country), ['class' => 'form-control', 'id' => 'payout_info_payout_country', "ng-model" => "country", "ng-change" => "countryChanged()",'placeholder'=>"Select"]); ?>

						</div>
						<p class="text-danger" > </p>
					</div>
				</div>
				<label ng-show="payout_country=='JP'"><b>Address Kana:</b></label>
				<div class="payout_popup_view">
					<label for="payout_info_payout_address1"> <?php echo app('translator')->get('messages.account.address'); ?> <em class="text-danger">*</em> </label>
					<div class="payout_input_field">
						<?php echo Form::text('address1', '', ['id' => 'payout_info_payout_address1','ng-model'=>"address1"]); ?>

					</div>
					<p class="text-danger" ><?php echo e($errors->first('address1')); ?></p>
				</div>
				<div class="payout_popup_view">
					<label for="payout_info_payout_address2"> <?php echo app('translator')->get('messages.account.address'); ?> 2 / <?php echo app('translator')->get('messages.account.zone'); ?> </label>
					<div class="payout_input_field">
						<?php echo Form::text('address2', '', ['id' => 'payout_info_payout_address2','ng-model'=>"address2"]); ?>

					</div>
					<p class="text-danger" ><?php echo e($errors->first('address2')); ?></p>
				</div>
				<div class="payout_popup_view">
					<label for="payout_info_payout_city"> <?php echo app('translator')->get('messages.account.city'); ?> <em class="text-danger">*</em></label>
					<div class="payout_input_field">
						<?php echo Form::text('city', '', ['id' => 'payout_info_payout_city','ng-model'=>"city"]); ?>

					</div>
					<p class="text-danger" > <?php echo e($errors->first('city')); ?> </p>
				</div>
				<div class="payout_popup_view">
					<label for="payout_info_payout_state"> <?php echo app('translator')->get('messages.account.state'); ?> / <?php echo app('translator')->get('messages.account.province'); ?> </label>
					<div class="payout_input_field">
						<?php echo Form::text('state', old('state'), ['id' => 'payout_info_payout_state','ng-model'=>"state"]); ?>

					</div>
					<p class="text-danger"> <?php echo e($errors->first('state')); ?></p>
				</div>
				<div class="payout_popup_view">
					<label for="payout_info_payout_zip"> <?php echo app('translator')->get('messages.account.postal_code'); ?> <em class="text-danger">*</em></label>
					<div class="payout_input_field">
						<?php echo Form::text('postal_code', '', ['id' => 'payout_info_payout_zip','ng-model' => 'postal_code']); ?>

					</div>
					<p class="text-danger"> <?php echo e($errors->first('postal_code')); ?> </p>
				</div>
			</div>
			<div class="panel-footer payout_footer">
				<button type="button" class="btn btn-primary" ng-click="nextStep('address')">
				<?php echo app('translator')->get('messages.account.next'); ?>
				</button>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
	<div class="modal poppayout perferenace_payout pl-0" id="payout_popup-methods" aria-hidden="false" tabindex="-1">
		<div id="modal-add-payout-set-address" class="modal-content">
			<div class="panel-header">
				<button type="button" class="close pay_close" data-dismiss="modal"></button>
				<?php echo app('translator')->get('messages.account.add_payout_method'); ?>
			</div>
			<div class="flash-container payout-flash-message" ng-show="show_method_error">
				<div class="alert alert-danger">
					<a class="close alert-close" href="javascript:void(0);"><i class="icon alert-icon icon-alert-alt"></i> </a>
					<p class="text-center" ng-show="method_error"> <?php echo app('translator')->get('messages.account.choose_method'); ?> </p>
				</div>
			</div>
			<?php echo Form::open(['class' => 'modal-add-payout-pref', 'method' => 'POST', 'id' => 'payout_method-options']); ?>

			<div class="panel-body">
				<div>
					<p> <?php echo app('translator')->get('messages.account.payout_released_desc1'); ?> </p>
					<p> <?php echo app('translator')->get('messages.account.payout_released_desc2'); ?> </p>
					<p> <?php echo app('translator')->get('messages.account.payout_released_desc3'); ?> </p>
				</div>
				<div class="scroll_table">
					<table id="payout_method_descriptions" class="table table-striped">
						<thead><tr>
							<th></th>
							<th> <?php echo app('translator')->get('messages.account.payout_method'); ?> </th>
							<th> <?php echo app('translator')->get('messages.account.currency'); ?> </th>
							<th> <?php echo app('translator')->get('messages.account.details'); ?> </th>
						</tr></thead>
						<tbody>
							<tr ng-repeat="payout in payouts">
								<td>
									<input type="radio" name="payout_method" id="payout_method_{{ payout.key }}" class="payout_method" value="{{ payout.key }}">
								</td>
								<td class="type">
									<label for="payout_method_{{ payout.key }}"> {{ payout.value }} </label>
								</td>
								<td>
									<?php echo e(PAYPAL_CURRENCY_CODE); ?>

								</td>
								<td>
									<?php echo app('translator')->get('messages.account.business_day_processing'); ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer payout_footer">
				<button type="button" class="btn btn-primary" ng-click="nextStep('payout_method')">
				<?php echo app('translator')->get('messages.account.next'); ?>
				</button>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
	<div class="modal poppayout" id="payout_popup-paypal" aria-hidden="false" tabindex="-1">
		<div id="modal-add-payout-set-address" class="modal-content">
			<div class="panel-header">
				<button type="button" class="close pay_close" data-dismiss="modal"></button>
				<?php echo app('translator')->get('messages.account.add_payout_method'); ?>
			</div>
			<div class="flash-container payout-flash-message" ng-show="show_paypal_error">
				<div class="alert alert-danger">
					<a class="close alert-close" href="javascript:void(0);"><i class="icon alert-icon icon-alert-alt"></i> </a>
					<p class="text-center" ng-show="paypal_email_error"> <?php echo app('translator')->get('messages.account.valid_email'); ?> </p>
				</div>
			</div>
			<?php echo Form::open(['url' => route('company.update_preference') ,'class' => 'modal-add-payout-pref', 'method' => 'POST', 'id' => 'payout_paypal']); ?>

			<input type="hidden" name="address1" ng-value="address1" >
			<input type="hidden" name="address2" ng-value="address2" >
			<input type="hidden" name="city" ng-value="city" >
			<input type="hidden" name="country" ng-value="country" >
			<input type="hidden" name="state" ng-value="state" >
			<input type="hidden" name="postal_code" ng-value="postal_code" >
			<input type="hidden" name="payout_method" ng-value="payout_method">
			<div class="panel-body">
				<div class="payout_popup_view">
					<label for="payout_info_payout_address1"> PayPal <?php echo app('translator')->get('messages.account.email_id'); ?> <em class="text-danger">*</em> </label>
					<div class="payout_input_field">
						<?php echo Form::text('email', '', ['ng-model'=>"paypal_email"]); ?>

					</div>
					<p class="text-danger" ><?php echo e($errors->first('email')); ?></p>
				</div>
			</div>
			<div class="panel-footer payout_footer">
				<button type="button" class="btn btn-primary" ng-click="nextStep('update_paypal')"> <?php echo app('translator')->get('messages.account.submit'); ?> </button>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
	<!-- Popup for get Stripe datas -->
	<div class="modal poppayout" id="payout_popup-stripe" aria-hidden="false" tabindex="-1">
		<div id="modal-add-payout-set-address" class="modal-content">
			<div class="panel-header">
				<a data-behavior="modal-close" class="panel-close" href="javascript:void(0);"></a>
				<button type="button" class="close" data-dismiss="modal"></button>
				<?php echo app('translator')->get('messages.account.add_payout_method'); ?>
			</div>
			<div class="flash-container payout-flash-message" ng-show="show_paypal_error">
				<div class="alert alert-danger">
					<a class="close alert-close" href="javascript:void(0);"><i class="icon alert-icon icon-alert-alt"></i> </a>
					<p class="text-center" ng-show="stripe_blank_error"> <?php echo app('translator')->get('messages.account.fill_all_required_fields'); ?> </p>
				</div>
			</div>
			<?php echo Form::open(['url' => route('company.update_preference') ,'class' => 'modal-add-payout-pref', 'method' => 'POST', 'id' => 'payout_stripe', 'files' => 'true']); ?>

			<input type="hidden" name="address1" ng-value="address1" >
			<input type="hidden" name="address2" ng-value="address2" >
			<input type="hidden" name="city" ng-value="city" >
			<input type="hidden" name="country" ng-value="country" >
			<input type="hidden" name="state" ng-value="state" >
			<input type="hidden" name="postal_code" ng-value="postal_code" >
			<input type="hidden" name="payout_method" ng-value="payout_method">
			
			<div class="panel-body panel-body-payout" ng-init="payout_country=<?php echo e(json_encode(old('country') ?: '')); ?>;payout_currency=<?php echo e(json_encode(old('currency') ?: '')); ?>;iban_supported_countries = <?php echo e(json_encode($iban_supported_countries)); ?>;branch_code_required=<?php echo e(json_encode($branch_code_required)); ?>;country_currency=<?php echo e(json_encode($country_currency)); ?>;change_currency();mandatory=<?php echo e(json_encode($mandatory)); ?>;old_currency='<?php echo e(old('currency') ? json_encode(old('currency')) : ''); ?>';country_list=<?php echo e(json_encode($country_list)); ?>;">
				<div>
					<label for="payout_info_payout_country1"> <?php echo app('translator')->get('messages.account.country'); ?> <em class="text-danger">*</em></label>
					<div class="select">
						<?php echo Form::select('country', $country_list, $default_country, ['class' => 'form-control', 'id' => 'payout_info_payout_country1','placeholder'=>'Select','ng-model'=>'payout_country','ng-change' => 'changeCurrency()']); ?>

					</div>
				</div>
				<div>
					<label for="payout_info_payout_currency"> <?php echo app('translator')->get('messages.account.currency'); ?> <em class="text-danger">*</em></label>
					<div class="select">
						<select name="currency" id="payout_info_payout_currency" class="form-control"ng-model="payout_currency" ng-change="changeCurrency(false);">
							<option value=""> select </option>
							<option value="{{currency}}" ng-repeat="currency in country_currency[payout_country]"> {{ currency }}</option>
						</select>
						<p class="text-danger" ><?php echo e($errors->first('currency')); ?></p>
					</div>
				</div>
				<!-- Bank Name -->
				<div ng-show="mandatory[payout_country][3]">
					<label class="" for="bank_name">{{mandatory[payout_country][3]}}<em class="text-danger">*</em></label>
					<?php echo Form::text('bank_name', '', ['id' => 'bank_name', 'class' => 'form-control']); ?>

					<p class="text-danger" ><?php echo e($errors->first('bank_name')); ?></p>
				</div>
				<!-- Bank Name -->
				<!-- Branch Name -->
				<div ng-show="mandatory[payout_country][4]">
					<label class="" for="bank_name">{{mandatory[payout_country][4]}}<em class="text-danger">*</em></label>
					<?php echo Form::text('branch_name', '', ['id' => 'branch_name', 'class' => 'form-control']); ?>

					<p class="text-danger" ><?php echo e($errors->first('branch_name')); ?></p>
				</div>
				<!-- Branch Name -->
				<!-- Routing number  -->
				<div ng-if="payout_country" class="routing_number_cls" ng-hide="iban_supported_countries.includes(payout_country)">
					<label class="" for="routing_number">{{mandatory[payout_country][0]}}<em class="text-danger">*</em></label>
					<div class="">
						<?php echo Form::text('routing_number', @$payout_preference->routing_number, ['id' => 'routing_number', 'class' => 'form-control']); ?>

						<p class="text-danger" ><?php echo e($errors->first('routing_number')); ?></p>
					</div>
				</div>
				<!-- Routing number -->
				<!-- Branch code -->
				<div ng-show="mandatory[payout_country][2]">
					<label class="" for="branch_code">{{mandatory[payout_country][2]}}<em class="text-danger">*</em></label>
					<?php echo Form::text('branch_code', '', ['id' => 'branch_code', 'class' => 'form-control','maxlength'=>'3']); ?>

					<p class="text-danger" ><?php echo e($errors->first('branch_code')); ?></p>
				</div>
				<!-- Branch code -->
				<!-- Account Number -->
				<div ng-if="payout_country">
					<label class="" for="account_number" ng-hide="iban_supported_countries.includes(payout_country)"><span class="account_number_cls">{{mandatory[payout_country][1]}}</span><em class="text-danger">*</em></label>
					<label class="" for="account_number" ng-show="iban_supported_countries.includes(payout_country)"><?php echo e(trans('messages.account.iban_number')); ?><em class="text-danger">*</em></label>
					<?php echo Form::text('account_number', '', ['id' => 'account_number', 'class' => 'form-control']); ?>

					<p class="text-danger" ><?php echo e($errors->first('account_number')); ?></p>
				</div>
				<!-- Account Number -->
				<!-- Account Holder name -->
				<div>
					<label ng-if="payout_country == 'JP'" for="holder_name">{{mandatory[payout_country][5]}}<em class="text-danger">*</em></label>
					<label ng-if="payout_country != 'JP'" for="holder_name"><?php echo e(trans('messages.account.holder_name')); ?><em class="text-danger">*</em></label>
					<?php echo Form::text('holder_name', '', ['id' => 'holder_name', 'class' => 'form-control']); ?>

					<p class="text-danger" ><?php echo e($errors->first('holder_name')); ?></p>
				</div>
				<!-- Account Holder name -->
				<!-- SSN Last 4 only for US -->
				<div ng-show="payout_country == 'US'">
					<label ng-if="payout_country == 'US'" for="ssn_last_4"><?php echo e(trans('messages.account.ssn_last_4')); ?><em class="text-danger">*</em></label>
					<?php echo Form::text('ssn_last_4', '', ['id' => 'ssn_last_4', 'class' => 'form-control','maxlength'=>'4']); ?>

					<p class="text-danger" ><?php echo e($errors->first('ssn_last_4')); ?></p>
				</div>
				<!-- SSN Last 4 only for US -->
				<!-- Phone number only for Japan -->
				<div ng-show="payout_country == 'JP'">
					<label class="" for="phone_number" ><?php echo e(trans('messages.profile.phone_number')); ?><em class="text-danger">*</em></label>
					<?php echo Form::text('phone_number', '', ['id' => 'phone_number', 'class' => 'form-control']); ?>

					<p class="text-danger" ><?php echo e($errors->first('phone_number')); ?></p>
				</div>
				<!-- Phone number only for Japan -->
				<input type="hidden" id="is_iban" name="is_iban" ng-value="iban_supported_countries.includes(payout_country) ? 'Yes' : 'No'">
				<input type="hidden" id="is_branch_code" name="is_branch_code" ng-value="branch_code_required.includes(payout_country) ? 'Yes' : 'No'">
				<!-- Gender only for Japan -->
				<div ng-if="payout_country == 'JP'" class="col-md-6 col-sm-12 p-0 select-cls row-space-3">
					<label for="user_gender">
						<?php echo e(trans('messages.profile.gender')); ?>

					</label>
					<div class="select">
						<?php echo Form::select('gender', ['male' => trans('messages.profile.male'), 'female' => trans('messages.profile.female')], '', ['id' => 'user_gender', 'placeholder' => trans('messages.profile.gender'), 'class' => 'focus form-control','style'=>'min-width:140px;']); ?>

						<span class="text-danger"><?php echo e($errors->first('gender')); ?></span>
					</div>
				</div>
				<!-- Gender only for Japan -->
				<!-- Address Kanji Only for Japan -->
				<div ng-class="(payout_country == 'JP'? 'jp_form row':'')" class="clearfix ">
					<div ng-if="payout_country == 'JP'" class="col-md-12 col-sm-12">
						<label><b>Address Kanji:</b></label>
						<div>
							<label for="payout_info_payout_address2"><?php echo e(trans('messages.account.address')); ?> 1<em class="text-danger">*</em></label>
							<?php echo Form::text('kanji_address1', '', ['id' => 'kanji_address1', 'class' => 'form-control']); ?>

							<p class="text-danger" ><?php echo e($errors->first('kanji_address1')); ?></p>
						</div>
						<div>
							<label for="payout_info_payout_address2">Town<em class="text-danger">*</em></label>
							<?php echo Form::text('kanji_address2', '', ['id' => 'kanji_address2', 'class' => 'form-control']); ?>

							<p class="text-danger" ><?php echo e($errors->first('kanji_address2')); ?></p>
						</div>
						<div>
							<label for="payout_info_payout_city"><?php echo e(trans('messages.account.city')); ?> <em class="text-danger">*</em></label>
							<?php echo Form::text('kanji_city', '', ['id' => 'kanji_city', 'class' => 'form-control']); ?>

							<p class="text-danger" ><?php echo e($errors->first('kanji_city')); ?></p>
						</div>
						<div>
							<label for="payout_info_payout_state"><?php echo e(trans('messages.account.state')); ?> / <?php echo e(trans('messages.account.province')); ?><em class="text-danger">*</em></label>
							<?php echo Form::text('kanji_state', '', ['id' => 'kanji_state', 'class' => 'form-control']); ?>

							<p class="text-danger" ><?php echo e($errors->first('kanji_state')); ?></p>
						</div>
						<div>
							<label for="payout_info_payout_zip"><?php echo e(trans('messages.account.postal_code')); ?> <em class="text-danger">*</em></label>
							<?php echo Form::text('kanji_postal_code', '', ['id' => 'kanji_postal_code', 'class' => 'form-control']); ?>

							<p class="text-danger" ><?php echo e($errors->first('kanji_postal_code')); ?></p>
						</div>
					</div>
				</div>
				<!-- Address Kanji Only for Japan -->
				<!-- Legal document -->
				<div id="legal_document" class="legal_document">
					<div class="row">
						<label class="control-label required-label col-md-12 col-sm-12 row-space-2" for="document"><?php echo app('translator')->get('messages.account.legal_document'); ?> <?php echo app('translator')->get('messages.account.legal_document_format'); ?><em class="text-danger">*</em></label>
						<div class="col-md-12 col-sm-12 ">
							<?php echo Form::file('document', ['id' => 'document', 'class' => 'form-control',"accept"=>".jpg,.jpeg,.png"]); ?>

							<p class="text-danger" ><?php echo e($errors->first('document')); ?></p>
						</div>
					</div>
				</div>
				<!-- Legal document -->
				<!-- Additional document -->
				<div id="additional_document" class="additional_document">
					<div class="row">
						<label class="control-label required-label col-md-12 col-sm-12 row-space-2" for="document"><?php echo app('translator')->get('messages.account.additional_document'); ?> <?php echo app('translator')->get('messages.account.legal_document_format'); ?><em class="text-danger">*</em></label>
						<div class="col-md-12 col-sm-12 ">
							<?php echo Form::file('additional_document', ['id' => 'additional_document', 'class' => 'form-control',"accept"=>".jpg,.jpeg,.png"]); ?>

							<p class="text-danger" ><?php echo e($errors->first('additional_document')); ?></p>
						</div>
					</div>
				</div>
				<!-- Additional document -->
				<input type="hidden" name="holder_type" value="individual">
				<input type="hidden" name="stripe_token" id="stripe_token" >
				<p class="text-danger col-sm-12" id="stripe_errors"></p>
			</div>
			<div class="panel-footer payout_footer">
				<button type="button" class="btn btn-primary" ng-click="nextStep('update_stripe')"> <?php echo app('translator')->get('messages.account.submit'); ?> </button>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
	<!-- end Popup -->

	<!--- Start Mtn Popup--->
	<div class="modal poppayout" id="payout_popup-mtn" aria-hidden="false" tabindex="-1">
		<div id="modal-add-payout-set-address" class="modal-content">
			<div class="panel-header">
				<button type="button" class="close pay_close" data-dismiss="modal"></button>
				<?php echo app('translator')->get('messages.account.add_payout_method'); ?>
			</div>
			<div class="flash-container payout-flash-message" ng-show="show_bank_error">
				<div class="alert alert-danger">
					<a class="close alert-close" href="javascript:void(0);"><i class="icon alert-icon icon-alert-alt"></i> </a>
					<p class="text-center" ng-show="required_error"> <?php echo app('translator')->get('messages.account.fill_all_required_fields'); ?> </p>
				</div>
			</div>
			<div class="panel-body panel-body-payout" ng-init="payout_country=<?php echo e(json_encode(old('country') ?: '')); ?>;payout_currency=<?php echo e(json_encode(old('currency') ?: '')); ?>;iban_supported_countries = <?php echo e(json_encode($iban_supported_countries)); ?>;branch_code_required=<?php echo e(json_encode($branch_code_required)); ?>;country_currency=<?php echo e(json_encode($country_currency)); ?>;change_currency();mandatory=<?php echo e(json_encode($mandatory)); ?>;old_currency='<?php echo e(old('currency') ? json_encode(old('currency')) : ''); ?>';country_list=<?php echo e(json_encode($country_list)); ?>;">
			
			<?php echo Form::open(['url' => route('company.update_preference') ,'class' => 'modal-add-payout-pref', 'method' => 'POST', 'id' => 'payout_mtn']); ?>

			<input type="hidden" name="address1" ng-value="address1" >
			<input type="hidden" name="address2" ng-value="address2" >
			<input type="hidden" name="city" ng-value="city" >
			<input type="hidden" name="country" ng-value="country" >
			<input type="hidden" name="state" ng-value="state" >
			<input type="hidden" name="postal_code" ng-value="postal_code" >
			<input type="hidden" name="payout_method" ng-value="payout_method">

			<div>
			
				<label for="payout_info_payout_country1"> <?php echo app('translator')->get('messages.account.country'); ?> <em class="text-danger">*</em></label>
				<div class="select">
					<?php echo Form::select('country', $country_list, $default_country, ['class' => 'form-control', 'id' => 'payout_info_payout_country1','placeholder'=>'Select','ng-model'=>'payout_country','ng-change' => 'changeCurrency()']); ?>

				</div>
			</div>
			<div>
				<label for="payout_info_payout_currency"> <?php echo app('translator')->get('messages.account.currency'); ?> <em class="text-danger">*</em></label>
				<div class="select">
					<select name="currency" id="payout_info_payout_currency" class="form-control"ng-model="payout_currency" ng-change="changeCurrency(false);">
						<option value=""> select </option>
						<option value="{{currency}}" ng-repeat="currency in country_currency[payout_country]"> {{ currency }}</option>
					</select>
					<p class="text-danger" ><?php echo e($errors->first('currency')); ?></p>
				</div>
			</div>

			<div>
				<div class="form-group">
					<label> <?php echo app('translator')->get('messages.account.mtn_tel'); ?> <em class="text-danger">*</em></label>
					<?php echo Form::text('mtn_tel',old('mtn_tel'), ['class' => 'form-control', 'id' => 'mtn_tel', 'placeholder' => trans('messages.account.mtn_tel')]); ?>

					<span class="text-danger"><?php echo e($errors->first('mtn_tel')); ?></span>
				</div>
			</div>

			<div class="panel-footer payout_footer">
				<button type="button" class="btn btn-primary" ng-click="nextStep('update_mtn')"> <?php echo app('translator')->get('messages.account.submit'); ?> </button>
			</div>
			<?php echo Form::close(); ?>


			</div>
		</div>
	</div>
<!--- End Mtn Popup--->


	<div class="modal poppayout" id="payout_popup-bank_transfer" aria-hidden="false" tabindex="-1">
		<div id="modal-add-payout-set-address" class="modal-content">
			<div class="panel-header">
				<button type="button" class="close pay_close" data-dismiss="modal"></button>
				<?php echo app('translator')->get('messages.account.add_payout_method'); ?>
			</div>
			<div class="flash-container payout-flash-message" ng-show="show_bank_error">
				<div class="alert alert-danger">
					<a class="close alert-close" href="javascript:void(0);"><i class="icon alert-icon icon-alert-alt"></i> </a>
					<p class="text-center" ng-show="required_error"> <?php echo app('translator')->get('messages.account.fill_all_required_fields'); ?> </p>
				</div>
			</div>
			<?php echo Form::open(['url' => route('company.update_preference') ,'class' => 'modal-add-payout-pref', 'method' => 'POST', 'id' => 'payout_bank_transfer']); ?>

			<input type="hidden" name="address1" ng-value="address1" >
			<input type="hidden" name="address2" ng-value="address2" >
			<input type="hidden" name="city" ng-value="city" >
			<input type="hidden" name="country" ng-value="country" >
			<input type="hidden" name="state" ng-value="state" >
			<input type="hidden" name="postal_code" ng-value="postal_code" >
			<input type="hidden" name="payout_method" ng-value="payout_method">
			<div class="panel-body">
				<div class="form-group">
					<label> <?php echo app('translator')->get('messages.account.holder_name'); ?> <em class="text-danger">*</em></label>
					<?php echo Form::text('account_holder_name',old('account_holder_name'), ['class' => 'form-control', 'id' => 'bank_holder_name', 'placeholder' => trans('messages.account.holder_name')]); ?>

					<span class="text-danger"><?php echo e($errors->first('account_holder_name')); ?></span>
				</div>
				<div class="form-group">
					<label for='bank_account_number'> <?php echo app('translator')->get('messages.account.account_number'); ?> <em class="text-danger">*</em></label>
					<?php echo Form::text('bank_account_number',old('bank_account_number'), ['class' => 'form-control', 'id' => 'bank_account_number', 'placeholder' => trans('messages.account.account_number')]); ?>

					<span class="text-danger"><?php echo e($errors->first('bank_account_number')); ?></span>
				</div>
				<div class="form-group">
					<label> <?php echo app('translator')->get('messages.account.bank_name'); ?> <em class="text-danger">*</em></label>
					<?php echo Form::text('bank_name',old('bank_name'), ['class' => 'form-control', 'id' => 'bankname', 'placeholder' => trans('messages.account.bank_name')]); ?>

					<span class="text-danger"><?php echo e($errors->first('bank_name')); ?></span>
				</div>
				<div class="form-group">
					<label for="bank_location"> <?php echo app('translator')->get('messages.account.bank_location'); ?> <em class="text-danger">*</em></label>
					<?php echo Form::text('bank_location',old('bank_location'), ['class' => 'form-control', 'id' => 'bank_location', 'placeholder' => trans('messages.account.bank_location')]); ?>

					<span class="text-danger"><?php echo e($errors->first('bank_location')); ?></span>
				</div>
				<div class="form-group">
					<label for="bank_code"> <?php echo app('translator')->get('messages.account.bank_code'); ?> <em class="text-danger">*</em></label>
					<?php echo Form::text('bank_code',old('code'), ['class' => 'form-control', 'id' => 'bank_code', 'placeholder' => trans('messages.account.bank_code')]); ?>

					<span class="text-danger"><?php echo e($errors->first('bank_code')); ?></span>
				</div>
			</div>
			<div class="panel-footer payout_footer">
				<button type="button" class="btn btn-primary" ng-click="nextStep('update_banktransfer')"> <?php echo app('translator')->get('messages.account.submit'); ?> </button>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
	var payout_errors = <?php echo count($errors->getMessages()); ?>;
	if(payout_errors > 0) {
		$('#payout_popup-stripe').modal('show');
	}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\rideinjune\resources\views/company_payout.blade.php ENDPATH**/ ?>