<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Migration;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\MigrationsEnded;
use Tall\Migration\Commands\GenerateMigrationsCommand;

class TallMigrationProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/tall-migration.php',
            'tall-migration'
        );

        $this->publishes([
            __DIR__ . '/../stubs'                                  => resource_path('stubs/vendor/tall-migration'),
            __DIR__ . '/../config/tall-migration.php' => config_path('tall-migration.php')
        ]);

        if ($this->app->runningInConsole()) {
            $this->app->instance('tall-migration:time', now());
            $this->commands([
                GenerateMigrationsCommand::class
            ]);
        }
        if (config('tall-migration.run_after_migrations') && config('app.env') === 'local') {
            Event::listen(MigrationsEnded::class, function () {
                Artisan::call('generate:migrations');
            });
        }
    }
}
