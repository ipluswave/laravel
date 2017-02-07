<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false"
            data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"></div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>

            <li class="nav-item start{{ Route::currentRouteName() == 'backend.index' ? ' active' : '' }}">
                <a href="{{ route('backend.index') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">首页</span>
                </a>
            </li>

            @if (Auth::guard('staff') && Auth::guard('staff')->user()->hasPermission('manage_staff'))
            <li class="nav-item{{ in_array(Route::currentRouteName(), ['backend.staff']) ? ' active' : ''  }}">
                <a href="{{ route('backend.staff') }}" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">操作员</span>
                </a>
            </li>
            @endif

            @if (Auth::guard('staff') && Auth::guard('staff')->user()->hasPermission('manage_permission_groups'))
            <li class="nav-item{{ in_array(Route::currentRouteName(), ['backend.permissions', 'backend.permissions.create', 'backend.permissions.edit']) ? ' active' : ''  }}">
                <a href="{{ route('backend.permissions') }}" class="nav-link nav-toggle">
                    <i class="fa fa-key"></i>
                    <span class="title">权限组</span>
                </a>
            </li>
            @endif

            @if (Auth::guard('staff') && Auth::guard('staff')->user()->hasPermission('manage_user'))
                <li class="nav-item{{ in_array(Route::currentRouteName(), ['backend.user']) ? ' active' : ''  }}">
                    <a href="{{ route('backend.user') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">会员</span>
                    </a>
                </li>
            @endif

            @if (Auth::guard('staff') && Auth::guard('staff')->user()->hasPermission('manage_category'))
                <li class="nav-item{{ in_array(Route::currentRouteName(), ['backend.category', 'backend.category.create', 'backend.category.edit']) ? ' active' : '' }}">
                    <a href="{{ route('backend.category') }}" class="nav-link nav-toggle">
                        <i class="fa fa-bookmark"></i>
                        <span class="title">目录管理</span>
                    </a>
                </li>
            @endif

            @if (Auth::guard('staff') && Auth::guard('staff')->user()->hasPermission('manage_bank'))
                <li class="nav-item{{ in_array(Route::currentRouteName(), ['backend.bank']) ? ' active' : '' }}">
                    <a href="{{ route('backend.bank') }}" class="nav-link nav-toggle">
                        <i class="fa fa-building"></i>
                        <span class="title">银行管理</span>
                    </a>
                </li>
            @endif

            @if (Auth::guard('staff') && Auth::guard('staff')->user()->hasPermission('manage_raw_material'))
                <li class="nav-item{{ in_array(Route::currentRouteName(), ['backend.rawmaterial']) ? ' active' : '' }}">
                    <a href="{{ route('backend.rawmaterial') }}" class="nav-link nav-toggle">
                        <i class="fa fa-tint"></i>
                        <span class="title">原材料管理</span>
                    </a>
                </li>
            @endif
            
            @if (Auth::guard('staff') && Auth::guard('staff')->user()->hasPermission('submit_id'))
                <li class="nav-item{{ in_array(Route::currentRouteName(), ['backend.user.submitid']) ? ' active' : '' }}">
                    <a href="{{ route('backend.user.submitid') }}" class="nav-link nav-toggle">
                        <i class="fa fa-thumbs-o-up"></i>
                        <span class="title"><?= Lang::get('member.submit_id'); ?></span>
                    </a>
                </li>
            @endif
            
            @if (Auth::guard('staff') && Auth::guard('staff')->user()->hasPermission('manage_order'))
                <li class="nav-item{{ in_array(Route::currentRouteName(), ['backend.order']) ? ' active' : '' }}">
                    <a href="{{ route('backend.order') }}" class="nav-link nav-toggle">
                        <i class="fa fa-opencart"></i>
                        <span class="title"><?= Lang::get('member.all_order'); ?></span>
                    </a>
                </li>
            @endif
            
            @if (Auth::guard('staff') && Auth::guard('staff')->user()->hasPermission('manage_order'))
                <li class="nav-item{{ in_array(Route::currentRouteName(), ['backend.order.conflict']) ? ' active' : '' }}">
                    <a href="{{ route('backend.order.conflict') }}" class="nav-link nav-toggle">
                        <i class="fa fa-commenting-o"></i>
                        <span class="title"><?= Lang::get('order.conflict_support'); ?></span>
                    </a>
                </li>
            @endif
            
            @if (Auth::guard('staff') && Auth::guard('staff')->user()->hasPermission('manage_withdraw'))
                <li class="nav-item{{ in_array(Route::currentRouteName(), ['backend.withdraw']) ? ' active' : '' }}">
                    <a href="{{ route('backend.withdraw') }}" class="nav-link nav-toggle">
                        <i class="fa fa-hand-lizard-o"></i>
                        <span class="title"><?= Lang::get('member.withdraw'); ?></span>
                    </a>
                </li>
            @endif
            
            @if (Auth::guard('staff') && Auth::guard('staff')->user()->hasPermission('manage_level'))
                <li class="nav-item{{ in_array(Route::currentRouteName(), ['backend.level']) ? ' active' : '' }}">
                    <a href="{{ route('backend.level') }}" class="nav-link nav-toggle">
                        <i class="fa fa-building"></i>
                        <span class="title">水平管理</span>
                    </a>
                </li>
            @endif
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->