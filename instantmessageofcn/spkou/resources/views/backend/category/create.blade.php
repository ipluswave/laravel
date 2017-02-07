@extends('ajaxmodal')

@section('title')
    新增目录
@endsection

@section('script')
    <script>
        +function() {
            $(document).ready(function() {
                $('#category-form').makeAjaxForm({
                    inModal: true,
                    closeModal: true,
                    submitBtn: '#btn-submit-category'
                });
            });
        }(jQuery);
    </script>
@endsection

@section('footer')
    <button type="button" id="btn-submit-category" class="btn btn-primary blue">新增</button>
@endsection

@section('content')
    @if ($id === null)
    {!! Form::open(['route' => ['backend.category.create.post'], 'method' => 'post', 'role' => 'form', 'id' => 'category-form']) !!}
    @else
    {!! Form::open(['route' => ['backend.category.create.post', 'id' => $id], 'method' => 'post', 'role' => 'form', 'id' => 'category-form']) !!}
    @endif
        <div class="form-body">
            <div class="form-group">
                <label>目录名称（中文）</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-bookmark"></i>
                    </span>
                    {!! Form::text('title_cn', '', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>目录名称（英文）</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-bookmark"></i>
                    </span>
                    {!! Form::text('title_en', '', ['class' => 'form-control']) !!}
                </div>
            </div>
            @if ($model && $model->level == 1)
            <div class="form-group">
                <label>是否可选</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-check"></i>
                    </span>
                    <select name="selectable" class="form-control">
                        <option value="0" selected>否</option>
                        <option value="1">是</option>
                    </select>
                </div>
            </div>
            @else
                <input type="hidden" name="selectable" value="1" />
            @endif
        </div>
    {!! Form::close() !!}
@endsection

@section('modal')

@endsection