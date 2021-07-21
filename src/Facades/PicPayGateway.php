<?php

namespace Hdelima\PicPayGateway\Facades;

use Illuminate\Support\Facades\Facade;

class PicPayGateway extends Facade {

	protected static function getFacadeAccessor()
	{
		return 'Hdelima\PicPayGateway\PicPayGatewayFacadeAccessor';
	}
}
