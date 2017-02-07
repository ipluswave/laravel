<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Exception\HttpResponseException;

function pushFlash($key, $value) {
    $values = Session::get($key, []);
    $values[] = $value;
    Session::flash($key, $values);
}

function makeJSON($status, $msg, $extra = array()) {
    $data = array(
        'status' => $status === true ? 'success' : 'error',
        'msg' => $msg
    );

    if (isset($extra) && count($extra) > 0) {
        foreach ($extra as $key => $var) {
            $data[$key] = $var;
        }
    }

    return json_encode($data);
}

function makeJSONResponse($status = false, $msg = '', $data = array()) {
    if (isEmpty($msg)) {
        $msg = 'Please fix the following error(s)';
    }

    return response()->make(array(
                'status' => $status === true ? 'success' : 'error',
                'msg' => $msg,
                'data' => $data
    ));
}

function addError($msg) {
    if (!is_array($msg)) {
        pushFlash('flash_error', $msg);
    } else {
        foreach ($msg as $key => $var) {
            pushFlash('flash_error', $var);
        }
    }
}

function addInfo($msg) {
    if (!is_array($msg)) {
        pushFlash('flash_info', $msg);
    } else {
        foreach ($msg as $key => $var) {
            pushFlash('flash_info', $var);
        }
    }
}

function addSuccess($msg) {
    if (!is_array($msg)) {
        pushFlash('flash_success', $msg);
    } else {
        foreach ($msg as $key => $var) {
            pushFlash('flash_success', $var);
        }
    }
}

function addValidatorMsg($arr) {
    foreach ($arr->getMessages() as $key => $var) {
        foreach ($var as $k => $v) {
            addError($v);
        }
    }
}

function touchFolder($path) {
    $path = public_path($path);

    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
}

function generateRandomUniqueName($length = 40) {
    return Str::random($length);
}

function generateRandomHtmlId($length = 20) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getValidImageMimeType() {
    return array(
        'image/gif', 'image/jpg', 'image/jpeg', 'image/png'
    );
}

function isImage($name) {
    if (\Input::hasFile($name)) {
        $images_mimes = getValidImageMimeType();

        if (in_array(\Input::file($name)->getMimeType(), $images_mimes)) {
            return true;
        }
    }

    return false;
}

function isChinaMobile($contact_number) {
    return preg_match("/^1([0-9]{10})$/", $contact_number);
}

function generateSmsCode($len) {
    return strtoupper(substr(str_shuffle(str_repeat('0123456789', $len)), 0, $len));
}

function convertMimeToExt($mime) {
    if ($mime == 'image/jpeg')
        $extension = '.jpg';
    elseif ($mime == 'image/png')
        $extension = '.png';
    elseif ($mime == 'image/gif')
        $extension = '.gif';
    else
        $extension = '';

    return $extension;
}

function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds') {
    $sets = array();
    if (strpos($available_sets, 'l') !== false)
        $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    if (strpos($available_sets, 'u') !== false)
        $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
    if (strpos($available_sets, 'd') !== false)
        $sets[] = '23456789';
    if (strpos($available_sets, 's') !== false)
        $sets[] = '!@#$%&*?';

    $all = '';
    $password = '';
    foreach ($sets as $set) {
        $password .= $set[array_rand(str_split($set))];
        $all .= $set;
    }

    $all = str_split($all);
    for ($i = 0; $i < $length - count($sets); $i++)
        $password .= $all[array_rand($all)];

    $password = str_shuffle($password);

    if (!$add_dashes)
        return $password;

    $dash_len = floor(sqrt($length));
    $dash_str = '';
    while (strlen($password) > $dash_len) {
        $dash_str .= substr($password, 0, $dash_len) . '-';
        $password = substr($password, $dash_len);
    }
    $dash_str .= $password;
    return $dash_str;
}

function notEmpty($value) {
    if ($value != '' && $value != null && $value != false) {
        return true;
    } else {
        return false;
    }
}

function isEmpty($value) {
	return notEmpty($value) === true ? false : true;
}

function notDigit($value) {
	if ($value != '' && $value != null && $value != false && $value != true && $value >= 0 && ctype_digit((string)$value)) {
        return false;
    } else {
        return true;
    }
}

function isDigit($value) {
    if ($value != '' && $value != null && $value != false && $value != true && $value >= 0 && ctype_digit((string)$value)) {
        return true;
    } else {
        return false;
    }
}

function isFund($value) {
    return preg_match_all('/[\d](.[\d]{1,2})?/im' ,$value) ? true : false;
}

function notFund($value) {
    return preg_match_all('/[\d](.[\d]{1,2})?/im' ,$value) ? false : true;
}

function isPercentage($value) {
    if (is_numeric($value) && $value <= 100) {
        return true;
    } else {
        return false;
    }
}

function notPercentage($value) {
    if (is_numeric($value) && $value <= 100) {
        return false;
    } else {
        return true;
    }
}

function isNumber($value) {
    return ctype_digit((string)$value) ? true : false;
}

function notNumber($value) {
    return ctype_digit((string)$value) ? false : true;
}

function isPost()
{
    return strtolower(request()->method()) == 'post' ? true : false;
}

function isAjax()
{
    return request()->ajax() ? true : false;
}

function string_contains($str, array $arr)
{
    foreach($arr as $a) {
        if (mb_stripos($str,$a) !== false) return true;
    }
    return false;
}

function getSensitiveName() {
    $sensitive_name = array(
        'admin', 'moderator', 'operator',
    );

    return $sensitive_name;
}

function checkSensitiveName($name) {
    $sensitive_name = getSensitiveName();
    return string_contains(strtolower($name), $sensitive_name);
}

function writeErrorLog($log) {
    if ($log instanceof \Exception) {
        Log::error(
            "ERROR CODE = " . $log->getCode() . ": \n" . "Unexpected ERROR on " . $log->getFile() . " LINE: " . $log->getLine() . ", " . $log->getMessage() . "\n"
        );
    } else {
        Log::error($log);
    }
}

function toFund($value) {
    return number_format($value, 2);
}

function pc_permute($items, $perms = array()) {
    if (empty($items)) {
        return join(',', $perms);
    } else {
        $lists = array();
        for ($i = count($items) - 1; $i >= 0; --$i) {
            $newitems = $items;
            $newperms = $perms;
            list($foo) = array_splice($newitems, $i, 1);
            array_unshift($newperms, $foo);
            $tmp = pc_permute($newitems, $newperms);
            $lists[] = str_replace(',', '', $tmp);
        }

        return $lists;
    }
}

function noticeDeveloper($string, $file, $line, $extra = null) {

    Mail::send('emails.developer', ['string' => $string, 'file' => $file, 'line' => $line, 'extra' => $extra], function($m)
    {
        $now = new Carbon\Carbon();
        $m->from(env('MAIL_USERNAME'), 'System Alert - ' . $now->format('d-m-Y'));

        $m->to(env('DEVELOPER_EMAIL'), 'Developer')
            ->subject('System Error!');
    });
}

function buildRemoteLinkHtml($arr) {
    $url = isset($arr['url']) ? $arr['url'] : '#';
    $description = isset($arr['description']) ? $arr['description'] : 'button';
    $color = isset($arr['color']) ? $arr['color'] : 'blue';
    $modal = isset($arr['modal']) ? $arr['modal'] : '#remote-modal-large';

    return sprintf('<a href="%s" data-toggle="modal" data-target="%s" class="btn btn-xs primary uppercase %s">%s</a>', $url, $modal, $color, $description);
}

function buildRemoteLink($arr) {
    $url = isset($arr['url']) ? $arr['url'] : '#';
    $description = isset($arr['description']) ? $arr['description'] : 'button';
    $color = isset($arr['color']) ? $arr['color'] : 'blue';
    return sprintf('<a href="%s" class="btn btn-xs primary uppercase %s">%s</a>', $url, $color, $description);
}

function buildConfirmationLinkHtml($arr) {
    $url = isset($arr['url']) ? $arr['url'] : '#';
    $description = isset($arr['description']) ? $arr['description'] : 'button';
    $color = isset($arr['color']) ? $arr['color'] : 'red';
    $title = isset($arr['title']) ? $arr['title'] : 'Confirm?';
    $content = isset($arr['content']) ? $arr['content'] : 'Are you sure?';
    $redirect = isset($arr['redirect']) && in_array($arr['redirect'], [true, 1, '1', 'yes']) ? 'yes' : 'no';
    $modal = isset($arr['modal']) ? $arr['modal'] : '#confirm-modal';

    return sprintf('<a data-href="%s" class="uppercase btn btn-xs primary %s" data-redirect="%s" data-toggle="modal" data-target="%s" data-header="%s" data-body="%s">%s</a>', $url, $color, $redirect, $modal, $title, $content, $description);
}

function getMetronicColours() {
    $arr = array(
        'white', 'default', 'dark', 'blue', 'blue-madison', 'blue-chambray', 'blue-ebonyclay', 'blue-hoki',
        'blue-steel', 'blue-soft', 'blue-dark', 'blue-sharp', 'green', 'green-meadow', 'green-seagreen', 'green-turquoise',
        'green-haze', 'green-jungle', 'green-soft', 'green-dark', 'green-sharp', 'grey', 'grey-steel',
        'grey-cararra', 'grey-gallery', 'grey-cascade', 'grey-silver', 'grey-salsa', 'grey-salt', 'grey-mint',
        'red', 'red-pink', 'red-sunglo', 'red-intense', 'red-thunderbird', 'red-flamingo', 'red-soft', 'red-haze',
        'red-mint', 'yellow', 'yellow-gold', 'yellow-casablanca', 'yellow-crusta', 'yellow-lemon', 'yellow-saffron',
        'yellow-soft', 'yellow-haze', 'yellow-mint', 'purple', 'purple-plum', 'purple-medium', 'purple-studio',
        'purple-wisteria', 'purple-seance', 'purple-intense', 'purple-sharp', 'purple-soft',
    );

    return $arr;
}

function getRandomMetronicColour() {
    $arr = getMetronicColours();
    return $arr[array_rand($arr)];
}

function makeResponse($msg, $error = false) {
    $status = $error === false ? 200 : 422;

    if (is_array($msg)) {
        $bag = new MessageBag();
        foreach ($msg as $key => $var) {
            $bag->add($key, $var);
        }
    } else if (is_string($msg)) {
        $bag = new MessageBag();
        $bag->add(generateRandomUniqueName(), $msg);
    } else if ($msg == null || $msg == '' || $msg == false || empty($msg)) {
        $bag = new MessageBag();
        $bag->add('unknown_error', trans('common.unknown_error'));
    } else {
        $bag = $msg;
    }

    if (isAjax()) {
        return new JsonResponse($bag->toArray(), $status);
    } else {
        return redirect()->back()
            ->withInput()
            ->withErrors($bag->toArray());
    }
}

function convertCNDateTimePicker($value){
    //01 三月 2016 - 14:25 ($value)
    //01 March 2016 - 14:25 ($result)

    if (strpos($value, '一月') !== false) {
        $result = str_replace('一月', 'January', $value);
        return $result;
    }else if(strpos($value, '二月') !== false){
        $result = str_replace('二月', 'February', $value);
        return $result;
    }else if(strpos($value, '三月') !== false){
        $result = str_replace("三月", "March", $value);
        return $result;
    }else if(strpos($value, '四月') !== false){
        $result = str_replace('四月', 'April', $value);
        return $result;
    }else if(strpos($value, '五月') !== false){
        $result = str_replace('五月', 'May', $value);
        return $result;
    }else if(strpos($value, '六月') !== false){
        $result = str_replace('六月', 'June', $value);
        return $result;
    }else if(strpos($value, '七月') !== false){
        $result = str_replace('七月', 'July', $value);
        return $result;
    }else if(strpos($value, '八月') !== false){
        $result = str_replace('八月', 'August', $value);
        return $result;
    }else if(strpos($value, '九月') !== false){
        $result = str_replace('九月', 'September', $value);
        return $result;
    }else if(strpos($value, '十月') !== false){
        $result = str_replace('十月', 'October', $value);
        return $result;
    }else if(strpos($value, '十一月') !== false){
        $result = str_replace('十一月', 'November', $value);
        return $result;
    }else if(strpos($value, '十二月') !== false){
        $result = str_replace('十二月', 'December', $value);
        return $result;
    }
}

function convertENDateTimePicker($value){
    //01 三月 2016 - 14:25 ($value)
    //01 March 2016 - 14:25 ($result)

    if (strpos($value, 'January') !== false) {
        $result = str_replace('January', '一月', $value);
        return $result;
    }else if(strpos($value, 'February') !== false){
        $result = str_replace('February', '二月', $value);
        return $result;
    }else if(strpos($value, 'March') !== false){
        $result = str_replace("March", "三月", $value);
        return $result;
    }else if(strpos($value, 'April') !== false){
        $result = str_replace('April', '四月', $value);
        return $result;
    }else if(strpos($value, 'May') !== false){
        $result = str_replace('May', '五月', $value);
        return $result;
    }else if(strpos($value, 'June') !== false){
        $result = str_replace('June', '六月', $value);
        return $result;
    }else if(strpos($value, 'July') !== false){
        $result = str_replace('July', '七月', $value);
        return $result;
    }else if(strpos($value, 'August') !== false){
        $result = str_replace('August', '八月', $value);
        return $result;
    }else if(strpos($value, 'September') !== false){
        $result = str_replace('September', '九月', $value);
        return $result;
    }else if(strpos($value, 'October') !== false){
        $result = str_replace('October', '十月', $value);
        return $result;
    }else if(strpos($value, 'November') !== false){
        $result = str_replace('November', '十一月', $value);
        return $result;
    }else if(strpos($value, 'December') !== false){
        $result = str_replace('December', '十二月', $value);
        return $result;
    }
}

function convertCNDatePicker($value){
    //1900年12月10日 ($value)
    //1900-12-10($result)

    $result = str_replace('年', '-', $value);
    $result = str_replace('月', '-', $result);
    $result = str_replace('日', '', $result);
    return $result;
}

function buildLinkHtml($arr) {
    $url = isset($arr['url']) ? $arr['url'] : '#';
    $description = isset($arr['description']) ? $arr['description'] : 'button';
    $color = isset($arr['color']) ? $arr['color'] : 'blue';

    return sprintf('<a href="%s" class="btn btn-xs primary uppercase %s">%s</a>', $url, $color, $description);
}