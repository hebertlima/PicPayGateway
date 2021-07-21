<?php

namespace Hdelima\PicPayGateway\Services;

use Exception;
use Hdelima\PicPayGateway\Traits\PicPayRequest as PicPayApiRequest;

class PicPayGateway {
    use PicPayApiRequest;

    public function __construct( $config = '' )
	{
		if ( is_array( $config ) )
			$this->setConfig( $config );

		$this->bodyParams = 'form_params';

		$this->options = [];

		$this->options['headers'] = [
			'Accept' => 'application/json',
            'Accept-Encoding' => 'gzip'
		];
	}

	protected function setOptions( $credentials )
	{
		$this->config['api_url'] = "https://appws.picpay.com/ecommerce/public";

		if ( empty( $credentials['x-picpay-token'] ) || empty( $credentials['x-seller-token'] ) ) {
            $invalid = empty( $credentials['x-picpay-token'] ) ? 'x-picpay-token' : 'x-seller-token';
            throw new RuntimeException("Please provide valid $invalid to use PicPay API.");
        }

		$this->config['x-picpay-token'] = $credentials['x-picpay-token'];
		$this->config['x-seller-token'] = $credentials['x-seller-token'];
	}
}
