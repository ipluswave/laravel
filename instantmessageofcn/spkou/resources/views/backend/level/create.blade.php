@extends('ajaxmodal')

@section('title')
    新增银行
@endsection

@section('script')
    <script>
        +function() {
            $(document).ready(function() {
                $('#level-form').makeAjaxForm({
                    inModal: true,
                    closeModal: true,
                    submitBtn: '#btn-submit-level'
                });
            });
        }(jQuery);
    </script>
@endsection

@section('footer')
    <button type="button" id="btn-submit-level" class="btn btn-primary blue">新增</button>
@endsection

@section('content')
    {!! Form::open(['route' => ['backend.level.create.post'], 'method' => 'post', 'role' => 'form', 'id' => 'level-form', 'files' => true]) !!}
        <div class="form-body">
            <div class="form-group">
                <label>Badge</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    {!! Form::text('badge', '', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>Level</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    {!! Form::text('level', '', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>Level</label>
                <div class="input-group">
                    <!-- <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span> -->
                    {!! Form::file('url_icon', '', ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@section('modal')

@endsection