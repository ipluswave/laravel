<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <div class="portlet box grey01 order-filter-container">
            <div class="portlet-title">
                {{ trans('member.show_option') }}
            </div>
            <div class="portlet-body">
                <ul class="show-option-info">
                    <li class="{{ $filter['type'] == null ? 'active' : '' }}">
                        <a href="{{ $type_url }}">{{ trans('member.recommend_order') }}</a>
                    </li>
                    <li class="{{ $filter['type'] == 1 ? 'active' : '' }}">
                        <a href="{{ $type_url }}type=1">{{ trans('member.all_order') }}</a>
                    </li>
                </ul>
            </div>
            <div class="portlet-title">
                {{ trans('member.ordering_option') }}
            </div>
            <div class="portlet-body">
                <ul class="ordering-option-info">
                    <li class="{{ $filter['order'] == 1 ? 'active' : '' }}">
                        <a href="{{ $order_url }}order=1">{{ trans('member.time_ascending') }}</a>
                    </li>
                    <li class="{{ $filter['order'] == null || $filter['order'] == 2 ? 'active' : '' }}">
                        <a href="{{ $order_url }}order=2">{{ trans('member.time_descending') }}</a>
                    </li>
                    <li class="{{ $filter['order'] == 3 ? 'active' : '' }}">
                        <a href="{{ $order_url }}order=3">{{ trans('member.quoted_price_ascending') }}</a>
                    </li>
                    <li class="{{ $filter['order'] == 4 ? 'active' : '' }}">
                        <a href="{{ $order_url }}order=4">{{ trans('member.quoted_price_descending') }}</a>
                    </li>
                </ul>
            </div>
            <div class="portlet-title">
                {{ trans('member.advance_search_option') }}
            </div>
            <div class="portlet-body">
                <input class="tag-input" type="text" value="" id="advance-filter-tag">
                <br/>
                <br/>
                <select class="bs-filter-keyword form-control" placeholder="{{ trans('member.filter_keyword') }}" title="{{ trans('member.filter_keyword') }}" id="advance-filter-keyword">
                    <option value="1" data-text="{{ trans('order.style') }}">{{ trans('order.style') }}</option>
                    <option value="2" data-text="{{ trans('order.material') }}">{{ trans('order.material') }}</option>
                    <option value="3" data-text="{{ trans('order.body_shape') }}">{{ trans('order.body_shape') }}</option>
                    <option value="4" data-text="{{ trans('order.top_bottom') }}">{{ trans('order.top_bottom') }}</option>
                </select>
                <br/><br/>
                <select class="bs-filter-value form-control" placeholder="{{ trans('member.filter_value') }}" title="{{ trans('member.filter_value') }}" id="advance-filter-value">

                </select>
                <br/><br/>
                <a href="javascript:;" class="btn default" id="advance-filter-add-btn" style="width: 100%;">
                    <i class="fa fa-plus"></i>{{ trans('member.add_filter_condition') }}
                </a>
                <a href="javascript:;" class="btn btn-orange" id="advance-filter-submit-btn" style="margin-top: 20px; width: 100%;">
                    <i class="fa fa-check"></i>{{ trans('common.confirm') }}
                </a>
            </div>
        </div>
    </div>
</div>