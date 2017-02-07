<?php $__env->startSection('title'); ?>
Login
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
Login
<?php $__env->stopSection(); ?>

<?php $__env->startSection('author'); ?>
vika
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link href="/custom/css/auth/login.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container" >
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9"><h4 class="caption-subject bold "> <?php echo e(trans('member.login')); ?></h4></div>
                        <div class="col-md-3"><h5><a href="javascript:;" onclick="$('#login-modal').modal('hide');return true;" data-toggle="modal" data-target="#forget-modal"><?php echo e(trans('member.register')); ?></a></h5></div>
                    </div>
                    <hr>
                        <?php echo Form::open(['route' => 'login.post', 'class' => 'form-horizontal member-form', 'id' => 'login-form']); ?>

                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="input-icon">
                                        <i class="fa fa-user"></i>
                                        <?php echo Form::text('login', '', ['class' => 'form-control', 'placeholder' => trans('member.contact_number')]); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="input-icon">
                                        <i class="fa fa-lock"></i>
                                        <?php echo Form::password('password', ['class' => 'form-control', 'placeholder' => trans('member.password')]); ?>

                                    </div>
                                    <span class="help-block" id="login-error-msg"><?php echo e(trans('member.id_password_incorrect')); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7">
                                    <h5><input type="checkbox" name="remember"> <?php echo e(trans('member.remember_me')); ?></h5>
                                </div>
                                <div class="col-md-5">
                                    <h5>
                                        <a href="javascript:;" onclick="$('#login-modal').modal('hide');return true;" data-toggle="modal" data-target="#forget-modal"><?php echo e(trans('member.forget_password')); ?></a>
                                    </h5>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <button type="button" class="btn blue btn-block" id="submit-login">
                                        <?php echo e(trans('member.login_now')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>


                    </div>
                    <div style="display: table; background-color:#f5f5f5;padding-top:10px;padding-bottom:10px">
                        <ul class="chats">
                            <li class="out">
                                <div class="col-md-6"><h5 style="padding-top:5px; text-align: left;">Social Login</h5></div>
                                <div class="col-md-2"><a href="<?php echo e(route('qq.login')); ?>"><img class="avatar" alt="" src="/images/1.jpg" /></a></div>
                                <?php if(isset($_G['is_weixin_browser']) && $_G['is_weixin_browser'] === true): ?>
                                    <div class="col-md-2"><a href="<?php echo e(route('weixin.login')); ?>"><img class="avatar" alt="" src="/images/2.jpg" /></a></div>
                                <?php else: ?>
                                    <div class="col-md-2"><a href="<?php echo e(route('weixinweb.login')); ?>"><img class="avatar" alt="" src="/images/2.jpg" /></a></div>
                                <?php endif; ?>
                                <div class="col-md-2"><a href="<?php echo e(route('weibo.login')); ?>"><img class="avatar" alt="" src="/images/3.jpg" /></a></div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
        <div class="row">

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<script>
		+function () {
			$(document).ready(function () {

			});
		}(jQuery);
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>