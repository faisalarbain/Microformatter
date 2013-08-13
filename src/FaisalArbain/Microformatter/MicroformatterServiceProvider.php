<?php namespace FaisalArbain\Microformatter;

use Illuminate\Support\ServiceProvider;
use FaisalArbain\Microformatter\Microformatter;

class MicroformatterServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		$this->package('faisalarbain/microformatter');
	}
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['microformatter'] = $this->app->share(function($app){
			return new Microformatter();
		});	
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('microformatter');
	}

}