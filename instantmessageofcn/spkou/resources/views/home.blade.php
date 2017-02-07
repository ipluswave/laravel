@extends('frontend.layouts.default')

@section('title')
Home
@endsection

@section('description')
Home
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/custom/css/auth/home.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container" >

        <div class="showcase">
            <section id="first" class="section parallax bg relative" style="background-image:url(/images/home/background/banner.jpg)">
                    <div class="container max-height">
                        <div class="cell-vertical-container">
                            <div class="content">
                                 <div class="banner_containt carousel-caption"><img src="/images/home/logo/banner_logo.png" class="img-responsive" width="467" height="165" alt="banner logo" /><p class="small_p">专业打板，多快好省</p><p class="big_p">您身边的打板专家</p>
                            </div>
                            <!-- /content -->
                        </div>
                        <!-- /cell-vertical-container -->
                    </div>
                    <!-- /container -->
                </section>
                <!-- /#first -->

                <section id="second" class="section bg relative" style="background:#fcf8f7">
                    <div class="container max-height">
                        <div class="cell-vertical-container">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="pdd-vertical-90">
                                            <h2 class="hero-heading text-xform-none ls-1 ">关于我们</h2>
                                            <p class="font-weight-bold mrg-top-30">优质 | 诚意 | 快捷</p>
                                            <p class="font-weight-normal mrg-top-15">
                                                杭州双排扣科技有限公司有浙江比邻奈尔实业有限公司发起和创建，是中国领先的服装产业交互式综合服务平台，平台基于互联网轻资产的方式，以解决行业痛点为己任，以在线甄选技师、平台在线派单、企业在线接单为业务核心，专注于打破地域、时间、工作方式的限制，给劳动者带来更多的自由工作时间，以其技能为企业提供快捷、低成本高质量的服务。公司和个人在线建立多对多的虚拟雇佣关系，并完成工作交易。服务交易品类涵盖创意设计、制版样衣、生产制造、销售物流、在线服务等，为企业和个人提供定制化的解决方案。
                                            </p>
                                        </div>
                                        <!-- /padding -->
                                    </div>
                                    <!-- /column -->

                                    <div class="col-md-7">
                                        <img class="img-responsive" src="/images/home/portfolio/showcase-1.png" alt="" style= "margin:160px 0 0 20px">
                                    </div>
                                    <!-- /column -->
                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /content -->
                        </div>
                        <!-- /cell-vertical-container -->
                    </div>
                    <!-- /container -->
                </section>
                <!--/ #second -->

                <section id="third" class="section parallax bg relative" style="background-image:url(/images/home/background/showcase-bg-1.jpg)">
                    <div class="container max-height">
                        <div class="cell-vertical-container">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-offset-7 col-md-5">
                                        <div class="pdd-vertical-90 text-white">
                                            <h2 class="hero-heading text-white text-xform-none ls-1 ">用户发单</h2>
                                            <p class="font-weight-bold mrg-top-30">方便 | 简单 | 安全</p>
                                            <p class="font-weight-normal mrg-top-15">
                                                双排扣的平台主要解决了市面上常出现找不好师傅、质量没有保证、拖延时间长等许多问题的存在，现在用户只要预先想好需要定制的衣服的款式、类型、面料等几个步骤，就能轻松解决以上的问题。而且，平台提供各个地点区域的师傅，保证能够找到自己心仪的师傅，定制出自己需要的打板要求。
                                            </p>
                                            <a href="{{ route('frontend.createorderv2') }}" class="btn btn-md btn-style-3 mrg-top-30">我要发单</a>
                                        </div>
                                        <!-- /padding -->
                                    </div>
                                    <!-- /column -->
                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /content -->
                        </div>
                        <!-- /cell-vertical-container -->
                    </div>
                    <!-- /container -->
                </section>
                <!-- /#third -->

                <section id="fourth" class="section relative" style="background:#f4eee4">
                    <div class="container max-height">
                        <div class="cell-vertical-container">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="pdd-vertical-90">
                                            <h2 class="hero-heading text-xform-none ls-1 ">师傅接单</h2>
                                            <p class="font-weight-bold mrg-top-30">优秀 | 精湛 | 高效</p>
                                            <p class="font-weight-normal mrg-top-15">
                                                双排扣是为打版师傅量身定制的一个平台，既可以解决了就业问题，又可以在这里发挥出个人的实力。接单的流程也很简单，师傅可以在许多的订单里找到自己的长处订单，我们的2D展示图也可以让师傅更加直观的看到订单详情，不用浪费更多的时间再去反复的询问用户，师傅只要把更多的精力投入到自己的工作中。而且，我们平台上也会有奖励措施，认真努力的师傅更能够接到好的订单。
                                            </p>
                                            <a href="{{ route('frontend.tailororders') }}" class="btn btn-md btn-style-4 mrg-top-30">我要接单</a>
                                        </div>
                                        <!-- /padding -->
                                    </div>
                                    <!-- /column -->

                                    <div class="col-md-7">
                                        <img class="img-responsive" src="/images/home/portfolio/showcase-3.png" alt="" style="margin:140px 0 0 260px">
                                    </div>
                                    <!-- /column -->
                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /content -->
                        </div>
                        <!-- /cell-vertical-container -->
                    </div>
                    <!-- /container -->
                </section>
                <!-- /#fourth -->

                <section id="fifth" class="section bg parallax relative" style="background-image:url('/images/home/background/showcase-bg-2.jpg')">
                    <div class="container max-height">
                        <div class="cell-vertical-container">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-7">
                                        <div class="pdd-vertical-90">
                                            <h2 class="hero-heading text-xform-none ls-1 ">团队介绍</h2>
                                            <p class="font-weight-bold mrg-top-30">团结 | 信任 | 执着</p>
                                            <p class="font-weight-normal mrg-top-15">
                                               我们的团队来自于各个地区，是为了给广大的用户和师傅都能在里面能够得到自己的需求，我们的团队也是选取了各个地区的优质师傅，希望能给大家提供更加优质的服务，对于我们双排扣而言，能够在我们平台上得到帮助的人，就是我们的目标。信任是基础，相信我们的诚意能够让用户们在我们平台上越用越久，我们在未来也会不断改进、完善内容，一起共勉创造更好地平台。
                                            </p>
                                        </div>
                                        <!-- /padding -->
                                    </div>
                                    <!-- /column -->

                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /content -->
                        </div>
                        <!-- /cell-vertical-container -->
                    </div>
                    <!-- /#fivth -->
                </section>

                <section id="sixth" class="section " style="margin-top: 100px;">
                    <div class="container max-height">
                        <div class="cell-vertical-container">
                            <div class="content">
                                <div class="footer-cover text-center">
                                    <a href="#/">
                                        <img class="mrg-horizon-auto" src="/images/home/logo/logo.png" alt="">
                                    </a><br/><br/><br/>
                                    <div class="social-icon">
                                        <a href="#" class="btn btn-icon twitter border no-border circle text-dark">
                                           <img class="img-responsive" src="/images/home/logo/weixin.png" alt="">
                                        </a>
                                        <a href="#" class="btn btn-icon google border no-border circle text-dark">
                                            <img class="img-responsive" src="/images/home/logo/weibo.png" alt="">
                                        </a>
                                        <a href="#" class="btn btn-icon facebook border no-border circle text-dark">
                                            <img class="img-responsive" src="/images/home/logo/qq.png" alt="">
                                        </a>
                                        <!--
                                        <a href="#" class="btn btn-icon pinterest border no-border circle text-dark"><i class="ti-pinterest"></i></a>
                                        <a href="#" class="btn btn-icon yahoo border no-border circle text-dark"><i class="ti-yahoo"></i></a>
                                        -->
                                    </div>
                                    <!-- /social-icon -->
                                    <h5>杭州双排扣网络科技有限公司　©浙ICP备16007956号-1</h5>
                                </div>
                                <!-- /footer-cover -->
                            </div>
                            <!-- /content -->
                        </div>
                        <!-- /cell-vertical-container -->
                    </div>
                    <!-- /container -->
                </section>

            <!-- /#showcase -->
        </div>
    </div>
@endsection

@section('footer')
    <!-- Page Exclusive JS-->
    <script type="text/javascript" src="js/jquery.fullPage.min.js"></script>
    <script>
        //ShowCase
        function ShowcaseLoading() {
            var ShowcaseCreated = false;
            isPhoneDevice = "ontouchstart" in document.documentElement;
            Showcase();

            $(window).on('load resize', function() {
                if ($(this).width() < 992) {
                    ShowcaseCreated = true;
                    $.fn.fullpage.destroy('all');
                } else {
                    Showcase();
                }
            });

            function Showcase() {
                $('.showcase').each(function() {
                    var $this = $(this);
                    if (ShowcaseCreated === false) {
                        ShowcaseCreated = true;
//                        $this.fullpage({
//                            anchors: ['Home', 'About', 'Services', 'Portfolio', 'Contact'],
//                            navigation: true,
//                            navigationPosition: 'right',
//                            scrollBar: true
//                        });
                    }
                });
            }
        }

        if ($('.showcase').length > 0) {
            ShowcaseLoading();
        }
    </script>
    <!-- /Page Exclusive JS-->
    <script type="text/javascript" src="js/main.js"></script>

    <script src="/custom/js/frontend/home.js" type="text/javascript"></script>
@endsection
