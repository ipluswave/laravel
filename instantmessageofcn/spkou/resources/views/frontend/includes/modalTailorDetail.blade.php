@extends('ajaxmodal')

@section('title')
{{ trans('member.tailor_detail') }}
@endsection

@section('content')
    <div class="row">
        <div class="tailor-profile" >
            <div class="row">
                <div class="profile-image col-md-2">
                    <div class="profile-userpic">
                        <img src="{{ $tailor->getAvatar() }}" class="img-responsive" alt="" style="width: 100px; height: 100px; "/>
                    </div>
                </div>
                <div class="user-info col-md-5">
                    <div class="basic-info">
                        <span class="bold">{{ $tailor->nick_name }}</span>&nbsp;&nbsp;{{ trans('member.male') }}&nbsp;&nbsp;{{ $tailor->getYearsOld() }}{{ trans('member.years_old') }}
                        @if ($tailor->is_validated == 1)
                        <span>
                            <img src="/images/authentication-logo.png" class="img-auth" alt="" >
                        </span>
                        @endif
                        <br/>
                        <span class="location">{{ $tailor->address }}</span><br/>
                        {{ trans('member.work_experience') }} : {{ $tailor->work_experience }} {{ trans('member.year') }}<br/>
                        {{ trans('common.level') }} : 50
                        </br>
                    </div>
                </div>
                <div class="user-info col-md-4">
                    <span class="bold">{{ trans('member.good_at') }}</span><br/>
                    <ul>
                        @foreach ($tailor->skills as $skill)
                            <li>{{ $skill->category->getTitle() }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row sect-choose">
        <div class="pull-right"><button type="submit" class="btn red-sunglo">{{ trans('member.select_this_tailor') }}</button></div>
        <div class="div-ttl-comment">
            <span class="ttl-comment">{{ trans('member.comment') }}（984,45）</span>
        </div>
    </div>
    <hr class="hr-line">
    <div class="row">
        <div class="col-md-2">
            <div class="rate-value">
                4.5
            </div>
        </div>
        <div class="col-md-2 sect-star01">
            {{--//http://plugins.krajee.com/star-rating-demo-basic-usage--}}
            <input type="text" class="rating-loading tailor-rated-val" value="2" data-size="16" title="" data-show-clear="false" data-readonly="true">
            {{ trans('member.received') }}&nbsp;&nbsp;<span class="ttl-eval">27,1321</span>&nbsp;&nbsp;{{ trans('member.how_many_comment') }}
        </div>
        <div class="col-md-5 sect-star02">
            <div class="col-md-4 star">
                <span class="no-star">1</span>
                <i class="fa fa-star"></i> &nbsp;&nbsp;
                <span class="no-vote">5, 464</span>
            </div>
            <div class="col-md-4 star">
                <span class="no-star">2</span>
                <i class="fa fa-star"></i> &nbsp;&nbsp;
                <span class="no-vote">15, 461</span>
            </div>
            <div class="col-md-4 star">
                <span class="no-star">3</span>
                <i class="fa fa-star"></i> &nbsp;&nbsp;
                <span class="no-vote">5, 464</span>
            </div>
            <br/>
            <div class="col-md-4 star">
                <span class="no-star">4</span>
                <i class="fa fa-star"></i> &nbsp;&nbsp;
                <span class="no-vote">458</span>
            </div>
            <div class="col-md-4 star">
                <span class="no-star">5</span>
                <i class="fa fa-star"></i> &nbsp;&nbsp;
                <span class="no-vote">300</span>
            </div>
        </div>
        <div class="col-md-3 sect-rate-histogram">
            <div class="histo">
                <div class="one histo-rate">
                    <span class="histo-star">
                        1</span>
                    <span class="bar-block">
                        <span id="bar-one" class="bar">
                        </span>
                    </span>
                </div>
                <div class="two histo-rate">
                    <span class="histo-star">
                        2</span>
                    <span class="bar-block">
                        <span id="bar-two" class="bar">
                        </span>
                    </span>
                </div>
                <div class="three histo-rate">
                    <span class="histo-star">
                        3</span>
                    <span class="bar-block">
                        <span id="bar-three" class="bar">
                        </span>
                    </span>
                </div>
                <div class="four histo-rate">
                    <span class="histo-star">
                        4</span>
                    <span class="bar-block">
                        <span id="bar-four" class="bar">
                        </span>
                    </span>
                </div>
                <div class="five histo-rate">
                    <span class="histo-star">
                        5</span>
                    <span class="bar-block">
                        <span id="bar-five" class="bar">
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row sect-user-comment">
        @include('frontend.includes.userComment')
        @include('frontend.includes.userComment')
        @include('frontend.includes.userComment')
        @include('frontend.includes.userComment')
    </div>
@endsection

@section('footer')
    <div class="modal-footer">
        <div>
            <ul class="pagination">
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
                <li>
                    <a href="javascript:;"> 1 </a>
                </li>
                <li>
                    <a href="javascript:;"> 2 </a>
                </li>
                <li class="active">
                    <a href="javascript:;"> 3 </a>
                </li>
                <li>
                    <a href="javascript:;"> 4 </a>
                </li>
                <li>
                    <a href="javascript:;"> 5 </a>
                </li>
                <li>
                    <a href="javascript:;"> 6 </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection