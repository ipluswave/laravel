@extends('ajaxmodal')

@section('title')
    修改原材料
@endsection

@section('script')
    <script>
        +function() {
            $(document).ready(function() {
                $('#rawmaterial-form').makeAjaxForm({
                    inModal: true,
                    closeModal: true,
                    submitBtn: '#btn-submit-rawmaterial'
                });
            });
        }(jQuery);
    </script>
@endsection

@section('footer')
    <button type="button" id="btn-submit-rawmaterial" class="btn btn-primary blue">修改</button>
@endsection

@section('content')
    {!! Form::open(['route' => ['backend.rawmaterial.edit.post', 'id' => $model->id], 'method' => 'post', 'role' => 'form', 'id' => 'rawmaterial-form', 'files' => true]) !!}
        <div class="form-body">
            <div class="form-group">
                <label>原材料名称（中文）</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    {!! Form::text('name_cn', $model->name_cn, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>原材料名称（英文）</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    {!! Form::text('name_en', $model->name_en, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@section('modal')

@endsection