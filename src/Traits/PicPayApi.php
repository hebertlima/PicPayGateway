<?php

namespace Hdelima\PicPayGateway\Traits;

use Illuminate\Support\Facades\Validator;

trait PicPayApi
{
    use PicPayApi\Payment;
    use PicPayApi\Notification;
    use PicPayApi\Cancellation;

    public function setPicPayToken()
    {
        $this->options['headers']['x-picpay-token'] = $this->xPicpaytoken;
    }

    public function setSellerToken()
    {
        $this->options['headers']['x-seller-token'] = $this->xSellertoken;
    }

    public function validate(array $data, array $rules)
    {
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            $text = '';

            foreach ($errors->all() as $message) {
                $text .= $message . PHP_EOL;
            }

            throw new \Exception($text);
        }
    }
}
