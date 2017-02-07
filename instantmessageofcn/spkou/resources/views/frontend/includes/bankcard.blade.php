<div class="col-md-6">
    <div class="col-md-12 account" style="color: #{{ $card->bank->font_color }}; background-color: #{{ $card->bank->background_color }}">
        <div class="col-md-2">
            <img src="{{ asset($card->bank->logo) }}" alt="logo" class="logo-default" />
        </div>
        <div class="col-md-10">
            <div class="pull-right">
                <label class="control-label">{{ $card->account_name }}</label>
            </div>
            <div>
                <label class="control-label">{{ $card->bank->getName() }}<br/>{{ $card->account_address }}</label>
            </div>
            <div class="pull-right">
                <label class="control-label account-no">****  ****  ****  {{ $card->getAccountNumberPart() }}</label>
            </div>
        </div>
    </div>
    <div class="div-action">
        <a data-href="{{ route('frontend.myaccount.delete', ['id' => $card->id]) }}" class="" data-successRefresh="yes" data-redirect="no" data-toggle="modal" data-target="#confirm-modal" data-header="{{ trans('member.confirm_delete') }}" data-body="{{ trans('member.confirm_delete_bankcard') }}">{{ trans('member.delete') }}</a>
    </div>
    <br/>
</div>