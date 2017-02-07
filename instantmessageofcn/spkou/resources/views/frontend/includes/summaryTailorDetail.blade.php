<div class="item clearfix">
    <div class="tailor-profile" >
        <div class="col-md-12 gray-box">
            <div class="profile-image col-md-2">
                <div class="profile-userpic">
                    <img src="{{ $applicant->user->getAvatar() }}" class="img-responsive" alt="" style="width: 100px; height: 100px;">
                </div>
            </div>
            <div class="info col-md-10">
                <div class="basic-info">
                    @if (!isset($selected) || $selected !== true)
                    <div class="pull-right text-center">
                        <button type="button" class="btn gray01 select-tailor" data-applicantid="{{ $applicant->id }}">{{ trans('member.select_this_tailor') }}</button><br/>
                    </div>
                    @endif
                    <span class="bold">{{ $applicant->user->nick_name }}</span>   {{ $applicant->user->getYearsOld() }}{{ trans('member.years_old') }}
                    <span class="location">{{ $applicant->user->address }}</span>
                    @if ($applicant->user->experience)
                        {{ trans('member.work_experience') }} {{ $applicant->user->experience }} {{ trans('member.year') }}
                    @endif
                    <br/>
                </div>
                <span class="bold">{{ trans('member.specializes') }}</span>
                <div>
                    <div class="pull-right">
                        <a href="{{ route('frontend.checktailor', ['id' => $applicant->user->id]) }}" class="link details" style="padding-top: 10px;"  data-toggle="modal" data-target="#remote-modal-large">{{ trans('member.check_detail') }}</a>
                    </div>
                    <ul>
                        @foreach ($applicant->user->skills as $skill)
                            <li>{{ $skill->category->getTitle() }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>