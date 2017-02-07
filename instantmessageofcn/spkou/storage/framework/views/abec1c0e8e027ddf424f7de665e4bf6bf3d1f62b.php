<!DOCTYPE html>
<!--[if IE 8]> <html lang="<?php echo e(trans('common.language')); ?>" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="<?php echo e(trans('common.language')); ?>" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?php echo e(trans('common.language')); ?>">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="<?php echo $__env->yieldContent('description'); ?>" name="description"/>
        <meta content="<?php echo $__env->yieldContent('author'); ?>" name="author"/>
        <meta property="wb:webmaster" content="4bfa78a5221bb48a" />
		<meta property="qc:admins" content="2552431241756375" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <?php echo $__env->make('frontend.includes.headscript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <link rel="shortcut icon" href="favicon.ico" />
        <?php $__env->startSection('header'); ?> <?php echo $__env->yieldSection(); ?>
        <!-- END HEAD -->
    </head>

    <body lang="<?php echo e(trans('common.language')); ?>" class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md" style="<?php echo e($bothSideMargin); ?>">
        <!-- BEGIN HEADER -->
        <?php echo $__env->make('frontend.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <?php if(isset($_G['route_name']) && $_G['route_name'] == 'home'): ?>
        <div style="height:5px; background-color:#ff8c34; padding-top: 80px;"></div>
        <?php endif; ?>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container" >
            <?php if(!isset($_G['disable_sidemenu']) || $_G['disable_sidemenu'] != true): ?>
                <?php echo $__env->make('frontend.includes.sidemenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if( isset($_G['route_name']) && $_G['route_name'] == 'frontend.tailororders' ): ?>
                <?php echo $__env->make('frontend.includes.searchOption', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if(isset($_G['disable_sidemenu']) && $_G['disable_sidemenu'] == true): ?>
                <?php echo $__env->make('frontend.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- END CONTAINER -->
        <?php echo $__env->make('frontend.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('frontend.includes.footscript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php $__env->startSection('footer'); ?> <?php echo $__env->yieldSection(); ?>
        <?php echo $__env->make('frontend.includes.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo Form::open(['id' => 'p-key-form']); ?>

        <?php echo Form::close(); ?>

        <?php echo $__env->make('frontend.includes.member', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </body>
</html>