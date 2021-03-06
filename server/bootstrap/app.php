<?php

require_once __DIR__ . '/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
	dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
	dirname(__DIR__)
);

$app->withFacades();

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
	Illuminate\Contracts\Debug\ExceptionHandler::class,
	App\Exceptions\Handler::class
);

$app->singleton(
	Illuminate\Contracts\Console\Kernel::class,
	App\Console\Kernel::class
);

$app->singleton(
	Illuminate\Contracts\Http\Kernel::class,
	App\Http\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
|
| Now we will register the "app" configuration file. If the file exists in
| your configuration directory it will be loaded; otherwise, we'll load
| the default version. You may register other files below as needed.
|
*/

collect(scandir(__DIR__ . '/../config'))->each(function ($item) use ($app) {
	$app->configure(basename($item, '.php'));
});

/* Register Middleware */


$app->Middleware([
	'api' => App\Http\Middleware\CorsMiddleware::class
]);

$app->routeMiddleware([
	'auth' => App\Http\Middleware\Authenticate::class,
]);


/* Register Service Providers */

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(BeyondCode\LaravelWebSockets\WebSocketsServiceProvider::class);

/* Load The Application Routes */
$app->router->group([
	'namespace' => 'App\Http\Controllers',
], function ($router) {
	require __DIR__ . '/../routes/web.php';
});

return $app;
