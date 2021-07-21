<?php

namespace Hdelima\PicPayGateway\Traits\PicPayApi;

trait Cancellation
{
    public function createCancellation(int $referenceId, int $authorizationId)
    {
        $this->endpoint = \sprintf('payments/%s/cancellations', $referenceId);

        $this->url = collect([
            $this->config['api_url'],
            $this->endpoint,
        ])->implode('/');

        $this->verb = 'POST';

        $this->options['json'] = ['authorizationId' => $authorizationId];

        $this->setPicPayToken();

        return $this->doPicPayRequest();
    }
}
