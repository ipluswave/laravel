<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<!--Solve toggle switch problem for create order v2 page-->
<?php if( isset($_G['route_name']) && ($_G['route_name'] != 'frontend.createorderv2' ) && ($_G['route_name'] != 'frontend.editorderv2' ) ): ?>
    <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<?php endif; ?>

<link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->

<link href="/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />

<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="/assets/layouts/layout4/css/layout.css" rel="stylesheet" type="text/css" />
<link href="/assets/layouts/layout4/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<!-- BEGIN HEADER AND FOOTER PAGE STYLES -->
<link href="/custom/css/frontend/headerOrFooter.css" rel="stylesheet" type="text/css" />
<!-- END HEADER AND FOOTER PAGE STYLES -->
<link href="/css/global.css" rel="stylesheet" type="text/css" />
<link href="/css/frontend.css" rel="stylesheet" type="text/css" />