<script type="text/javascript">
    +function () {
        $(document).ready(function () {
            <?php if(app()->getLocale() == 'cn'): ?>
                var sendAgainText = '%sS后重新发送';
            <?php else: ?>
                var sendAgainText = 'Send Again After %sS';
            <?php endif; ?>

            $('#register-form').makeAjaxForm({
                submitBtn: '#submit-register',
                container: '#register-form',
                beforeFunction: function ($el, $this) {
                    $('#register-form .help-block').hide();

                    alertClear();

                    return true;
                },
                afterSuccessFunction: function (response, $el, $this) {
                    if (response.status == 'success') {
                        $('#register-form')[0].reset();
                        $('#register-form').modal('hide');
                        alertSuccess(response.msg);
                        <?php if($_G['route_name'] == 'register'): ?>
                            window.location.href = '<?php echo e(route('login')); ?>';
                        <?php else: ?>
                            window.location.reload();
                        <?php endif; ?>
                    } else {
                        switch (response.msg) {
                            case '1101': $('#verification-code-empty-msg').show(); break;
                            case '1102': $('#password-error-msg').show(); break;
                            case '1103': $('#password-unmatch-msg').show(); break;
                            case '1104': $('#contact-number-invalid-msg').show(); break;
                            case '1105': $('#contact-number-registered-msg').show(); break;
                            case '1106': $('#tnc-error-msg').show(); break;
                            default:
                                alertError(response.msg);
                            break;
                        }
                    }
                },
                errorFunction: function (response, $el, $this) {
                    App.unblockUI($el);
                    alertError(response);
                }
            });

            $('#login-form').makeAjaxForm({
                submitBtn: '#submit-login',
                container: '#login-form',
                beforeFunction: function ($el, $this) {
                    $('#login-form .help-block').hide();

                    alertClear();

                    return true;
                },
                afterSuccessFunction: function (response, $el, $this) {
                    if (response.status == 'success') {
                        $('#login-form')[0].reset();
                        $('#login-form').modal('hide');
                        alertSuccess(response.msg);
                        <?php if($_G['route_name'] == 'login'): ?>
                            window.location.href = '<?php echo e(route('home')); ?>';
                        <?php else: ?>
                            window.location.reload();
                        <?php endif; ?>
                    } else {
                        switch (response.msg) {
                            case '1101': $('#login-error-msg').show(); break;
                            default:
                                alertError(response.msg);
                                break;
                        }
                    }
                },
                errorFunction: function (response, $el, $this) {
                    App.unblockUI($el);
                    alertError(response);
                }
            });

            $('#forget-form').makeAjaxForm({
                submitBtn: '#submit-forget',
                container: '#forget-form',
                beforeFunction: function ($el, $this) {
                    $('#forget-form .help-block').hide();

                    alertClear();

                    return true;
                },
                afterSuccessFunction: function (response, $el, $this) {
                    if (response.status == 'success') {
                        $('#forget-form')[0].reset();
                        $('#forget-form').modal('hide');
                        alertSuccess(response.msg);
                        <?php if($_G['route_name'] == 'auth.accountchangepassword.phone'): ?>
                            window.location.href = '<?php echo e(route('login')); ?>';
                        <?php else: ?>
                            $('#forget-modal').modal('hide');
                            $('#login-modal').modal('show');
                        <?php endif; ?>
                    } else {
                        switch (response.msg) {
                            case '1101': $('#forget-verification-code-empty-msg').show(); break;
                            case '1102': $('#forget-password-error-msg').show(); break;
                            case '1103': $('#forget-password-unmatch-msg').show(); break;
                            case '1104': $('#forget-contact-number-invalid-msg').show(); break;
                            default:
                                alertError(response.msg);
                                break;
                        }
                    }
                },
                errorFunction: function (response, $el, $this) {
                    App.unblockUI($el);
                    alertError(response);
                }

            });

            var cding = false;
            var counter = 60;

            $(document).on('click', '#send-verification-register', function () {
                $this = $(this);
                if (cding === false) {
                    var oriText = $this.html();

                    $.ajax({
                        url: '<?php echo e(route('auth.getsmsverification')); ?>',
                        method: 'post',
                        data: { contact_number: $('#register-contact-number').val() },
                        dataType: 'json',
                        beforeSend: function () {
                            cding = true;
                            alertClear();
                        },
                        success: function (resp) {
                            if (resp.status == 'success') {
                                var timer = setInterval(function () {
                                    if (counter > 0) {
                                        $this.html(sendAgainText.replace(/%s/, counter));
                                        counter--;
                                        cding = true;
                                        $this.attr('disabled', true);
                                    } else {
                                        $this.removeAttr('disabled');
                                        $this.html(oriText);
                                        clearInterval(timer);
                                        counter = 60;
                                        cding = false;
                                    }
                                }, 1000);
                                alertSuccess(resp.msg);
                            } else {
                                alertError(resp.msg);
                            }
                        },
                        error: function (resp) {
                            counter = 60;
                            cding = false;
                            alertError(resp);
                        },
                    });
                }
            });

            $(document).on('click', '#send-verification-forget', function () {
                $this = $(this);
                if (cding === false) {
                    var oriText = $this.html();

                    $.ajax({
                        url: '<?php echo e(route('auth.getresetsmsverification')); ?>',
                        method: 'post',
                        data: { contact_number: $('#forget-contact-number').val() },
                        dataType: 'json',
                        beforeSend: function () {
                            cding = true;
                            alertClear();
                        },
                        success: function (resp) {
                            if (resp.status == 'success') {
                                var timer = setInterval(function () {
                                    if (counter > 0) {
                                        $this.html(sendAgainText.replace(/%s/, counter));
                                        counter--;
                                        cding = true;
                                        $this.attr('disabled', true);
                                    } else {
                                        $this.removeAttr('disabled');
                                        $this.html(oriText);
                                        clearInterval(timer);
                                        counter = 60;
                                        cding = false;
                                    }
                                }, 1000);
                                alertSuccess(resp.msg);
                            } else {
                                alertError(resp.msg);
                            }
                        },
                        error: function (resp) {
                            counter = 60;
                            cding = false;
                            alertError(resp);
                        },
                    });
                }
            });
        });
    }(jQuery);
</script>
<?php if($_G['route_name'] != 'login'): ?>
<div id="login-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-member">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="row">
                    <div class="col-xs-8"><h4 class="modal-title bold uppercase"><?php echo e(trans('member.login')); ?></h4></div>
                    <div class="col-xs-4">
                        <a href="javascript:;" onclick="$('#login-modal').modal('hide');return true;" data-toggle="modal" data-target="#register-modal" class="pull-right"><?php echo e(trans('member.register')); ?></a>
                    </div>
                </div>
            </div>
            <div class="modal-body form">
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
                            <div class="col-md-8">
                                <h5><input type="checkbox" name="remember"> <?php echo e(trans('member.remember_me')); ?></h5>
                            </div>
                            <div class="col-md-4">
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
            <div class="modal-footer" style="background-color:#f5f5f5;padding-top:10px;padding-bottom:10px">
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
<?php endif; ?>

<?php if($_G['route_name'] != 'register'): ?>
<div id="register-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-member">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="row">
                    <div class="col-xs-8"><h4 class="modal-title bold uppercase"><?php echo e(trans('member.register_spkou_member')); ?></h4></div>
                    <div class="col-xs-4">

                    </div>
                </div>
            </div>
            <div class="modal-body form">
                <?php echo Form::open(['route' => 'register.post', 'class' => 'form-horizontal member-form', 'id' => 'register-form']); ?>

                <div class="form-body">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                <?php echo Form::text('contact_number', '', ['class' => 'form-control', 'placeholder' => trans('member.contact_number'), 'id' => 'register-contact-number']); ?>

                                <span class="help-block" id="contact-number-invalid-msg"><?php echo e(trans('member.contact_number_invalid')); ?></span>
                                <span class="help-block" id="contact-number-registered-msg"><?php echo e(trans('member.contact_number_registered')); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6" style="padding-right: 0;">
                            <div class="input-icon">
                                <i class="icon-sms"></i>
                                <?php echo Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => trans('member.verification_code')]); ?>

                                <span class="help-block" id="verification-code-empty-msg"><?php echo e(trans('member.please_keyin_verification_code')); ?></span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <button id="send-verification-register" class="btn btn-primary grey" type="button" style="width: 100%;">
                                <?php echo e(trans('member.get_verification_code')); ?>

                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-icon">
                                <i class="fa fa-lock"></i>
                                <?php echo Form::password('password', ['class' => 'form-control', 'placeholder' => trans('member.password')]); ?>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-icon">
                                <i class="fa fa-lock"></i>
                                <?php echo Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('member.confirm_password')]); ?>

                                <span class="help-block" id="password-error-msg"><?php echo e(trans('member.password_invalid')); ?></span>
                                <span class="help-block" id="password-unmatch-msg"><?php echo e(trans('member.password_not_match_confirmation_password')); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <h5>
                                <input type="checkbox" name="accept_tnc" value="1"> <?php echo e(trans('member.i_accept')); ?><span style="color:blue"><?php echo e(trans('member.terms_and_conditions')); ?></span><?php echo e(trans('member.and')); ?><span style="color:blue"><?php echo e(trans('member.privacy_policy')); ?></span>
                            </h5>
                            <span class="help-block" id="tnc-error-msg"><?php echo e(trans('member.please_accept_tnc')); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button type="button" class="btn blue btn-block" id="submit-register">
                                <?php echo e(trans('member.register_now')); ?>

                            </button>
                        </div>
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if($_G['route_name'] != 'auth.accountchangepassword.phone'): ?>
<div id="forget-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-member">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="row">
                    <div class="col-xs-8"><h4 class="modal-title bold uppercase"><?php echo e(trans('member.forget_password')); ?></h4></div>
                    <div class="col-xs-4">

                    </div>
                </div>
            </div>
            <div class="modal-body form">
                <?php echo Form::open(['route' => 'auth.accountchangepassword.phone', 'class' => 'form-horizontal member-form', 'id' => 'forget-form']); ?>

                <div class="form-body">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                <?php echo Form::text('contact_number', '', ['class' => 'form-control', 'placeholder' => trans('member.contact_number'), 'id' => 'forget-contact-number']); ?>

                                <span class="help-block" id="forget-contact-number-invalid-msg"><?php echo e(trans('member.contact_number_invalid')); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6" style="padding-right: 0;">
                            <div class="input-icon">
                                <i class="icon-sms"></i>
                                <?php echo Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => trans('member.verification_code')]); ?>

                                <span class="help-block" id="forget-verification-code-empty-msg"><?php echo e(trans('member.please_keyin_verification_code')); ?></span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <button id="send-verification-forget" class="btn btn-primary grey" type="button" style="width: 100%;">
                                <?php echo e(trans('member.get_verification_code')); ?>

                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-icon">
                                <i class="fa fa-lock"></i>
                                <?php echo Form::password('password', ['class' => 'form-control', 'placeholder' => trans('member.password')]); ?>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-icon">
                                <i class="fa fa-lock"></i>
                                <?php echo Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('member.confirm_password')]); ?>

                                <span class="help-block" id="forget-password-error-msg"><?php echo e(trans('member.password_invalid')); ?></span>
                                <span class="help-block" id="forget-password-unmatch-msg"><?php echo e(trans('member.password_not_match_confirmation_password')); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button type="button" class="btn blue btn-block" id="submit-forget">
                                <?php echo e(trans('member.change_password')); ?>

                            </button>
                        </div>
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>