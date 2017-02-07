<!-- BEGIN FOOTER -->
<?php if(isset($_G['route_name']) && $_G['route_name'] != 'home'): ?>
    <div class="page-footer">
        <div class="page-footer-inner col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <img src="/images/logo-dark.png" alt="logo" class="logo-default" width="150px" height="30px"  />
                </div>
                <div class="col-md-10">
                    <?php echo e(trans('common.about_us')); ?> | <?php echo e(trans('common.contact_us')); ?> | <?php echo e(trans('common.link')); ?> | <?php echo e(trans('common.help_us')); ?> | <?php echo e(trans('common.talents_wanted')); ?> | <?php echo e(trans('common.legal_notices')); ?> | <?php echo e(trans('common.member_policy')); ?> | <?php echo e(trans('common.price_list')); ?> | <?php echo e(trans('common.payment_method')); ?> | <?php echo e(trans('common.sitemap')); ?> | <?php echo e(trans('common.advertising')); ?>

                    <br/><br/>
                    <?php echo e(trans('common.company_name')); ?>　&copy;　2004 - <?php echo date('Y'); ?> &nbsp;&nbsp; 浙ICP备16007956号-1
                     &nbsp;&nbsp;<?php echo e(trans('common.customer_hotline')); ?> : 800-45685845
                </div>
            </div>
        </div>

        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
<?php endif; ?>