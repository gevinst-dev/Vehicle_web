<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete one track, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default confirm-delete_cancel" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok confirm-delete">Delete</a>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="payout-details" tabindex="-1" role="dialog" aria-labelledby="payout-details" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h3 class="modal-title" id="payout-details"> Payout Details </h3>
                </div>
                <div class="modal-body">
                    <table class="table" id="payout_details">
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"> Close </button>
                </div>
            </div>
        </div>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs" style="font-size: 14px">
        Laravel v<?php echo e(Illuminate\Foundation\Application::VERSION); ?> (PHP v<?php echo e(PHP_VERSION); ?>)
    </div>
    <strong><?php echo e(__('messages.admin.copyright')); ?> &copy; <?php echo e($copyright_year); ?> <a href="<?php echo e($copyright_url); ?>"> <?php echo e($copyright_name); ?> </a>.</strong> <?php echo e(__('messages.admin.all_rights_reserved')); ?>.
</footer>
<?php /**PATH C:\laragon\www\ridein25\resources\views/admin/common/footer.blade.php ENDPATH**/ ?>