<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['users']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index', 'disable_sidemenu' => true]);

    Route::get('payment/callback', ['as' => 'payment.callback', 'uses' => 'Frontend\PaymentController@paymentCallback', 'disable_sidemenu' => true]);
    Route::get('payment/showqr', ['as' => 'payment.showqr', 'uses' => 'Frontend\PaymentController@showQr', 'disable_sidemenu' => true]);
    Route::get('payment/checkpayment', ['as' => 'payment.checkpayment', 'uses' => 'Frontend\PaymentController@checkPayment']);

    Route::get('setlang/{lang}', ['as' => 'setlang', 'uses' => 'EtcController@setLang']);

    Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@login', 'disable_sidemenu' => true]);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\AuthController@loginPost']);
    Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@register', 'disable_sidemenu' => true]);
    Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\AuthController@registerPost']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
    Route::get('password/email', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@getEmail', 'disable_sidemenu' => true]);
    Route::post('password/email', ['as' => 'password.reset.post', 'uses' => 'Auth\PasswordController@postEmail', 'disable_sidemenu' => true]);

    Route::get('password/reset/{token}', ['as' => 'password.reset.set', 'uses' => 'Auth\PasswordController@getReset', 'disable_sidemenu' => true]);
    Route::post('password/reset', ['as' => 'password.reset.set.post', 'uses' => 'Auth\PasswordController@postReset', 'disable_sidemenu' => true]);

//    Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@showResetForm', 'disable_sidemenu' => true]);
//    Route::post('password/email', ['as' => 'password.reset.post', 'uses' => 'Auth\PasswordController@postReset', 'disable_sidemenu' => true]);

    Route::get('home', ['as' => 'loggedin.home', 'uses' => 'HomeController@index', 'disable_sidemenu' => true]);
    Route::get('home/storeScreenWidth', ['as' => 'home.storescreenwidth', 'uses' => 'HomeController@storeScreenWidth', 'disable_sidemenu' => true]);

    Route::get('auth/weibo', ['as' => 'weibo.login', 'uses' => 'AuthController@weiboLogin']);
    Route::get('auth/weibo/callback', ['as' => 'weibo.login.callback', 'uses' => 'AuthController@weiboCallback', 'disable_sidemenu' => true]);

    Route::get('auth/weixin', ['as' => 'weixin.login', 'uses' => 'AuthController@weixinLogin']);
    Route::get('auth/weixinweb', ['as' => 'weixinweb.login', 'uses' => 'AuthController@weixinwebLogin']);
    Route::get('auth/weixin/callback', ['as' => 'weixin.login.callback', 'uses' => 'AuthController@weixinCallback', 'disable_sidemenu' => true]);
    Route::get('auth/weixinweb/callback', ['as' => 'weixinweb.login.callback', 'uses' => 'AuthController@weixinwebCallback', 'disable_sidemenu' => true]);

    Route::get('auth/qq', ['as' => 'qq.login', 'uses' => 'AuthController@qqLogin']);
    Route::get('auth/qq/callback', ['as' => 'qq.login.callback', 'uses' => 'AuthController@qqCallback', 'disable_sidemenu' => true]);

    Route::post('auth/getSmsVerification', ['as' => 'auth.getsmsverification', 'uses' => 'AuthController@getVerificationSms']);
    Route::post('auth/getResetSmsVerification', ['as' => 'auth.getresetsmsverification', 'uses' => 'AuthController@getResetVerificationSms']);
    Route::any('auth/account/reset/phone', ['as' => 'auth.accountchangepassword.phone', 'uses' => 'Auth\PasswordController@accountChangePasswordForPhone', 'disable_sidemenu' => true]);

    //Frontend logged in route
    Route::group(array('namespace' => 'Frontend', 'middleware' => ['auth:users']), function() {
        Route::get('/myAccount', ['as' => 'frontend.myaccount', 'uses' => 'MyAccountController@index']);
        Route::post('/myAccount/create', ['as' => 'frontend.myaccount.create', 'uses' => 'MyAccountController@create']);
        Route::post('/myAccount/delete/{id}', ['as' => 'frontend.myaccount.delete', 'uses' => 'MyAccountController@delete']);
        Route::get('/identityAuthentication', ['as' => 'frontend.identityauthentication', 'uses' => 'IdentityAuthenticationController@index']);
        Route::post('/identityAuthentication/create', ['as' => 'frontend.identityauthentication.create', 'uses' => 'IdentityAuthenticationController@create']);
        Route::get('/identityAuthentication/delete', ['as' => 'frontend.identityauthentication.delete', 'uses' => 'IdentityAuthenticationController@delete']);
        Route::get('/invite', ['as' => 'frontend.invite', 'uses' => 'InviteController@index']);
        Route::get('/skillVerification', ['as' => 'frontend.skillverification', 'uses' => 'SkillVerificationController@index']);
        Route::post('/skillVerification/update', ['as' => 'frontend.skillverification.update', 'uses' => 'SkillVerificationController@update']);
        Route::get('/myOrder', ['as' => 'frontend.myorder', 'uses' => 'MyOrderController@index']);
        Route::get('/myPublishOrder', ['as' => 'frontend.mypublishorder', 'uses' => 'MyPublishOrderController@index']);
        Route::get('/myRating', ['as' => 'frontend.myrating', 'uses' => 'MyRatingController@index']);

        //Verification route
        Route::get('/verificationCenter', ['as' => 'frontend.verificationcenter', 'uses' => 'VerificationController@index']);
        Route::get('/verification/master', ['as' => 'frontend.verification.master.verify', 'uses' => 'VerificationController@masterVerify']);
        Route::post('/verification/master/post', ['as' => 'frontend.verification.master.verify.post', 'uses' => 'VerificationController@masterVerifyPost']);
        Route::post('/verification/master', ['as' => 'frontend.verification.master.verfifyagain', 'uses' => 'VerificationController@masterVerifyAgain']);
        
        Route::get('/myPublishOrderDetails/{id}', ['as' => 'frontend.mypublishorderdetails', 'uses' => 'MyPublishOrderDetailsController@index']);
        Route::get('/myPublishOrderDetailsWebSocket/{id}', ['as' => 'frontend.mypublishorderdetails.websocket', 'uses' => 'MyPublishOrderDetailsController@indexWebSocket']);
        
        Route::post('/myPublishOrderDetails/createExtraSize', ['as' => 'frontend.mypublishorderdetails.createextrasize', 'uses' => 'MyPublishOrderDetailsController@create']);
        Route::get('/tailorOrders', ['as' => 'frontend.tailororders', 'uses' => 'TailorOrdersController@index', 'disable_sidemenu' => true]);
        Route::any('/createOrder', ['as' => 'frontend.createorder', 'uses' => 'CreateOrderController@index', 'disable_sidemenu' => true]);
        Route::get('/deleteOrder/{id}', ['as' => 'frontend.deleteorder', 'uses' => 'CreateOrderController@delete', 'disable_sidemenu' => true]);
        Route::any('/editOrder/{id}', ['as' => 'frontend.editorder', 'uses' => 'CreateOrderController@editOrder', 'disable_sidemenu' => true]);
        Route::post('/saveOrder/{orderstep}', ['as' => 'frontend.saveorder', 'uses' => 'CreateOrderController@saveOrder']);
        Route::get('/personalInformation', ['as' => 'frontend.personalinformation', 'uses' => 'PersonalInformationController@index']);
        Route::post('/personalInformation/update', ['as' => 'frontend.personalinformation.update', 'uses' => 'PersonalInformationController@update']);
        Route::get('/personalInformation/getCity', ['as' => 'frontend.personalinformation.getcity', 'uses' => 'PersonalInformationController@getCity']);
        Route::get('/personalInformation/getArea', ['as' => 'frontend.personalinformation.getarea', 'uses' => 'PersonalInformationController@getArea']);
        Route::get('/userCenter', ['as' => 'frontend.usercenter', 'uses' => 'UserCenterController@index']);
        Route::get('/inbox', ['as' => 'frontend.inbox', 'uses' => 'InboxController@index']);
        Route::post('/readinbox', ['as' => 'frontend.readinbox', 'uses' => 'InboxController@readInbox']);
        Route::get('/systemMessage', ['as' => 'frontend.systemmessage', 'uses' => 'SystemMessageController@index']);
        Route::get('/trash', ['as' => 'frontend.trash', 'uses' => 'TrashController@index']);

        Route::get('/getcategory/level2', ['as' => 'frontend.getcategory.leveltwo', 'uses' => 'CreateOrderController@levelTwo', 'disable_sidemenu' => true]);
        Route::get('/getcategory/level3', ['as' => 'frontend.getcategory.levelthree', 'uses' => 'CreateOrderController@levelThree', 'disable_sidemenu' => true]);
        Route::get('/orderDetails/{id}', ['as' => 'frontend.order.details', 'uses' => 'OrderController@details']);
        Route::post('/approveTailor/{id?}', ['as' => 'frontend.applicant.approve', 'uses' => 'OrderController@approveApplicant']);
        Route::get('/getfiltervalue/{id?}', ['as' => 'frontend.getfiltervalue', 'uses' => 'TailorOrdersController@getFilterValue']);

        Route::get('/checkcategory/level2', ['as' => 'frontend.checkcategory.leveltwo', 'uses' => 'CheckCategoryController@levelTwo', 'disable_sidemenu' => true]);
        Route::get('/checkcategory/level3', ['as' => 'frontend.checkcategory.levelthree', 'uses' => 'CheckCategoryController@levelThree', 'disable_sidemenu' => true]);

        Route::get('/checktailor/{id}', ['as' => 'frontend.checktailor', 'uses' => 'CheckTailorController@index']);

        //Tailor only route
        Route::post('/order/apply/{id?}', ['as' => 'frontend.order.apply', 'uses' => 'OrderController@applyOrder', 'middleware' => 'tailorOnly']);
        Route::post('/order/applydelete/{id?}', ['as' => 'frontend.order.applydelete', 'uses' => 'OrderController@deleteApplyOrder', 'middleware' => 'tailorOnly']);

        Route::any('/createOrderv2', ['as' => 'frontend.createorderv2', 'uses' => 'CreateOrderV2Controller@index', 'disable_sidemenu' => true]);
        Route::get('/createOrderv2/getLevel2Category', ['as' => 'frontend.getleveltwocategory', 'uses' => 'CreateOrderV2Controller@getLevel2Category', 'disable_sidemenu' => true]);
        Route::get('/createOrderv2/getLevel3Category', ['as' => 'frontend.getlevelthreecategory.', 'uses' => 'CreateOrderV2Controller@getLevel3Category', 'disable_sidemenu' => true]);
        Route::any('/editOrderv2/{id}', ['as' => 'frontend.editorderv2', 'uses' => 'CreateOrderV2Controller@editOrder', 'disable_sidemenu' => true]);
    });
	Route::group(array('namespace' => 'Frontend', 'middleware' => ['auth:users']), function() {
		//chat
        Route::get('/myChat', ['as' => 'frontend.mychat', 'uses' => 'MyChatController@index']);
        Route::get('/myChat/pullChat/{id}', ['as' => 'frontend.mychat.pullchat', 'uses' => 'MyChatController@pullChat']);
        Route::get('/myChat/pullOrderChat/{id}', ['as' => 'frontend.mychat.pullorderchat', 'uses' => 'MyChatController@pullOrderChat']);
        Route::get('/myChat/pullOrderChatFile/{id}', ['as' => 'frontend.mychat.pullorderchatfile', 'uses' => 'MyChatController@pullOrderChatFile']);
        Route::post('/myChat/postChat', ['as' => 'frontend.mychat.postchat', 'uses' => 'MyChatController@postChat']);
        Route::post('/myChat/postOrderChat', ['as' => 'frontend.mychat.postorderchat', 'uses' => 'MyChatController@postOrderChat']);
        Route::post('/myChat/postOrderChatFile', ['as' => 'frontend.mychat.postorderchatfile', 'uses' => 'MyChatController@postOrderChatFile']);
        Route::post('/myChat/postOrderChatImage', ['as' => 'frontend.mychat.postorderchatimage', 'uses' => 'MyChatController@postOrderChatImage']);
        Route::get('/myChat/postInviteHelpdeskChat/{id}', ['as' => 'frontend.mychat.postinvitehelpdeskchat', 'uses' => 'MyChatController@postInviteHelpdeskChat']);
        Route::get('/myChat/checkNew', ['as' => 'frontend.mychat.check', 'uses' => 'MyChatController@checkNewChat']);
        //order detail
        Route::get('/myPublishOrderDetailsChat', ['as' => 'frontend.mypublishorderdetails.chat', 'uses' => 'MyPublishOrderDetailsController@ChatModule']);
    });
    //Backend route
    Route::group(array('namespace' => 'Auth', 'middleware' => ['guest:staff']), function() {
        //Backend not logged in route
        Route::group(array('middleware' => ['guest:staff']), function () {
            Route::get('/staff/login', ['as' => 'staff.login', 'uses' => 'StaffController@login']);
            Route::post('/staff/login/post', ['as' => 'staff.login.post', 'uses' => 'StaffController@loginPost']);
        });
    });

    //Backend route
    Route::group(array('prefix' => 'admin', 'namespace' => 'Backend', 'middleware' => ['auth:staff']), function () {
        Route::get('/', ['as' => 'backend.index', 'uses' => 'IndexController@index']);

        //manage_permission_groups related
        Route::get('/permissions', ['as' => 'backend.permissions', 'uses' => 'PermissionController@index', 'middleware' => 'staffHasPermission:manage_permission_groups']);
        Route::get('/permissions/dt', ['as' => 'backend.permissions.dt', 'uses' => 'PermissionController@indexDt', 'middleware' => 'staffHasPermission:manage_permission_groups']);
        Route::get('/permissions/create', ['as' => 'backend.permissions.create', 'uses' => 'PermissionController@create', 'middleware' => 'staffHasPermission:manage_permission_groups']);
        Route::post('/permissions/create', ['as' => 'backend.permissions.create.post', 'uses' => 'PermissionController@createPost', 'middleware' => 'staffHasPermission:manage_permission_groups']);
        Route::get('/permissions/edit/{id}', ['as' => 'backend.permissions.edit', 'uses' => 'PermissionController@edit', 'middleware' => 'staffHasPermission:manage_permission_groups']);
        Route::post('/permissions/edit/{id}', ['as' => 'backend.permissions.edit.post', 'uses' => 'PermissionController@editPost', 'middleware' => 'staffHasPermission:manage_permission_groups']);
        Route::post('/permissions/delete/{id}', ['as' => 'backend.permissions.delete', 'uses' => 'PermissionController@delete', 'middleware' => 'staffHasPermission:manage_permission_groups']);

        //manage_staff related
        Route::get('/staff', ['as' => 'backend.staff', 'uses' => 'StaffController@index', 'middleware' => 'staffHasPermission:manage_staff']);
        Route::get('/staff/dt', ['as' => 'backend.staff.dt', 'uses' => 'StaffController@indexDt', 'middleware' => 'staffHasPermission:manage_staff']);
        Route::get('/staff/create', ['as' => 'backend.staff.create', 'uses' => 'StaffController@create', 'middleware' => 'staffHasPermission:manage_staff']);
        Route::post('/staff/create', ['as' => 'backend.staff.create.post', 'uses' => 'StaffController@createPost', 'middleware' => 'staffHasPermission:manage_staff']);
        Route::get('/staff/edit/{id}', ['as' => 'backend.staff.edit', 'uses' => 'StaffController@edit', 'middleware' => 'staffHasPermission:manage_staff']);
        Route::post('/staff/edit/{id}', ['as' => 'backend.staff.edit.post', 'uses' => 'StaffController@editPost', 'middleware' => 'staffHasPermission:manage_staff']);
        Route::post('/staff/delete/{id}', ['as' => 'backend.staff.delete', 'uses' => 'StaffController@delete', 'middleware' => 'staffHasPermission:manage_staff']);

        //manage_member related
        Route::get('/user', ['as' => 'backend.user', 'uses' => 'UserController@index', 'middleware' => 'staffHasPermission:manage_user']);
        Route::get('/user/dt', ['as' => 'backend.user.dt', 'uses' => 'UserController@indexDt', 'middleware' => 'staffHasPermission:manage_user']);
        Route::get('/user/create', ['as' => 'backend.user.create', 'uses' => 'UserController@create', 'middleware' => 'staffHasPermission:manage_user']);
        Route::post('/user/create', ['as' => 'backend.user.create.post', 'uses' => 'UserController@createPost', 'middleware' => 'staffHasPermission:manage_user']);
        Route::get('/user/edit/{member_id}', ['as' => 'backend.user.edit', 'uses' => 'UserController@edit', 'middleware' => 'staffHasPermission:manage_user']);
        Route::post('/user/edit/{member_id}', ['as' => 'backend.user.edit.post', 'uses' => 'UserController@editPost', 'middleware' => 'staffHasPermission:manage_user']);
        Route::post('/user/delete/{member_id}', ['as' => 'backend.user.delete', 'uses' => 'UserController@delete', 'middleware' => 'staffHasPermission:manage_user']);
		Route::get('/user/info/{member_id}', ['as' => 'backend.user.info', 'uses' => 'UserController@info', 'middleware' => 'staffHasPermission:manage_user']);
		Route::get('/user/rating/{member_id}', ['as' => 'backend.user.rating', 'uses' => 'UserController@rating', 'middleware' => 'staffHasPermission:manage_user']);
		Route::get('/user/rating_dt', ['as' => 'backend.user.rating.dt', 'uses' => 'UserController@ratingDt', 'middleware' => 'staffHasPermission:manage_user']);
		Route::get('/user/rating/edit/{rating_id}', ['as' => 'backend.user.rating.edit', 'uses' => 'UserController@ratingEdit', 'middleware' => 'staffHasPermission:manage_user']);
        Route::post('/user/rating/edit/{rating_id}', ['as' => 'backend.user.rating.edit.post', 'uses' => 'UserController@ratingEditPost', 'middleware' => 'staffHasPermission:manage_user']);
        Route::post('/user/rating/delete/{rating_id}', ['as' => 'backend.user.rating.delete', 'uses' => 'UserController@ratingDelete', 'middleware' => 'staffHasPermission:manage_user']);
		
		// submit ID
		Route::get('/user/submit_id', ['as' => 'backend.user.submitid', 'uses' => 'UserController@submitID', 'middleware' => 'staffHasPermission:submit_id']);
		Route::get('/user/submit_id_dt', ['as' => 'backend.user.submitid.dt', 'uses' => 'UserController@submitIDDt', 'middleware' => 'staffHasPermission:submit_id']);
		Route::post('/user/approve/{request_id}', ['as' => 'backend.user.approve.id', 'uses' => 'UserController@approveId', 'middleware' => 'staffHasPermission:submit_id']);
        Route::post('/user/reject/{request_id}', ['as' => 'backend.user.reject.id', 'uses' => 'UserController@rejectId', 'middleware' => 'staffHasPermission:submit_id']);
		
		// Tailor Request
		// Route::get('/user/tailor_request', ['as' => 'backend.user.tailor.request', 'uses' => 'UserController@tailorRequest', 'middleware' => 'staffHasPermission:tailor_request']);
		// Route::get('/user/tailor_request_dt', ['as' => 'backend.user.tailor.request.dt', 'uses' => 'UserController@tailorRequestDt', 'middleware' => 'staffHasPermission:tailor_request']);
		// Route::post('/user/approve_tailor/{request_id}', ['as' => 'backend.user.approve.tailor.id', 'uses' => 'UserController@approveTailor', 'middleware' => 'staffHasPermission:tailor_request']);
        // Route::post('/user/reject_tailor/{request_id}', ['as' => 'backend.user.reject.tailor.id', 'uses' => 'UserController@rejectTailor', 'middleware' => 'staffHasPermission:tailor_request']);
		
		
        //manage_category related
        Route::get('/category/index/{id?}', ['as' => 'backend.category', 'uses' => 'CategoryController@index', 'middleware' => 'staffHasPermission:manage_category']);
        Route::get('/category/dt/{id?}', ['as' => 'backend.category.dt', 'uses' => 'CategoryController@indexDt', 'middleware' => 'staffHasPermission:manage_category']);
        Route::get('/category/create/{id?}', ['as' => 'backend.category.create', 'uses' => 'CategoryController@create', 'middleware' => 'staffHasPermission:manage_category']);
        Route::post('/category/create/{id?}', ['as' => 'backend.category.create.post', 'uses' => 'CategoryController@createPost', 'middleware' => 'staffHasPermission:manage_category']);
        Route::get('/category/edit/{id}', ['as' => 'backend.category.edit', 'uses' => 'CategoryController@edit', 'middleware' => 'staffHasPermission:manage_category']);
        Route::post('/category/edit/{id}', ['as' => 'backend.category.edit.post', 'uses' => 'CategoryController@editPost', 'middleware' => 'staffHasPermission:manage_category']);
        Route::post('/category/delete/{id}', ['as' => 'backend.category.delete', 'uses' => 'CategoryController@delete', 'middleware' => 'staffHasPermission:manage_category']);

        //manage_bank related
        Route::get('/bank', ['as' => 'backend.bank', 'uses' => 'BankController@index', 'middleware' => 'staffHasPermission:manage_bank']);
        Route::get('/bank/dt', ['as' => 'backend.bank.dt', 'uses' => 'BankController@indexDt', 'middleware' => 'staffHasPermission:manage_bank']);
        Route::get('/bank/create', ['as' => 'backend.bank.create', 'uses' => 'BankController@create', 'middleware' => 'staffHasPermission:manage_bank']);
        Route::post('/bank/create', ['as' => 'backend.bank.create.post', 'uses' => 'BankController@createPost', 'middleware' => 'staffHasPermission:manage_bank']);
        Route::get('/bank/edit/{id}', ['as' => 'backend.bank.edit', 'uses' => 'BankController@edit', 'middleware' => 'staffHasPermission:manage_bank']);
        Route::post('/bank/edit/{id}', ['as' => 'backend.bank.edit.post', 'uses' => 'BankController@editPost', 'middleware' => 'staffHasPermission:manage_bank']);
        Route::post('/bank/delete/{id}', ['as' => 'backend.bank.delete', 'uses' => 'BankController@delete', 'middleware' => 'staffHasPermission:manage_bank']);

        //manage_raw_material related
        Route::get('/rawmaterial', ['as' => 'backend.rawmaterial', 'uses' => 'RawMaterialController@index', 'middleware' => 'staffHasPermission:manage_raw_material']);
        Route::get('/rawmaterial/dt', ['as' => 'backend.rawmaterial.dt', 'uses' => 'RawMaterialController@indexDt', 'middleware' => 'staffHasPermission:manage_raw_material']);
        Route::get('/rawmaterial/create', ['as' => 'backend.rawmaterial.create', 'uses' => 'RawMaterialController@create', 'middleware' => 'staffHasPermission:manage_raw_material']);
        Route::post('/rawmaterial/create', ['as' => 'backend.rawmaterial.create.post', 'uses' => 'RawMaterialController@createPost', 'middleware' => 'staffHasPermission:manage_raw_material']);
        Route::get('/rawmaterial/edit/{id}', ['as' => 'backend.rawmaterial.edit', 'uses' => 'RawMaterialController@edit', 'middleware' => 'staffHasPermission:manage_raw_material']);
        Route::post('/rawmaterial/edit/{id}', ['as' => 'backend.rawmaterial.edit.post', 'uses' => 'RawMaterialController@editPost', 'middleware' => 'staffHasPermission:manage_raw_material']);
        Route::post('/rawmaterial/delete/{id}', ['as' => 'backend.rawmaterial.delete', 'uses' => 'RawMaterialController@delete', 'middleware' => 'staffHasPermission:manage_raw_material']);
    	
		//manage_order related
        Route::get('/order', ['as' => 'backend.order', 'uses' => 'OrderController@index', 'middleware' => 'staffHasPermission:manage_order']);
        Route::get('/order/dt', ['as' => 'backend.order.dt', 'uses' => 'OrderController@indexDt', 'middleware' => 'staffHasPermission:manage_order']);
        
		Route::get('/order/info/{id}', ['as' => 'backend.order.info', 'uses' => 'OrderController@info', 'middleware' => 'staffHasPermission:manage_order']);
		
		//admin conflict support related
		Route::get('/order/conflict', ['as' => 'backend.order.conflict', 'uses' => 'OrderController@conflict', 'middleware' => 'staffHasPermission:manage_order']);
		Route::get('/order/conflict/dt', ['as' => 'backend.order.conflict.dt', 'uses' => 'OrderController@conflictDt', 'middleware' => 'staffHasPermission:manage_order']);
		Route::get('/order/conflict/conversation/{order_id}', ['as' => 'backend.order.conflict.conversation', 'uses' => 'OrderController@conflictConversation', 'middleware' => 'staffHasPermission:manage_order']);
        Route::get('/order/conflict/pullOrderChat/{id}', ['as' => 'backend.order.conflict.pullorderchat', 'uses' => 'OrderController@pullOrderChat']);
	    Route::post('/order/conflict/post-chat', ['as' => 'backend.order.conflict.postorderchat', 'uses' => 'OrderController@postOrderChat']);
        Route::post('/order/conflict/post-chat-image', ['as' => 'backend.order.conflict.postorderchatimage', 'uses' => 'OrderController@postOrderChatImage']);
        Route::get('/order/conflict/refund/{order_id}', ['as' => 'backend.order.conflict.refund', 'uses' => 'OrderController@conflictRefund', 'middleware' => 'staffHasPermission:manage_order']);
		Route::get('/order/conflict/release/{order_id}', ['as' => 'backend.order.conflict.release', 'uses' => 'OrderController@conflictRelease', 'middleware' => 'staffHasPermission:manage_order']);
		Route::post('/order/conflict/forward', ['as' => 'backend.order.conflict.forward', 'uses' => 'OrderController@conflictForward', 'middleware' => 'staffHasPermission:manage_order']);
		
		// Manage withdraw
		Route::get('/withdraw', ['as' => 'backend.withdraw', 'uses' => 'WithdrawController@index', 'middleware' => 'staffHasPermission:manage_withdraw']);
		Route::get('/withdraw/dt', ['as' => 'backend.withdraw.dt', 'uses' => 'WithdrawController@indexDt', 'middleware' => 'staffHasPermission:manage_withdraw']);
		Route::post('/withdraw/approve/{request_id}', ['as' => 'backend.withdraw.approve', 'uses' => 'WithdrawController@approve', 'middleware' => 'staffHasPermission:manage_withdraw']);
        Route::post('/withdraw/reject/{request_id}', ['as' => 'backend.withdraw.reject', 'uses' => 'WithdrawController@reject', 'middleware' => 'staffHasPermission:manage_withdraw']);	 
    	
		//manage_bank related
        Route::get('/level', ['as' => 'backend.level', 'uses' => 'LevelController@index', 'middleware' => 'staffHasPermission:manage_level']);
        Route::get('/level/dt', ['as' => 'backend.level.dt', 'uses' => 'LevelController@indexDt', 'middleware' => 'staffHasPermission:manage_level']);
        Route::get('/level/create', ['as' => 'backend.level.create', 'uses' => 'LevelController@create', 'middleware' => 'staffHasPermission:manage_level']);
        Route::post('/level/create', ['as' => 'backend.level.create.post', 'uses' => 'LevelController@createPost', 'middleware' => 'staffHasPermission:manage_level']);
        Route::get('/level/edit/{id}', ['as' => 'backend.level.edit', 'uses' => 'LevelController@edit', 'middleware' => 'staffHasPermission:manage_level']);
        Route::post('/level/edit/{id}', ['as' => 'backend.level.edit.post', 'uses' => 'LevelController@editPost', 'middleware' => 'staffHasPermission:manage_level']);
        Route::post('/level/delete/{id}', ['as' => 'backend.level.delete', 'uses' => 'LevelController@delete', 'middleware' => 'staffHasPermission:manage_level']);
	});

    //Backend auth route
    Route::group(array('middleware' => ['auth:staff']), function() {
        Route::get('/profile', ['as' => 'staff.profile', 'uses' => 'Auth\StaffController@profile']);
        Route::post('/profile', ['as' => 'staff.profile.post', 'uses' => 'Auth\StaffController@profilePost']);
    });

    //Backend logout
    Route::get('/staff/logout', ['as' => 'staff.logout', 'uses' => 'Auth\StaffController@logout']);

	
});
