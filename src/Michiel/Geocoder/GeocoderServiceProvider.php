<?php namespace Michiel\Geocoder;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class GeocoderServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('michiel/geocoder');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		AliasLoader::getInstance()->alias('Geocoder', 'Michiel\Geocoder\Geocoder');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['Geocoder'];
	}

}
