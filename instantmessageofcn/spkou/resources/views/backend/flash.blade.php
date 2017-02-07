<div id="body-alert-container">
    @if (Session::has('flash_success'))
        @foreach (Session::get('flash_success') as $msg)
        <div class="custom-alerts alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <i class="fa-lg fa fa-fa fa-check"></i>
            {{ $msg }}
        </div>
        @endforeach
    @endif
    @if (Session::has('flash_info'))
        @foreach (Session::get('flash_info') as $msg)
            <div class="custom-alerts alert alert-info fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <i class="fa-lg fa fa-fa fa-exclamation"></i>
                {{ $msg }}
            </div>
        @endforeach
    @endif
    @if (Session::has('flash_warning'))
        @foreach (Session::get('flash_warning') as $msg)
            <div class="custom-alerts alert alert-warning fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <i class="fa-lg fa fa-fa fa-times"></i>
                {{ $msg }}
            </div>
        @endforeach
    @endif
    @if (Session::has('flash_error'))
        @foreach (Session::get('flash_error') as $msg)
            <div class="custom-alerts alert alert-danger fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <i class="fa-lg fa fa-fa fa-times"></i>
                {{ $msg }}
            </div>
        @endforeach
    @endif
</div>