<?php namespace Jsehersan\Social;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Thujohn\Twitter\Twitter;

class SocialServiceProvider extends ServiceProvider {

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
		$this->package('jsehersan/social');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
        $app = $this->app;

        $app['social'] = $app->share(function ($app) {
            return new Social;
        });
        require __DIR__.'/../../routes.php';
        require __DIR__.'/../../filters.php';
        // Registramos el componente de twitter
        App::register('Thujohn\Twitter\TwitterServiceProvider');
        $this->app->bind('SocialTw', function($app)
        {
            return new Twitter(Config::get('social::twitter'), $app['session.store']);
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
