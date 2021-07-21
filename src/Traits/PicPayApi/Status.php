<?php

namespace Hdelima\PicPayGateway\Traits\PicPayApi;

trait Status
{
    public function getStatus(int $id)
    {
        $this->endpoint = \sprintf('payments/%s/status', $id);

        $this->url = collect([
            $this->config['api_url'],
            $this->endpoint,
        ])->implode('/');

        $this->verb = 'GET';

        $this->setPicPayToken();

        return $this->doPicPayRequest();
    }
}
