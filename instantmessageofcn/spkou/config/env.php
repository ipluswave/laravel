<?php

return [

    'APP_ENV' => env('APP_ENV'),
    'APP_DEBUG' => env('APP_DEBUG'),
    'APP_KEY' => env('APP_KEY'),

    'DB_HOST' => env('DB_HOST'),
    'DB_DATABASE' => env('DB_DATABASE'),
    'DB_USERNAME' => env('DB_USERNAME'),
    'DB_PASSWORD' => env('DB_PASSWORD'),

    'CACHE_DRIVER' => env('CACHE_DRIVER'),
    'SESSION_DRIVER' => env('SESSION_DRIVER'),
    'QUEUE_DRIVER' => env('QUEUE_DRIVER'),

    'REDIS_HOST' => env('REDIS_HOST', '127.0.0.1'),
    'REDIS_PASSWORD' => env('REDIS_PASSWORD', null),
    'REDIS_PORT' => env('REDIS_PORT', '6379'),

    'DOMAIN' => env('DOMAIN', 'http://localhost'),

    'MAIL_DRIVER' => env('MAIL_DRIVER'),
    'MAIL_HOST' => env('MAIL_HOST'),
    'MAIL_PORT' => env('MAIL_PORT'),
    'MAIL_USERNAME' => env('MAIL_USERNAME'),
    'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
    'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),

    'WEIBO_KEY' => env('WEIBO_KEY', '1146990347'),
    'WEIBO_SECRET' => env('WEIBO_SECRET', '5e1884d49c71652db42292454d433ba8'),
    'WEIBO_REDIRECT_URI' => env('WEIBO_REDIRECT_URI', 'http://spkou.com/auth/weibo/callback'),

    'QQ_KEY' => env('QQ_KEY', '101298417'),
    'QQ_SECRET' => env('QQ_SECRET', '8c12c64d6d69b7c7a4f18b8fa0c1e341'),
    'QQ_REDIRECT_URI' => env('QQ_REDIRECT_URI', 'http://spkou.com/auth/qq/callback'),

    'WEIXIN_KEY' => env('WEIXIN_KEY', 'wxd9f6bca0ab86e71d'),
    'WEIXIN_SECRET' => env('WEIXIN_SECRET', 'f428827f0ad6a6f82c51456e757b9181'),
    'WEIXIN_REDIRECT_URI' => env('WEIXIN_REDIRECT_URI', 'http://spkou.com/auth/weixin/callback'),

    'WEIXINWEB_KEY' => env('WEIXINWEB_KEY', 'wxd9f6bca0ab86e71d'),
    'WEIXINWEB_SECRET' => env('WEIXINWEB_SECRET', 'f428827f0ad6a6f82c51456e757b9181'),
    'WEIXINWEB_REDIRECT_URI' => env('WEIXINWEB_REDIRECT_URI', 'http://spkou.com/auth/weixinweb/callback'),

    'PINGPP_APP_ID' => env('PINGPP_APP_ID', 'app_PyrbXLmHa1OK44Ci'),

    'ALISMS_KEY' => env('ALISMS_KEY', '23362503'),
    'ALISMS_SECRETKEY' => env('ALISMS_SECRETKEY', 'c0263f786c5607968a0d908674d209dc'),
    'ALISMS_TEMPLATE_NAME_FOR_REGISTER' => env('ALISMS_TEMPLATE_NAME_FOR_REGISTER', 'SMS_8966168'),
    'ALISMS_TEMPLATE_NAME_FOR_RESET' => env('ALISMS_TEMPLATE_NAME_FOR_RESET', 'SMS_9120027'),
    'ALISMS_SIGNATURE_NAME' => env('ALISMS_SIGNATURE_NAME', '双排扣'),

    'RACHET_IPPORT' => env('RACHET_IPPORT', '127.0.0.1:8080')
];
