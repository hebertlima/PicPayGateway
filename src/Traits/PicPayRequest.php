<?php
namespace Hdelima\PicPayGateway\Traits;

use RuntimeException;

trait PicPayRequest {
    use PicPayHttpClient, PicPayApi;

    protected $xPicpaytoken;

    protected $xSellertoken;

    private $config;

    protected $options;

    public function setCredentials( $credentials )
	{
		if( empty( $credentials ) )
			throw new RuntimeException('Empty configuration provided. Please provide valid configuration for PicPay Gateway API.');

		$this->setProviderConfig( $credentials );

		$this->setHttpClientConfig();
	}

    private function setConfig( array $config = [])
	{
		$config = function_exists('config') ? config('picpay_gateway') : $config;

		$this->setCredentials( $config );
	}

    private function setProviderConfig( $credentials )
	{
		$this->setOptions( $credentials );
	}
}
