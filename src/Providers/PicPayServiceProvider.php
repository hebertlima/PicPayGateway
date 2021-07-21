<?php

namespace Hdelima\PicPayGateway\Providers;

use Illuminate\Support\ServiceProvider;
use Hdelima\PicPayGateway\Services\PicPay as PicPayClient;

class PicPayServiceProvider extends ServiceProvider {

    protected $defer = false;

    public function boot()
	{
		$this->publishes([
			__dir__ . '/../../config/config.php' => config_path('picpay_gateway.php'),
		]);

		$this->loadRoutesFrom( __dir__ . '/../../config/routes.php');

		$this->loadJsonTranslationsFrom( __dir__ . '/../../lang', 'picpay_gateway');

		$this->loadMigrationsFrom( __dir__ . '/../../migrations');
	}

	public function register()
	{
		$this->registerPicPayGateway();

		$this->app->make('Hdelima\PicPayGateway\Controller\PicPayNotificationController');

		$this->mergeConfig();
	}

	private function registerPicPayGateway()
	{
		$this->app->singleton('picpay_gateway_client', static function () {
			return new PicPayClient();
		});
	}

	private function mergeConfig()
	{
		$this->mergeConfigFrom(
			__dir__.'/../../config/config.php',
			'picpay_gateway'
		);
	}
}
