@if ($categories)
    @foreach ($categories as $key => $var)
        <label class="lvl-cat-three">
            <input type="radio" name="c_three" class="icheck l3" value="{{ $var->id }}" data-title="{{ $var->getTitle() }}"{{ isset($order) && $order->category_id == $var->id ? ' checked' : '' }}>{{ $var->getTitle() }}
        </label>
    @endforeach
@endif