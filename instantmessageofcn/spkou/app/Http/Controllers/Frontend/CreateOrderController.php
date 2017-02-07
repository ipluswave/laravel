<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\RawMaterial;
use App\Models\Order;
use App\Models\OrderCAD;
use App\Models\OrderMaterial;
use App\Models\OrderProcessingGuide;
use App\Models\OrderProperty;
use App\Models\OrderSize;
use App\Models\OrderPayment;

class CreateOrderController extends FrontendController
{
    public function makeOrder(Request $request, $step = null, $order = null) {
        try {
            if(app()->getLocale() == "cn") {
                $input_date = convertCNDateTimePicker($request->get('planned_date'));
            }else{
                $input_date = $request->get('planned_date');
            }

            $d = \Carbon\Carbon::createFromFormat('d F Y - H', $input_date);
            $d->minute = 00;
            $d->second = 00;

            $now = new \Carbon\Carbon();
            if ($now >= $d) {
                throw new \Exception('completed date must be future');
            }
            \DB::beginTransaction();

            //If not step save
            if ($step === null) {
                $order = new Order();
            }

            $order->creator_id = \Auth::guard('users')->user()->id;
            if ($step == null || $step == 1 || $step == 2) {
                $order->status = Order::STATUS_DRAFT;
            } else {
                $order->status = Order::STATUS_PUBLISHED;
            }

            $order->planned_date = $d->format('Y-m-d H:i:s');
            if ($request->has('c_three') && $request->get('c_three') != '') {
                $c = Category::where('parent_id', '=', $request->get('c_two'))->where('id', '=', $request->get('c_three'))->first();

                if ($c) {
                    $order->category_id = $c->id;
                } else {
                    throw new \Exception(trans('order.unknown_category_selection'));
                }
            }

            if ($request->has('c_two') && $request->get('c_two') != '') {
                $c = Category::where('parent_id', '=', $request->get('c_one'))->where('id', '=', $request->get('c_two'))->first();

                if ($c) {
                    $order->top_bottom_id = $c->id;
                } else {
                    throw new \Exception(trans('order.unknown_category_selection'));
                }
            } else {
                throw new \Exception('Unknown Category selection');
            }

            if ($request->has('c_one') && $request->get('c_one') != '') {
                $order->style_id = $request->get('c_one');
            } else {
                throw new \Exception('Unknown Category selection');
            }
            $order->material = $request->get('material');
            $order->body_shape = $request->get('bodyshape');
            if ($request->has('custom_seal') && $request->get('custom_seal') == 1) {
                if ($request->has('common_seal_check') && $request->get('common_seal_check') == 1) {
                    $order->common_seal = 1;
                    $order->common_seal_num = $request->get('common_seal');
                } else {
                    $order->common_seal = 0;
                    $order->common_seal_num = 0;
                }
                if ($request->has('seal3_check') && $request->get('seal3_check') == 1) {
                    $order->seal3 = 1;
                    $order->seal_3_num = $request->get('seal3');
                } else {
                    $order->seal3 = 0;
                    $order->seal_3_num = 0;
                }
                if ($request->has('seal2_check') && $request->get('seal2_check') == 1) {
                    $order->seal2 = 1;
                    $order->seal_2_num = $request->get('seal2');
                } else {
                    $order->seal2 = 0;
                    $order->seal_2_num = 0;
                }
                if ($request->has('seal1_check') && $request->get('seal1_check') == 1) {
                    $order->seal1 = 1;
                    $order->seal_1_num = $request->get('seal1');
                } else {
                    $order->seal1 = 0;
                    $order->seal_1_num = 0;
                }
                if ($request->has('niddle_size_check') && $request->get('niddle_size_check') == 1) {
                    $order->niddle_size = 1;
                    $order->niddle_size_num = $request->get('niddle_size');
                } else {
                    $order->niddle_size = 0;
                    $order->niddle_size_num = 0;
                }
                if ($request->has('include_seal') && $request->get('include_seal') == 1) {
                    $order->include_seal = 1;
                    if ($request->has('front_big_back') && $request->get('front_big_back') == 1) {
                        $order->front_big_back_small = 1;
                    } else if ($request->has('front_small_back') && $request->get('front_small_back') == 1) {
                        $order->front_small_back_big = 1;
                    }
                    $order->include_seal_num_1 = $request->get('include_seal_num_1');
                    $order->include_seal_num_2 = $request->get('include_seal_num_2');
                } else {
                    $order->include_seal = 0;
                    $order->front_big_back_small = 0;
                    $order->front_small_back_big = 0;
                    $order->include_seal_num_1 = 0;
                    $order->include_seal_num_2 = 0;
                }
                $order->seal_width = 1;
            } else {
                $order->seal_width = 0;
                $order->common_seal = 0;
                $order->common_seal_num = 0;
                $order->seal3 = 0;
                $order->seal_3_num = 0;
                $order->seal2 = 0;
                $order->seal_2_num = 0;
                $order->seal1 = 0;
                $order->seal_1_num = 0;
                $order->niddle_size = 0;
                $order->niddle_size_num = 0;
                $order->include_seal = 0;
                $order->front_big_back_small = 0;
                $order->front_small_back_big = 0;
                $order->include_seal_num_1 = 0;
                $order->include_seal_num_2 = 0;
            }
            if ($request->has('decrease_rate') && $request->get('decrease_rate') == 1) {
                $order->parar = $request->get('parar');
                $order->horiz = $request->get('horiz');
                $order->decrease_rate = 1;
            } else {
                $order->decrease_rate = 0;
                $order->parar = $request->get('parar');
                $order->horiz = $request->get('horiz');
            }
            if ($request->has('custom_raw_material_switch') && $request->get('custom_raw_material_switch') == 1) {
                $rawMaterials = $request->get('raw_materials');
                if ($rawMaterials != '') {
                    $rm = array();
                    //Check for percentage
                    $m = explode(',', $rawMaterials);
                    $percent = 0;
                    foreach ($m as $key => $var) {
                        list($p, $n) = explode('%', $var);
                        if (!$p || !$n) {
                            throw new \Exception('Unknown raw material set, please refresh and try again');
                        }
                        if ($p) {
                            $percent += $p;
                            $rm[trim($n)] = $p;
                        }
                    }
                    //If over 100, throw error
                    if ($percent > 100) {
                        throw new \Exception('Raw material maximum of 100%, you have ' . $percent . '%');
                    }
                    //If nothing wrong, build OrderMaterial with name and percent
                    $materials = array();
                    foreach ($rm as $name => $percent) {
                        $material = new OrderMaterial();
                        $material->percent = $percent;
                        $material->material_name = $name;
                        $materials[] = $material;
                    }
                    $order->custom_raw_material = 1;
                }
            } else {
                $order->custom_raw_material = 0;
            }

            if ($step == 2 || $step == 3) {
                if ($request->has('front_image_desc') && $request->get('front_image_desc') != '') {
                    $order->front_image_desc = $request->get('front_image_desc');
                }
                if ($request->hasFile('front_pattern_image')) {
                    $order->front_pattern_image = $request->file('front_pattern_image');
                }
                if ($request->has('back_image_desc') && $request->get('back_image_desc') != '') {
                    $order->back_image_desc = $request->get('back_image_desc');
                }
                if ($request->hasFile('back_pattern_image')) {
                    $order->back_pattern_image = $request->file('back_pattern_image');
                }

                if ($request->has('guide')) {
                    foreach ($request->get('guide') as $key => $var) {
                        if ($var != '') {
                            $guides[$key] = new OrderProcessingGuide();
                            $guides[$key]->comment = $var['comment'];
                            $guides[$key]->file_id = $key;
                        }

                        if (isset($request->file('guide')[$key])) {
                            if (!isset($guides[$key])) {
                                $guides[$key] = new OrderProcessingGuide();
                                $guides[$key]->file_id = $key;
                            }
                            $guides[$key]->image_path = $request->file('guide')[$key]['image'];
                        }
                    }
                }
                if ($request->has('remark') && $request->get('remark') != '') {
                    $order->remark = $request->get('remark');
                }
            }

            if ($step == 3) {
                if ($request->has('grading_needed') && $request->get('grading_needed') == 1) {
                    $order->grading_needed = 1;
                }
                if ($request->has('common_post') && $request->get('common_post') == 1) {
                    $order->common_post = 1;
                }
                if ($request->has('urgent_post') && $request->get('urgent_post') == 1) {
                    $order->urgent_post = 1;
                }
                if ($request->has('pay_price') && $request->get('pay_price') != '' && $request->get('pay_price') > 0) {
                    $order->pay_price = $request->get('pay_price');
                } else {
                    throw new \Exception(trans('order.fill_pay_price'));
                }
                $order->payment_method = $request->get('payment_method');
            }

            $order->save();

            //No matter what, delete all first
            if ($order->materials()) {
                $order->materials()->delete();
            }

            if (isset($materials)) {
                foreach ($materials as $key => $var) {
                    $var->order_id = $order->id;
                    $var->save();
                }
            }

            $deletes = array();

            if ($step == null || $step >= 2) {
                if (isset($guides)) {
                    foreach ($guides as $key => $var) {
                        if ($var->comment != null || $var->image_path != null) {
                            $og = OrderProcessingGuide::where('order_id', '=', $order->id)->where('file_id', '=', $var->file_id)->first();
                            if ($og) {
                                if ($og->image_path != $var->image_path) {
//                                    $deletes[] = public_path($og->image_path);
                                }
                                $og->comment = $var->comment;
                                $og->image_path = $var->image_path;
                                $og->save();
                            } else {
                                $var->order_id = $order->id;
                                $var->save();
                            }
                        }
                    }
                }
            }

            if ($step == 1 || $step == null) {
                $order->order_id = $order->createOrderId();
            }

            $order->save();

            //Create payment
            if ($step == null || $step == 1 || $step == 2) {

            } else {
                switch ($order->payment_method) {
                    case OrderPayment::PAYMENT_METHOD_ALIPAY:
                        $payment_channel = 'alipay_wap';
                        $currency = 'cny';
                        $charge_status = \Pingpp::Charge()->create([
                            'order_no'  => $order->order_id,
                            'amount'    => $order->pay_price,
                            'app'       => array('id' => env('PINGPP_APP_ID', NULL)),
                            'channel'   => $payment_channel,
                            'currency'  => $currency,
                            'client_ip' => request()->ip(),
                            'subject'   => 'Place order',
                            'body'      => 'Payment for place order, order no ' . $order->order_id,
                            'extra'     => array('success_url' => route('payment.callback')),
                        ]);
                        break;
                    case OrderPayment::PAYMENT_METHOD_WECHAT:
                        $payment_channel = 'wx_pub_qr';
                        $currency = 'cny';
                        $charge_status = \Pingpp::Charge()->create([
                            'order_no'  => $order->order_id,
                            'amount'    => $order->pay_price,
                            'app'       => array('id' => env('PINGPP_APP_ID', NULL)),
                            'channel'   => $payment_channel,
                            'currency'  => $currency,
                            'client_ip' => request()->ip(),
                            'subject'   => 'Place order',
                            'body'      => 'Payment for place order, order no ' . $order->order_id,
                            'extra'     => array('product_id' => 1),
                        ]);
                        break;
                    default:
                        throw new \Exception(trans('order.unknown_payment_method'));
                        break;
                }

                if ($charge_status == false) {
                    throw new \Exception(\Pingpp::getError());
                } else {
                    $charge_object = $charge_status;
                    $pp = new OrderPayment();
                    $pp->order_id = $order->id;
                    $pp->user_id = $order->user_id;
                    //Temporary, added channel need to edit here
                    $pp->payment_method = OrderPayment::PAYMENT_METHOD_ALIPAY;
                    $pp->order_no = $order->order_id;
                    $pp->transaction_id = $charge_object->id;
                    $pp->channel = $payment_channel;
                    $pp->ip_address = $charge_object->client_ip;
                    $pp->currency = $currency;
                    $pp->amount = $charge_object->amount;
                    $pp->amount_settle = $charge_object->amount_settle;
                    $pp->create_transaction_json = json_encode($charge_object);
                    $pp->status = OrderPayment::STATUS_PENDING;

                    $pp->save();
                }
            }

            \DB::commit();

            //Delete after commit, any error leave it is better than 404 not found
            foreach ($deletes as $key => $var) {
                @unlink($var);
            }

            if ($step == null || $step == 1 || $step == 2) {
                return makeJSONResponse(true, 'Successfully save order', ['order_id' => $order->id]);
            } else {
                if (isset($charge_object)) {
                    return makeJSONResponse(true, 'Successfully publish order', ['redirect' => 1, 'charge_object' => $charge_object]);
                } else {
                    return makeJSONResponse(true, 'Successfully publish order', ['redirect' => 1]);
                }
            }
        } catch (\Exception $e) {
            \DB::rollback();
            return makeJSONResponse(false, $e->getMessage());
        }
    }

    public function index(Request $request) {
        if (isPost()) {
            try {
                if ($request->has('page') && $request->get('page') == 1) {
                    $makeOrder = $this->makeOrder($request);
                } else if ($request->has('page') && $request->get('page') == 2) {
                    $order = Order::find($request->get('order_id'));
                    if ($order) {
                        if ($order->creator_id != \Auth::guard('users')->user()->id) {
                            return makeJSONResponse(false, trans('common.action_no_permission'));
                        }
                        $makeOrder = $this->makeOrder($request, 2, $order);
                    } else {
                        return makeJSONResponse(false, trans('order.order_not_found'));
                    }
                } else if ($request->has('page') && $request->get('page') == 3) {
                    $order = Order::find($request->get('order_id'));
                    if ($order) {
                        if ($order->creator_id != \Auth::guard('users')->user()->id) {
                            return makeJSONResponse(false, trans('common.action_no_permission'));
                        }
                        $makeOrder = $this->makeOrder($request, 3, $order);
                    } else {
                        return makeJSONResponse(false, trans('order.order_not_found'));
                    }
                }

                return $makeOrder;
            } catch (\Exception $e) {
                return makeJSONResponse($e->getMessage(), true);
            }
        } else {
            $categories = Category::getCategories(1);
            $rawMaterial = RawMaterial::GetMaterial();

            $tomorrow = Carbon::now('Asia/Singapore')->addDay();
            //'2012-12-24T15:25:00Z';
            $tomorrowFormatDate =  $tomorrow->format('Y-m-d'). 'T' . $tomorrow->format('H:i:s').'Z';
            return view('frontend.createOrder.index', ['categories' => $categories->get(), 'rawMaterial' => $rawMaterial->get(), 'tomorrowFormatDate' => $tomorrowFormatDate]);
        }
    }

    public function editOrder(Request $request, $id) {
        $order = Order::with(['materials', 'processingGuides'])->find($id);

        if (isPost()) {
            if (!$order || $order->status != Order::STATUS_DRAFT) {
                return makeJSONResponse(false, trans('order.order_not_found'));
            }

            if ($order->creator_id != \Auth::guard('users')->user()->id) {
                return makeJSONResponse(false, trans('common.action_no_permission'));
            }

            try {
                $makeOrder = $this->makeOrder($request, $request->get('page'), $order);

                return $makeOrder;
            } catch (\Exception $e) {
                return makeJSONResponse($e->getMessage(), true);
            }
        } else {
            if (!$order || $order->status != Order::STATUS_DRAFT) {
                addError(trans('order.published_order_cannot_modify'));
                return redirect()->route('home');
            }

            if ($order->creator_id != \Auth::guard('users')->user()->id) {
                addError(trans('common.action_no_permission'));
                return redirect()->route('home');
            }

            $categories = Category::getCategories(1);
            $rawMaterial = RawMaterial::GetMaterial();
            $currentTopBottom = Category::where('parent_id', '=', $order->style_id)->get();
            if ($order->category_id != null) {
                $currentCategory = Category::where('parent_id', '=', $order->top_bottom_id)->get();
            } else {
                $currentCategory = null;
            }
            $tomorrow = Carbon::now('Asia/Singapore')->addDay();
            //'2012-12-24T15:25:00Z';
            $tomorrowFormatDate =  $tomorrow->format('Y-m-d'). 'T' . $tomorrow->format('H:i:s').'Z';
            return view('frontend.createOrder.index', [
                'categories' => $categories->get(), 'rawMaterial' => $rawMaterial->get(), 'order' => $order,
                'currentTopBottom' => $currentTopBottom,
                'currentCategory' => $currentCategory,
                'tomorrowFormatDate' => $tomorrowFormatDate
            ]);
        }
    }

    public function saveOrder(Request $request, $step) {
        try {
            switch ($step) {
                case 1:
                    $status = $this->makeOrder($request, 1);
                    break;
                case 2:
                    $order = Order::find($request->get('order_id'));
                    if ($order) {
                        if ($order->creator_id != \Auth::guard('users')->user()->id) {
                            return makeJSONResponse(false, trans('common.action_no_permission'));
                        }
                        $status = $this->makeOrder($request, 2, $order);
                    } else {
                        return makeResponse(trans('order.order_not_found'), true);
                    }
                    break;
                case 3:
                    $order = Order::find($request->get('order_id'));
                    if ($order) {
                        if ($order->creator_id != \Auth::guard('users')->user()->id) {
                            return makeJSONResponse(false, trans('common.action_no_permission'));
                        }
                        $status = $this->makeOrder($request, 3, $order);
                    } else {
                        return makeResponse(trans('order.order_not_found'), true);
                    }
                    break;
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function levelTwo(Request $request) {
        $categories = Category::getCategories(2, $request->get('parent_id'));
        return view('frontend.createOrder.category2', ['categories' => $categories->get()]);
    }

    public function levelThree(Request $request) {
        $categories = Category::getCategories(3, $request->get('parent_id'));
        return view('frontend.createOrder.category3', ['categories' => $categories->get()]);
    }

    public function delete(Request $request, $id) {
        $order = Order::find($id);
        $orderMaterial = OrderMaterial::where('order_id', '=', $id);

        if (!$order || ($order->status != Order::STATUS_DRAFT && $order->status != Order::STATUS_PUBLISHED)) {
            addError(trans('order.published_order_cannot_modify'));
            return redirect()->route('frontend.mypublishorder');
        }

        if ($order->creator_id != \Auth::guard('users')->user()->id) {
            addError(trans('common.action_no_permission'));
            return redirect()->route('frontend.mypublishorder');
        }

        try {
            if(isset($orderMaterial)) {
                $orderMaterial->delete();
            }
            $order->delete();
            addSuccess(trans('order.successfully_delete_order'));
            return redirect()->route('frontend.mypublishorder');
        } catch (\Exception $e) {
            addError($e->getMessage());
            return redirect()->route('frontend.mypublishorder');
        }
    }
}