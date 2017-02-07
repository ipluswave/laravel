<div id="body-alert-container">
    @if (Session::has('flash_success'))
        <div class="row">
            @foreach (Session::get('flash_success') as $msg)
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ $msg }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if (Session::has('flash_info'))
        <div class="row">
            @foreach (Session::get('flash_info') as $msg)
                <div class="col-md-12">
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ $msg }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if (Session::has('flash_warning'))
        <div class="row">
            @foreach (Session::get('flash_warning') as $msg)
                <div class="col-md-12">
                    <div class="alert alert-error alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ $msg }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if (Session::has('flash_error'))
        <div class="row">
            @foreach (Session::get('flash_error') as $msg)
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ $msg }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>