<?php

namespace Hdelima\PicPayGateway\Traits;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as HttpClientException;
use Psr\Http\Message\StreamInterface;
use RuntimeException;

trait PicPayHttpClient {

    private $client;

    private $httpClientConfig;

    private $url;

    private $endpoint;

    private $bodyParams;

    protected $verb = 'post';

    protected function setCurlConstants()
    {
        $constants = [
            'CURLOPT_SSLVERSION'        => 32,
            'CURL_SSLVERSION_TLSv1_2'   => 6,
            'CURLOPT_SSL_VERIFYPEER'    => 64,
            'CURLOPT_SSLCERT'           => 10025,
        ];

        foreach ($constants as $key => $value) {
            if (!defined($key)) {
                define($key, $constants[$key]);
            }
        }
    }

    public function setClient( $client = null )
	{
		if( !$client instanceof HttpClient )
			$client = new HttpClient(['curl' => $this->httpClientConfig ]);

		$this->client = $client;
	}

    protected function setHttpClientConfig()
	{
		$this->setCurlConstants();

		$this->httpClientConfig = [
			CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2
		];

		$this->setClient();

		$this->setDefaultValues();
	}

    private function setDefaultValues()
	{
		$this->xPicpaytoken = $this->config['x-picpay-token'];
		$this->xSellertoken = $this->config['x-seller-token'];
	}

    private function makeRequest()
	{
		try {
			return $this->client->{$this->verb}(
				$this->url,
				$this->options
			)->getBody();
		} catch (HttpClientException $e) {
			throw new RuntimeException( $e->getResponse()->getBody() );
		}
	}

    private function doPicPayRequest( $decode = true )
	{
		try {
			$response = $this->makeRequest();
			return $decode ? $response->getContents() : \GuzzleHttp\json_decode($response, true);
		} catch (RuntimeException $e ) {
			$message = collect( $e->getMessage() )->implode('\n');
		}

		return [
			'type' 		=> 'error',
			'message' 	=> $message
		];
	}
}
