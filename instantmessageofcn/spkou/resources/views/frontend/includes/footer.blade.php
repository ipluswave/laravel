<!-- BEGIN FOOTER -->
@if (isset($_G['route_name']) && $_G['route_name'] != 'home')
    <div class="page-footer">
        <div class="page-footer-inner col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <img src="/images/logo-dark.png" alt="logo" class="logo-default" width="150px" height="30px"  />
                </div>
                <div class="col-md-10">
                    {{ trans('common.about_us')}} | {{ trans('common.contact_us')}} | {{ trans('common.link')}} | {{ trans('common.help_us')}} | {{ trans('common.talents_wanted')}} | {{ trans('common.legal_notices')}} | {{ trans('common.member_policy')}} | {{ trans('common.price_list')}} | {{ trans('common.payment_method')}} | {{ trans('common.sitemap')}} | {{ trans('common.advertising')}}
                    <br/><br/>
                    {{ trans('common.company_name')}}　&copy;　2004 - <?php echo date('Y'); ?> &nbsp;&nbsp; 浙ICP备16007956号-1
                     &nbsp;&nbsp;{{ trans('common.customer_hotline')}} : 800-45685845
                </div>
            </div>
        </div>

        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
@endif