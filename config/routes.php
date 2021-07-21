<?php

use Illuminate\Support\Facades\Route;
use Hdelima\PicPayGateway\Controller\PicPayNotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| PicPay web routes
|
*/

Route::apiResource('picpay-gateway/notifications', PicPayNotificationController::class);
