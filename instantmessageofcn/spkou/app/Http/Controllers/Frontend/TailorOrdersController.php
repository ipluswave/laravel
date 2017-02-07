<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Constants;
use App\Models\Category;

class TailorOrdersController extends FrontendController
{
    protected function getFilters($id) {
        $data = array();
        switch ($id) {
            case 1:
                $c = Category::getCategories(1);
                foreach ($c->get() as $key => $var) {
                    $data[$var->id] = $var->getTitle();
                }
                break;
            case 2:
                $data = Constants::getMaterialLists();
                break;
            case 3:
                $data = Constants::getBodyShapeLists();
                break;
            case 4:
                $c = Category::getCategories(2);
                foreach ($c->get() as $key => $var) {
                    $data[$var->id] = $var->getTitle();
                }
                break;
        }

        return $data;
    }
    public function getFilterValue(Request $request, $id) {
        $data = $this->getFilters($id);
        return makeJSONResponse(true, 'Success', ['c' => $data]);
    }

    public function index(Request $request) {
        $now = \Carbon\Carbon::now();
        $orders = Order::with(['creator', 'style', 'topBottom', 'category', 'materials', 'applicants'])->JoinAppliedCheck()
            ->where('order.status', '=', Order::STATUS_PUBLISHED)
            ->where('planned_date', '>=', $now);

        $filter = array();
        $filter['type'] = null;
        $filter['order'] = null;
        $filter['advance_filter'] = null;

        //Check this only if user is tailor
        if (!$request->has('type') || $request->get('type') == 0) {
            //Only show order that match tailor skills
        } else {
            $filter['type'] = $request->get('type');
        }

        if ($request->has('order') && $request->get('order') != '') {
            switch ($request->get('order')) {
                case 1: $filter['order'] = 1;$orders->orderBy('created_at', 'ASC'); break;
                case 2: $filter['order'] = 2;$orders->orderBy('created_at', 'DESC'); break;
                case 3: $filter['order'] = 3;$orders->orderBy('pay_price', 'ASC'); break;
                case 4: $filter['order'] = 4;$orders->orderBy('pay_price', 'DESC'); break;
            }
        }

        if ($request->has('advance_filter') && $request->get('advance_filter') != '') {
            $filter['advance_filter'] = $request->get('advance_filter');
        }

        $type_url = route('frontend.tailororders') . '?';
        $order_url = route('frontend.tailororders') . '?';
        $advance_url = route('frontend.tailororders') . '?';

        if ($filter['order'] != null) {
            $type_url .= 'order=' . $filter['order'] . '&';
            $advance_url .= 'order=' . $filter['order'] . '&';
        }
        if ($filter['type'] != null) {
            $order_url .= 'type=' . $filter['type'] . '&';
            $advance_url .= 'type=' . $filter['type'] . '&';
        }

        if ($filter['advance_filter'] != null) {
            $type_url .= 'advance_filter=' . $filter['advance_filter'] . '&';
            $order_url .= 'advance_filter=' . $filter['advance_filter'] . '&';
        }

        $advance_filter_json = array();
        //Build the advance filter json and add the query
        if ($filter['advance_filter'] != null) {
            $filters = explode(',', $filter['advance_filter']);
            foreach ($filters as $f) {
                list($type, $value) = explode('|', $f);

                $datas = $this->getFilters($type);
                if (isset($datas[$value])) {
                    $text = '';
                    switch ($type) {
                        case 1:
                            $text = trans('order.style');
                            $orders->where('style_id', '=', $value);
                        break;
                        case 2:
                            $text = trans('order.material');
                            $orders->where('material', '=', $value);
                        break;
                        case 3:
                            $text = trans('order.body_shape');
                            $orders->where('body_shape', '=', $value);
                        break;
                        case 4:
                            $text = trans('order.top_bottom');
                            $orders->where('top_bottom_id', '=', $value);
                        break;
                    }
                    $advance_filter_json[] = array(
                        'value' => $type . '|' . $value,
                        'text' => $text . ':' . $datas[$value],
                    );
                }
            }
        }

        return view('frontend.tailorOrders.index', [
            'orders' => $orders->paginate(15),
            'filter' => $filter,
            'type_url' => $type_url,
            'order_url' => $order_url,
            'advance_url' => $advance_url,
            'advance_filter_json' => $advance_filter_json,
        ]);
    }
}