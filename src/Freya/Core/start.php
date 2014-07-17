<?php

/*
|--------------------------------------------------------------------------
| Register The Freya Auto Loader
|--------------------------------------------------------------------------
| We register an auto-loader "behind" the Composer loader that can load
| model classes on the fly, even if the autoload files have not been
| regenerated for the application. We'll add it to the stack here.
|
*/

$autoloader = new \Freya\Helpers\ClassLoader;
$autoloader->addPrefix('Freya', __DIR__ . '/../app/Freya');
$autoloader->register();

/*
|--------------------------------------------------------------------------
| Setup Patchwork UTF-8 Handling
|--------------------------------------------------------------------------
|
| The Patchwork library provides solid handling of UTF-8 strings as well
| as provides replacements for all mb_* and iconv type functions that
| are not available by default in PHP. We'll setup this stuff here.
|
*/

\Patchwork\Utf8\Bootup::initMbstring();

/*
|--------------------------------------------------------------------------
| Register Application Exception Handling
|--------------------------------------------------------------------------
|
| We will go ahead and register the application exception handling here
| which will provide a great output of exception details and a stack
| trace in the case of exceptions while an application is running.
|
*/

$app->startExceptionHandling();

$run = new \Whoops\Run();
        $run->register();
        
        $prettyPageHandler = new \Whoops\Handler\PrettyPageHandler();
        $run->pushHandler($prettyPageHandler);
        
        $jsonResponseHandler = new \Whoops\Handler\JsonResponseHandler();
        $jsonResponseHandler->onlyForAjaxRequests(true);
        $run->pushHandler($jsonResponseHandler);


/*
|--------------------------------------------------------------------------
| Set default timezone
|--------------------------------------------------------------------------
| This is mandatory if we don't want PHP to throw a warning.
|
*/
        
date_default_timezone_set($app['config']['app.timezone']);
