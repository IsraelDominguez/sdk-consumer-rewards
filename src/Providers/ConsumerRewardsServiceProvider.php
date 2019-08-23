<?php namespace ConsumerRewards\SDK\Providers;

use ConsumerRewards\SDK\ConsumerRewards;
use Illuminate\Support\ServiceProvider;

class ConsumerRewardsServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishResources();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ConsumerRewards', function() {
            $cr_config = [
                'username' => config('consumer_rewards.username'),
                'password' => config('consumer_rewards.password'),
                'api' => config('consumer_rewards.api'),
                'web' => config('consumer_rewards.web'),
            ];
            $cr_options = [
                'logger' => app('log')->channel('stack')->getLogger()
            ];

            return new ConsumerRewards($cr_config, $cr_options);
        });
    }

    private function publishResources() {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/consumer_rewards.php' => config_path('consumer_rewards.php')
            ], 'config');
        }
    }
}
