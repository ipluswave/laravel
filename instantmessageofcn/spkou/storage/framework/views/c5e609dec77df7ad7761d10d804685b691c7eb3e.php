<div class="page-header navbar navbar-fixed-top" style="<?php echo e($bothSideMargin); ?>;box-shadow: 0 1px 10px 0 rgba(50,50,50,0.4);">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <div class="nav-top">
            <div class="pull-right top-submenu">
                <?php if(Session::get('lang') == 'cn'): ?>
                    <a href="<?php echo e(route('setlang', ['lang' => 'en', 'redirect' => Request::url()])); ?>"><?php echo e(trans('common.lang_active')); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <?php else: ?>
                    <a href="<?php echo e(route('setlang', ['lang' => 'cn', 'redirect' => Request::url()])); ?>"><?php echo e(trans('common.lang_active')); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <?php endif; ?>
                <a href="#"><?php echo e(trans('common.look_master')); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <?php if(Auth::guard('users')->guest()): ?>
                    <a href="#" data-toggle="modal" data-target="#register-modal"><?php echo e(trans('member.register')); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="#" data-toggle="modal" data-target="#login-modal"><?php echo e(trans('member.login')); ?></a>
                <?php else: ?>
                    <a href="<?php echo e(route('frontend.personalinformation')); ?>" ><?php echo e(Auth::guard('users')->user()->nick_name); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="<?php echo e(route('logout')); ?>"><?php echo e(trans('member.logout')); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <!--
        <?php if(isset($_G['route_name']) && ($_G['route_name'] == 'home' || $_G['route_name'] == 'register' || $_G['route_name'] == 'login' )): ?>
        <div style="height:5px; background-color:#ffffff"></div>
        <?php else: ?>
        <div style="height:5px; background-color:#008fd5"></div>
        <?php endif; ?>
        -->
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?php echo e(route('home')); ?>">
                <img src="/images/logo-light.png" alt="logo" class="logo-default" width="150px" height="30px"/>
            </a>
            <div class="top-nav-menu-div hidden-xs hidden-sm">
                <ul class="top-nav-menu">
                    <li>
                        <a href="<?php echo e(route('home')); ?>" class="<?php echo e(isset($_G['route_name']) && in_array($_G['route_name'], ['loggedin.home', 'home']) ? ' active' : ''); ?>">　<?php echo e(trans('common.home')); ?> </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('frontend.tailororders')); ?>" class="<?php echo e(isset($_G['route_name']) && in_array($_G['route_name'], ['frontend.tailororders']) ? ' active' : ''); ?>"> <?php echo e(trans('common.tailor_orders')); ?> </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('frontend.createorder')); ?>" class="<?php echo e(isset($_G['route_name']) && in_array($_G['route_name'], ['frontend.createorder']) ? ' active' : ''); ?>"> <?php echo e(trans('common.create_order')); ?> <i class="fa fa-plus"></i> </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('frontend.createorderv2')); ?>" class="<?php echo e(isset($_G['route_name']) && in_array($_G['route_name'], ['frontend.createorderv2']) ? ' active' : ''); ?>"> Create </a>
                    </li>
                </ul>
            </div>
            <div class="menu-toggler sidebar-toggler hide">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <?php if(Auth::guard('users')->guest()): ?>
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="dropdown" data-target=".guest-menu"> </a>
            <div class="guest-menu">
                <ul class="dropdown-menu pull-right" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <li class="nav-item start">
                         <a href="#" class="nav-link nav-toggle" data-toggle="modal" data-target="#register-modal">
                             <span class="title"><?php echo e(trans('member.register')); ?></span>
                             <span class="selected"></span>
                         </a>
                    </li>
                    <li class="nav-item start">
                        <a href="#" class="nav-link nav-toggle" data-toggle="modal" data-target="#login-modal">
                             <span class="title"><?php echo e(trans('member.login')); ?></span>
                             <span class="selected"></span>
                         </a>
                    </li>
                    <li class="nav-item start">
                         <a href="<?php echo e(route('setlang', ['lang' => 'en', 'redirect' => Request::url()])); ?>" class="nav-link nav-toggle">
                             <span class="title"><?php echo e(trans('common.lang_en')); ?></span>
                             <span class="selected"></span>
                         </a>
                    </li>
                    <li class="nav-item start">
                        <a href="<?php echo e(route('setlang', ['lang' => 'cn', 'redirect' => Request::url()])); ?>" class="nav-link nav-toggle">
                             <span class="title"><?php echo e(trans('common.lang_cn')); ?></span>
                             <span class="selected"></span>
                         </a>
                    </li>
                    <li role="presentation" class="divider"></li>
                    <li class="nav-item start">
                        <a href="<?php echo e(route('home')); ?>" class="nav-link nav-toggle">
                            <span class="title"><?php echo e(trans('common.home')); ?></span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="<?php echo e(route('frontend.tailororders')); ?>" class="nav-link nav-toggle">
                            <span class="title"><?php echo e(trans('common.tailor_orders')); ?> </span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="<?php echo e(route('frontend.createorder')); ?>" class="nav-link nav-toggle">
                            <span class="title"><?php echo e(trans('common.create_order')); ?></span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </div>
        <?php else: ?>
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="dropdown" data-target=".user-menu"> </a>
            <div class="user-menu">
                <ul class="dropdown-menu pull-right" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <li class="nav-item start">
                        <a href="<?php echo e(route('home')); ?>" class="nav-link nav-toggle">
                            <span class="title"><?php echo e(trans('common.home')); ?></span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="<?php echo e(route('frontend.tailororders')); ?>" class="nav-link nav-toggle">
                            <span class="title"><?php echo e(trans('common.tailor_orders')); ?> </span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="<?php echo e(route('frontend.createorder')); ?>" class="nav-link nav-toggle">
                            <span class="title"><?php echo e(trans('common.create_order')); ?></span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->
        <!--
        <div class="page-actions">
            <div class="btn-group">
                <button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <span class="hidden-sm hidden-xs">Actions&nbsp;</span>
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="javascript:;">
                            <i class="icon-docs"></i> New Post </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-tag"></i> New Comment </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-share"></i> Share </a>
                    </li>
                    <li class="divider"> </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-flag"></i> Comments
                            <span class="badge badge-success">4</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-users"></i> Feedbacks
                            <span class="badge badge-danger">2</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        -->
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top <?php echo e(isset($_G['route_name']) && ( $_G['route_name'] == 'register' ||  $_G['route_name'] == 'login' ||  $_G['route_name'] == 'home' ) ? ' hidden-xs hidden-sm' : ''); ?>">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
            <!--
            <form class="search-form" action="page_general_search_2.html" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="Search..." name="query">
                    <span class="input-group-btn">
                        <a href="javascript:;" class="btn submit">
                            <i class="icon-magnifier"></i>
                        </a>
                    </span>
                </div>
            </form>
            -->
            <!-- END HEADER SEARCH BOX -->

            <!-- Authentication Links -->
            <?php if(Auth::guard('users')->guest()): ?>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right hidden-md hidden-lg">
                    <li><a href="#" data-toggle="modal" data-target="#register-modal" class="<?php echo e(isset($_G['route_name']) && $_G['route_name'] == 'register' ? ' active' : ''); ?>"><?php echo e(trans('member.register')); ?></a></li>
                    <li><a href="#" data-toggle="modal" data-target="#login-modal" class="<?php echo e(isset($_G['route_name']) && $_G['route_name'] == 'login' ? ' active' : ''); ?>"><?php echo e(trans('member.login')); ?></a></li>
                    <li>
                        <a href="<?php echo e(route('setlang', ['lang' => 'en', 'redirect' => Request::url()])); ?>"><?php echo e(trans('common.lang_en')); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('setlang', ['lang' => 'cn', 'redirect' => Request::url()])); ?>"><?php echo e(trans('common.lang_cn')); ?></a>
                    </li>
                </ul>
            <?php else: ?>

                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu hidden">
                    <ul class="nav navbar-nav pull-right">
                        <li class="separator hide"> </li>
                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                            <a href="javascript:void(0);" class="dropdown-toggle chat-bell" data-url="<?php echo e(route('frontend.mychat.check')); ?>" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-bell"></i>
                                <span class="badge badge-info" id="unread-msg-counter"><?php echo e($_G['user']->unread_message); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>
                                        <span class="bold">0 pending</span> notifications</h3>
                                    <a href="<?php echo e(route('frontend.inbox')); ?>">view all</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">just now</span>
                                                         用户一<br/>
                                                         您编号为 NGC201603000027 的订单有一条新的短消息...
                                                     </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar1.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">3 mins</span>
                                                        用户二<br/>
                                                        您编号为 NGC201603000027 的订单已经被客户确认完成...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">10 mins</span>
                                                        师傅一<br/>
                                                        您编号为 NGC201603070018 的订单已将你选为制版师傅...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar4.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">14 hrs</span>
                                                        师傅二<br/>
                                                        您编号为 NGC201603000028 的订单有一条新的短消息...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar5.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">2 days</span>
                                                        用户三<br/>
                                                        您编号为 NGC201603000028 的订单有一条新的短消息...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar6.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">3 days</span>
                                                        师傅三<br/>
                                                        您编号为 NGC201603000028 的订单有一条新的短消息...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar7.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">1月21日</span>
                                                        用户四<br/>
                                                        您编号为 NGC201603000028 的订单有一条新的短消息...
                                                    </span>
                                                 </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar8.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">2月21日</span>
                                                        用户五<br/>
                                                        您编号为 NGC201603000028 的订单有一条新的短消息...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar9.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">3月21日</span>
                                                        师傅四<br/>
                                                        您编号为 NGC201603000028 的订单有一条新的短消息...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- END NOTIFICATION DROPDOWN -->
                        <li class="separator hide"> </li>
                        <!-- BEGIN INBOX DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                            <a href="<?php echo e(route('frontend.usercenter')); ?>" class="normal-link <?php echo e(isset($_G['route_name']) && $_G['route_name'] == 'frontend.usercenter' ? ' active' : ''); ?>" >
                                <span style="padding-right: 10px;"><?php echo e(trans('common.user_center')); ?></span>
                            </a>
                            <!--
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>You have
                                        <span class="bold">7 New</span> Messages</h3>
                                    <a href="javascript:;l">view all</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                    <img src="/assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> Lisa Wong </span>
                                                    <span class="time">Just Now </span>
                                                </span>
                                                <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                    <img src="/assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> Richard Doe </span>
                                                    <span class="time">16 mins </span>
                                                </span>
                                                <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                    <img src="/assets/layouts/layout3/img/avatar1.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> Bob Nilson </span>
                                                    <span class="time">2 hrs </span>
                                                </span>
                                                <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                    <img src="/assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> Lisa Wong </span>
                                                    <span class="time">40 mins </span>
                                                </span>
                                                <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                    <img src="/assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> Richard Doe </span>
                                                    <span class="time">46 mins </span>
                                                </span>
                                                <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            -->
                        </li>
                        <!-- END INBOX DROPDOWN -->
                        <li class="separator hide"> </li>
                        <!-- BEGIN TODO DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <!--
                        <li class="dropdown dropdown-extended dropdown-tasks dropdown-dark" id="header_task_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-calendar"></i>
                                <span class="badge badge-primary"> 3 </span>
                            </a>
                            <ul class="dropdown-menu extended tasks">
                                <li class="external">
                                    <h3>You have
                                        <span class="bold">12 pending</span> tasks</h3>
                                    <a href="?p=page_todo_2">view all</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                        <li>
                                            <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">New release v1.2 </span>
                                                    <span class="percent">30%</span>
                                                </span>
                                                <span class="progress">
                                                    <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">Application deployment</span>
                                                    <span class="percent">65%</span>
                                                </span>
                                                <span class="progress">
                                                    <span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">65% Complete</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">Mobile app release</span>
                                                    <span class="percent">98%</span>
                                                </span>
                                                <span class="progress">
                                                    <span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">98% Complete</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">Database migration</span>
                                                    <span class="percent">10%</span>
                                                </span>
                                                <span class="progress">
                                                    <span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">10% Complete</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">Web server upgrade</span>
                                                    <span class="percent">58%</span>
                                                </span>
                                                <span class="progress">
                                                    <span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">58% Complete</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">Mobile development</span>
                                                    <span class="percent">85%</span>
                                                </span>
                                                <span class="progress">
                                                    <span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">85% Complete</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">New UI release</span>
                                                    <span class="percent">38%</span>
                                                </span>
                                                <span class="progress progress-striped">
                                                    <span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">38% Complete</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        -->
                        <!-- END TODO DROPDOWN -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="username username-hide-on-mobile">
                                    <?php echo e(Auth::guard('users')->user()->nick_name); ?>

                                </span>
                                <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                <img alt="" class="img-circle" src="<?php echo e($_G['user']->getAvatar()); ?>" style="width: 39px; height: 39px;" /> </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="javascript:;">
                                        <?php echo e(trans('common.level')); ?> : 50
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('frontend.identityauthentication')); ?>">
                                        <i class="fa fa-credit-card"></i> <?php echo e(trans('common.identity_authentication')); ?>

                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('frontend.skillverification')); ?>">
                                        <i class="icon-pie-chart"></i> <?php echo e(trans('common.skill_verification')); ?>

                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('frontend.myaccount')); ?>">
                                        <i class="fa fa-bank"></i> <?php echo e(trans('common.my_bank_account')); ?>

                                    </a>
                                </li>
                                <li>
                                    <div style="padding-left: 45px;">
                                        <span style="padding-right: 20px;">
                                            <a href="<?php echo e(route('setlang', ['lang' => 'en', 'redirect' => Request::url()])); ?>"><?php echo e(trans('common.lang_en')); ?></a>
                                        </span>
                                        <span>
                                            <a href="<?php echo e(route('setlang', ['lang' => 'cn', 'redirect' => Request::url()])); ?>"><?php echo e(trans('common.lang_cn')); ?></a>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>">
                                        <i class="icon-logout"></i> <?php echo e(trans('member.logout')); ?> </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                        <li class="dropdown dropdown-extended quick-sidebar-toggler hide">
                            <span class="sr-only">Toggle Quick Sidebar</span>
                            <i class="icon-logout"></i>
                        </li>
                        <!-- END QUICK SIDEBAR TOGGLER -->
                    </ul>
                </div>
                <!-- end -->

                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="separator hide"> </li>

                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle user-submenu" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="padding-right:0;padding-left:0;margin-top: 5px;">
                                <?php echo e(trans('common.my_order_btn')); ?>

                            </a>    
                            <ul class="dropdown-menu my-order-dropdown dropdown-menu-default">
                                <li>
                                    <a href="#">
                                        <span class="photo">
                                            <img src="/images/my-order2.png" width="20px" alt="">
                                        </span>
                                        <span class="details">
                                            <?php echo e(trans('common.my_order')); ?>

                                        </span>
                                        <span class="pull-right badge badge-success">5</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo">
                                            <img src="/images/my-order1.png" width="20px" alt="">
                                        </span>
                                        <span class="details">
                                            <?php echo e(trans('common.my_order_order')); ?>

                                        </span>
                                        <span class="pull-right badge badge-danger">2</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- END NOTIFICATION DROPDOWN -->
                        <li class="separator hide"> </li>

                        <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                            <a href="javascript:void(0);" class="dropdown-toggle chat-bell" data-url="<?php echo e(route('frontend.mychat.check')); ?>" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-bell"></i>
                                <span class="badge badge-info" id="unread-msg-counter"><?php echo e($_G['user']->unread_message); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>
                                        <span class="bold">0 pending</span> notifications</h3>
                                    <a href="<?php echo e(route('frontend.inbox')); ?>">view all</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">just now</span>
                                                         用户一<br/>
                                                         您编号为 NGC201603000027 的订单有一条新的短消息...
                                                     </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar1.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">3 mins</span>
                                                        用户二<br/>
                                                        您编号为 NGC201603000027 的订单已经被客户确认完成...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">10 mins</span>
                                                        师傅一<br/>
                                                        您编号为 NGC201603070018 的订单已将你选为制版师傅...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar4.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">14 hrs</span>
                                                        师傅二<br/>
                                                        您编号为 NGC201603000028 的订单有一条新的短消息...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar5.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">2 days</span>
                                                        用户三<br/>
                                                        您编号为 NGC201603000028 的订单有一条新的短消息...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar6.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">3 days</span>
                                                        师傅三<br/>
                                                        您编号为 NGC201603000028 的订单有一条新的短消息...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar7.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">1月21日</span>
                                                        用户四<br/>
                                                        您编号为 NGC201603000028 的订单有一条新的短消息...
                                                    </span>
                                                 </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar8.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">2月21日</span>
                                                        用户五<br/>
                                                        您编号为 NGC201603000028 的订单有一条新的短消息...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route("frontend.inbox")); ?>">
                                                <div class="row">
                                                    <span class="photo col-md-2">
                                                        <img src="/assets/layouts/layout3/img/avatar9.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="details col-md-10">
                                                        <span class="time">3月21日</span>
                                                        师傅四<br/>
                                                        您编号为 NGC201603000028 的订单有一条新的短消息...
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                         <!-- END NOTIFICATION DROPDOWN -->
                        <li class="separator hide"> </li>
                        
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle user-submenu" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="padding-right:0;padding-left:0;">
                                <span class="username username-hide-on-mobile hidden-md hidden-lg">
                                    <i class="fa fa-caret-down"></i>
                                </span>
                                <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                <img alt="" class="img-circle" src="<?php echo e($_G['user']->getAvatar()); ?>" style="width: 39px; height: 39px;" /> </a>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                        <li class="dropdown dropdown-extended quick-sidebar-toggler hide">
                            <span class="sr-only">Toggle Quick Sidebar</span>
                            <i class="icon-logout"></i>
                        </li>
                        <!-- END QUICK SIDEBAR TOGGLER -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            <?php endif; ?>
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>