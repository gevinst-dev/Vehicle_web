<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />

    <link media="all" type="text/css" rel="stylesheet" href="<?php echo e(asset('css/payment.css')); ?>" />
</head>


<body ng-app="App" class="">

    <main>
        <div class="payment-form" id="theme">
            <div class="main-header">
                <div><?php echo e($currency_code); ?> <?php echo e($amount); ?></div>
            </div>


            <?php $__currentLoopData = $view; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $paymet_methods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($payment_name === 'Redsys' || $payment_name === 'redsys'): ?>
                    <?php echo $__env->make($paymet_methods['view'], [
                        'data' => ['currency_code' => $currency_code, 'amount' => $amount] + $paymet_methods,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php else: ?>
                    <form id="checkout_payment" method="post" action="<?php echo e(route('payment.success')); ?>">
                        <input type="hidden" name="pay_key" id="nonce">
                        <input type="hidden" name="payment_type" id="payment_type">
                        <div class="row">
                            <?php if($loop->even): ?>
                                <span style="text-align: center;">OR</span>
                            <?php endif; ?>
                            <?php echo $__env->make($paymet_methods['view'], [
                                'data' =>
                                    ['currency_code' => $currency_code, 'amount' => $amount] + $paymet_methods,
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </form>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
    </main>
</body>




<?php echo Html::script('js/jquery-1.11.3.js'); ?>

<?php echo Html::script('js/jquery-ui.js'); ?>

<?php echo Html::script('js/angular.js'); ?>

<?php echo Html::script('js/angular-sanitize.js'); ?>


<script>
    var app = angular.module('App', ['ngSanitize']);
    var APP_URL = <?php echo json_encode(url('/')); ?>;

    // Get URL to Create Dark theme
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('mode');
    var element = document.getElementById("theme");
    element.classList.add(myParam);
</script>

<?php echo $__env->yieldPushContent('scripts'); ?>

</html>
<?php /**PATH C:\laragon\www\rideinjune\resources\views/payment/payment.blade.php ENDPATH**/ ?>