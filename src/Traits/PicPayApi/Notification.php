<?php

namespace Hdelima\PicPayGateway\Traits\PicPayApi;

trait Notification
{
    public function createNotification(
        int $referenceId,
        string $authorizationId
    ) {
        $this->endpoint = 'callback';

        $this->url = collect([
            $this->config['api_url'],
            $this->endpoint,
        ])->implode('/');

        $this->setPicPayToken();

        return $this->doPicPayRequest();
    }

    public function getNotifications(int $page = 1, int $limit = 15)
    {
        $this->endpoint = \sprintf(
            'picpay-gateway/notifications?page=%s&limit=%s',
            $page,
            $limit
        );

        $this->url = collect([url('/'), $this->endpoint])->implode('/');

        $this->verb = 'GET';

        return $this->doPicPayRequest();
    }

    public function showNotification(int $id)
    {
        $this->endpoint = \sprintf('picpay-gateway/notifications/%s', $id);

        $this->url = collect([url('/'), $this->endpoint])->implode('/');

        $this->verb = 'GET';

        return $this->doPicPayRequest();
    }

    public function updateNotification(int $id, array $data)
    {
        $this->endpoint = \sprintf('picpay-gateway/notifications/%s', $id);

        $this->url = collect([url('/'), $this->endpoint])->implode('/');

        $this->verb = 'PATCH';

        $this->validate($data, [
            'seller'            => 'nullable',
            'authorizationId'   => 'nullable',
            'status'            => 'nullable',
        ]);

        $this->options['json'] = $data;

        return $this->doPicPayRequest();
    }
}
