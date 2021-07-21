<?php

namespace Hdelima\PicPayGateway;

use Exception;
use Hdelima\PicPayGateway\Services\PicPayGateway as PicPayGatewayClient;

class PicPayGatewayFacadeAccessor {
    public static $provider;

    public static function getProvider() {
        return self::$provider;
    }

    public static function setProvider()
	{
		self::$provider = new PicPayGatewayClient();

		return self::getProvider();
	}
}
