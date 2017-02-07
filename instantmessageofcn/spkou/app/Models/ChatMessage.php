<?php

namespace App\Models;

use Input;

class ChatMessage extends BaseModels {

    protected $table = 'chat_messages';

    public function scopeGetChatMessage($query) {
        return $query;
    }

    public function SendBy(){
        return $this->belongsTo('App\Models\User', 'sender_user_id', 'id');
    }

    public function ReceiveBy(){
        return $this->belongsTo('App\Models\User', 'receiver_user_id', 'id');
    }

    public static function getRecentChat(){
    	$userId = \Auth::guard('users')->user()->id;
    	$recents = static::GetChatMessage()
        		->orWhere(function ($query) use ($userId){
	                $query->where('receiver_user_id',$userId);
	            })
        		->groupBy(['sender_user_id'])
        		->orderBy('created_at','desc')
                ->get();
        $lists = array();
        foreach ($recents as $key => $var) {
        	$email 		= '';
        	$userLink 	= 0;
        	if($var->receiver_user_id == $userId){
        		$email 		= $var->SendBy()->first()->email;
        		$userLink 	= $var->sender_user_id;
        	}else{
        		$email = $var->ReceiveBy()->first()->email;
        		$userLink 	= $var->receiver_user_id;
        	}
        	$name = explode('@', $email);
        	if(count($name) >= 2){
        		$name = $name[0];
        	}else{
        		$name = $email;
        	}
        	$lists[$userLink]['email'] 			= $name;
            $lists[$userLink]['last_chat'] 		= $var->message;
        	$lists[$userLink]['time'] 			= $var->created_at;
        }
        return $lists;
    }

    public static function pullChatMessage($userRelative = null){
        $userId                     = \Auth::guard('users')->user()->id;
        $userRel                    = \App\Models\user::find($userRelative)->email;
        $filter                     = array();
        $filter['userId']           = $userId;
        $filter['userRelative']     = $userRelative;

        //user relative
        $realName = $userRel;
        $userRel = explode('@', $userRel);
        if(count($userRel) >= 2){
            $realName = $userRel[0];
        }

        $recents = static::with(['SendBy'])->GetChatMessage()
                ->where(function ($query) use ($filter){
                    $query->where('sender_user_id',$filter['userRelative'])
                          ->where('receiver_user_id',$filter['userId']);
                })
                ->orWhere(function ($query) use ($filter){
                    $query->where('sender_user_id',$filter['userId'])
                          ->where('receiver_user_id',$filter['userRelative']);
                })
                ->orderBy('created_at','desc')
                ->get();

        $lists = array();
        foreach ($recents as $key => $var) {
            $email      = $var->SendBy->email;
            $status     = 'in';
            if($var->sender_user_id == $userId){
                $status = 'out';
            }
            $name = explode('@', $email);
            if(count($name) >= 2){
                $name = $name[0];
            }else{
                $name = $email;
            }

            $lists[$var->id]['email']           = $name;
            $lists[$var->id]['content']         = $var->message;
            $lists[$var->id]['time']            = $var->created_at;
            $lists[$var->id]['status']          = $status;
        }
        return [
                    'receiverId'    => $filter['userRelative'],
                    'realName'      => $realName,
                    'lists'         => $lists
                ];
    }

    public static function pullChatOrderMessage($orderId = null){
        $filter = array();
        $filter['orderId'] = $orderId;
        $recents = static::GetChatMessage()
                ->where(function ($query) use ($filter){
                    $query->where('order_id',$filter['orderId']);
                })
                ->orderBy('created_at','asc')
                ->get();

        $lists = array();
        $i = 0;
        foreach ($recents as $key => $var) {
            $status     = 'out';
            if(\Auth::guard('users')->user() && $var->sender_user_id == \Auth::guard('users')->user()->id){
                $status = 'in';
            }
            if(is_numeric($var->sender_staff_id) && $var->sender_staff_id > 0){
                if(\Auth::guard('staff')->user()){
                    $status             = 'in';
                }else{
                    $status             = 'out';
                }
                $name                   = 'Help Desk';
                $lists[$i]['avatar']    = asset('images/avatar.png');                
            }else{
                if($var->SendBy()->first()->nick_name != ''){
                    $name = $var->SendBy()->first()->nick_name;
                }else{
                    $email      = $var->SendBy()->first()->email;
                    $name       = explode('@', $email);
                    if(count($name) >= 2){
                        $name = $name[0];
                    }else{
                        $name = $email;
                    }
                }
                $lists[$i]['avatar']          = $var->sendBy()->first()->getAvatar();
            }
            
            $lists[$i]['email']           = $name;
            $lists[$i]['content']         = $var->message;
            $lists[$i]['time']            = date('d M, Y H:i',strtotime($var->created_at));
            $lists[$i]['status']          = $status;
            $lists[$i]['date']            = date('Y-m-d',strtotime($var->created_at));
            $lists[$i]['file']            = $var->file;
            //check is image
            $isImage = 0;
            if(file_exists($var->file)){
                $a = getimagesize($var->file);
                $image_type = $a[2];
                if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
                {
                    $lists[$i]['content']         = str_replace('--file upload: ', '', $var->message);
                    $isImage = 1;
                }
            }
            $lists[$i]['isImage']          = $isImage;
            //check is audio
            $isAudio = 0;
            if(file_exists($var->file)){
                $allowed = array(
                    'audio/mpeg', 'audio/x-mpeg', 'audio/mpeg3', 'audio/x-mpeg-3', 'audio/aiff', 
                    'audio/mid', 'audio/x-aiff', 'audio/x-mpequrl','audio/midi', 'audio/x-mid', 
                    'audio/x-midi','audio/wav','audio/x-wav','audio/xm','audio/x-aac','audio/basic',
                    'audio/flac','audio/mp4','audio/x-matroska','audio/ogg','audio/s3m','audio/x-ms-wax',
                    'audio/xm','application/ogg','application/mp3','audio/mp3'
                );
                
                // check REAL MIME type
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $type = finfo_file($finfo, $var->file);
                finfo_close($finfo);
                
                // check to see if REAL MIME type is inside $allowed array
                if( in_array($type, $allowed) ) {
                    $isAudio = 1;
                }
            }
            $lists[$i]['isAudio']         = $isAudio;

            if($i == 0){
                $lists[$i]['changeDate']  = 1;
            }else{
                if($lists[$i]['date'] != $lists[$i-1]['date'])
                    $lists[$i]['changeDate']  = 1;
                else
                    $lists[$i]['changeDate']  = 0;
            }
            $i++;
        }
        return [
                    'lists'         => $lists
                ];
    }

    public static function pullChatMessageNew(){
    }

    public static function pullChatOrderMessageFile($orderId = null){
        $filter = array();
        $filter['orderId'] = $orderId;
        $recents = static::GetChatMessage()
                ->where(function ($query) use ($filter){
                    $query->where('order_id',$filter['orderId'])
                            ->where('file','!=','')
                            ->whereNotNull('file');
                })
                ->orderBy('created_at','desc')
                ->get();

        $lists = array();
        foreach ($recents as $key => $var) {
            if(file_exists($var->file) && pathinfo($var->file, PATHINFO_EXTENSION) == 'dwg'){
                $bytes = filesize($var->file);

                 if ($bytes >= 1073741824)
                {
                    $bytes = number_format($bytes / 1073741824, 2) . ' GB';
                }
                elseif ($bytes >= 1048576)
                {
                    $bytes = number_format($bytes / 1048576, 2) . ' MB';
                }
                elseif ($bytes >= 1024)
                {
                    $bytes = number_format($bytes / 1024, 2) . ' KB';
                }
                elseif ($bytes > 1)
                {
                    $bytes = $bytes . ' bytes';
                }
                elseif ($bytes == 1)
                {
                    $bytes = $bytes . ' byte';
                }
                else
                {
                    $bytes = '0 bytes';
                }

                $lists[$var->id]['file']            = $var->file;
                $lists[$var->id]['size']            = $bytes;
                $lists[$var->id]['content']         = str_replace('--file upload: ', '', $var->message);
                $lists[$var->id]['time']            = date('d M, Y H:i',strtotime($var->created_at));
            }
        }
        return [
                    'lists'         => $lists,
                    'count'         => count($lists)
                ];
    }

    
    public function setFileAttribute($file)
    {
        if ($file instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
            $ext = strtolower($file->getClientOriginalExtension());
            if (in_array($ext, ['dwg', 'plt', 'dxf'])) {
                $c = new \Carbon\Carbon();
                $path = 'uploads/order/conversation/' . \Auth::guard('users')->user()->id . '/' . $c->format('Y/m/');
                $filename = 'back_' . generateRandomUniqueName();

                touchFolder($path);

                $file->move($path, $filename.'.'.$ext);
                $this->attributes['file'] = $path. $filename.'.'.$ext;
                $this->attributes['is_cad_file'] = 1;
            }else{
                $img = \Image::make($file);
                $mime = $img->mime();
                $ext = convertMimeToExt($mime);

                $c = new \Carbon\Carbon();
                $idPath = \Auth::guard('users')->check() ? \Auth::guard('users')->user()->id : 'staff';
                $path = 'uploads/order/conversation/' . $idPath . '/' . $c->format('Y/m/');
                $filename = 'back_' . generateRandomUniqueName();

                touchFolder($path);

                $img = $img->save($path . $filename . $ext);

                $this->attributes['file'] = $path . $filename . $ext;
            }
        }
    }
}