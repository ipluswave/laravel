@extends('frontend.layouts.default')

@section('title')
My Publish Order Details
@endsection

@section('description')
My Publish Order Details
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />
    <link href="/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/frontend/myPublishOrderDetails.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/frontend/myChat.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            @include('frontend.flash')
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-blue bold uppercase">My Publish Order</span>
                            </div>
                        </div>
                        <div class="portlet-body new-order">
                            <div class="gray-box">
                                <div class="complete-time pull-right">
                                    完成时间 : 2016-10-10 14:30
                                </div>
                                <div class="order-id">
                                    订单ID : NGC201354251456
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 column">款式：男装</div>
                                <div class="col-md-3 column">面料：厚</div>
                                <div class="col-md-3 column">体型：亚洲</div>
                                <div class="col-md-3 column">上下装：正装大衣</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 column">缝头宽度：合缝1cm</div>
                                <div class="col-md-3 column">缩率：径向50%</div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 column">分类：梭织 80%棉花 60%涤纶</div>
                                <div class="col-md-2"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 column">
                                    <span class="font-black bold">
                                    报价：
                                    </span>
                                    <span class="font-red bold">
                                    ¥966
                                    </span>
                                </div>
                                <div class="col-md-3 column">
                                    <span class="font-black bold">
                                    订单状态：
                                    </span>
                                    <span class="font-red bold">
                                    进行中
                                    </span>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <a href="javascript:;" class="link">删除</a>
                                    <a href="javascript:;" class="link">继续编辑</a>
                                    <button type="submit" class="btn blue">返回列表</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="tailor-profile" >
                                    <div class="col-md-12 gray-box">
                                        <div class="profile-image col-md-2">
                                            <div class="profile-userpic">
                                                <img src="../assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt="" >
                                            </div>
                                        </div>
                                        <div class="info col-md-10">
                                            <div class="basic-info">
                                                <div class="pull-right">
                                                    <button type="submit" class="btn gray01">查看详情</button>
                                                </div>
                                                <span class="bold">张师傅</span>   40岁
                                                <span class="location">广东省 广州市</span>
                                                工龄 50 年
                                                </br>
                                            </div>
                                            <span class="bold">擅长</span>
                                            <ul>
                                                <li>男正装大衣</li>
                                                <li>男羽绒棉袄</li>
                                                <li>男西装</li>
                                                <li>男便装</li>
                                                <li>男便装</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @include('frontend.includes.orderChatMessage',['orderId'=>$orderId])
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
         @include('frontend.includes.modalCreateExtraSize')
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')
    <script src="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
    <script src="/custom/js/frontend/myChatOrderMessage.js" type="text/javascript"></script>
@endsection