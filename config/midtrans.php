<?php
return [
    'serverKey' => env('MIDTRANS_SERVER_KEY', ''),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION', false),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is3Ds' => env('MIDTRANS_IS_3DS', true)
];
