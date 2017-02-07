@if ($categories)
    @foreach ($categories as $key => $var)
        <label class="col-md-3">
            <input type="radio" name="c_two" class="icheck l2" value="{{ $var->id }}" data-title="{{ $var->getTitle() }}"{{ isset($order) && $order->top_bottom_id == $var->id ? ' checked' : '' }}>{{ $var->getTitle() }}
        </label>
    @endforeach
@endif