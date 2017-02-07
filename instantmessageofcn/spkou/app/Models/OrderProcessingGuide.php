<?php

namespace App\Models;

use Input;

class OrderProcessingGuide extends BaseModels {
    protected $table = 'order_processing_guide';

    protected $fillable = [
        ''
    ];

    public static function boot() {
        parent::boot();
    }

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }

    public function setImagePathAttribute($file)
    {
        if ($file instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
            $c = new \Carbon\Carbon();
            $path = 'uploads/order/' . \Auth::guard('users')->user()->id . '/guide/' . $c->format('Y/m/');
            $filename = generateRandomUniqueName();
            $ext = strtolower($file->getClientOriginalExtension());

            //If is cad file, upload only
            if (in_array($ext, ['dwg', 'plt', 'dxf'])) {
                $file->move($path);
                $this->attributes['image_path'] = $path . $filename . $ext;
            } else {
                $img = \Image::make($file);
                $mime = $img->mime();
                $ext = convertMimeToExt($mime);

                touchFolder($path);

                $img = $img->fit(800)->save($path . $filename . $ext, 90);

                $this->attributes['image_path'] = $path . $filename . $ext;
            }
        } else if (is_string($file)) {
            $this->attributes['image_path'] = $file;
        }

    }
}