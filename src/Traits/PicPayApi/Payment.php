<?php

namespace Hdelima\PicPayGateway\Traits\PicPayApi;

trait Payment
{
    public function createPayment(array $data)
    {
        $this->endpoint = 'payments';

        $this->url = collect([
            $this->config['api_url'],
            $this->endpoint,
        ])->implode('/');

        $this->verb = 'POST';

        $this->validate($data, [
            'referenceId' => 'required',
            'callbackUrl' => 'required',
            'returnUrl' => 'required',
            'value' => 'required',
            'expiresAt' => 'required',
            'channel' => 'required',
            'purchaseMode' => 'required',
            'buyer' => 'required',
            'buyer.firstName' => 'required',
            'buyer.lastName' => 'required',
            'buyer.document' => 'required',
            'buyer.email' => 'required',
            'buyer.phone' => 'required',
        ]);

        $this->options['json'] = $data;

        $this->setPicPayToken();

        return $this->doPicPayRequest();
    }
}
