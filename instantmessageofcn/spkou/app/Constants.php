<?php

namespace App;

class Constants {
    const MATERIAL_1 = 1;
    const MATERIAL_2 = 2;
    const MATERIAL_3 = 3;

    const BODY_SHAPE_1 = 1;
    const BODY_SHAPE_2 = 2;
    const BODY_SHAPE_3 = 3;

    public static function getMaterialLists($empty = false) {
        $arr = array();
        if ($arr === true) {
            $arr[] = trans('order.material');
        }
        $arr[static::MATERIAL_1] = trans('order.thick');
        $arr[static::MATERIAL_2] = trans('order.middle');
        $arr[static::MATERIAL_3] = trans('order.thin');

        return $arr;
    }

    public static function translateMaterial($id) {
        switch ($id) {
            case static::MATERIAL_1: return trans('order.thick'); break;
            case static::MATERIAL_2: return trans('order.middle'); break;
            case static::MATERIAL_3: return trans('order.thin'); break;
            default: return '-'; break;
        }
    }

    public static function getBodyShapeLists($empty = false) {
        $arr = array();
        if ($arr === true) {
            $arr[] = trans('order.material');
        }
        $arr[static::BODY_SHAPE_1] = trans('order.asia');
        $arr[static::BODY_SHAPE_2] = trans('order.europe');
        $arr[static::BODY_SHAPE_3] = trans('order.america');

        return $arr;
    }

    public static function translateBodyShape($id) {
        switch ($id) {
            case static::BODY_SHAPE_1: return trans('order.asia'); break;
            case static::BODY_SHAPE_2: return trans('order.europe'); break;
            case static::BODY_SHAPE_3: return trans('order.america'); break;
            default: return '-'; break;
        }
    }
}