<?php

define('LARAVEL_START', microtime(true));
define('COMMON_SAVE_OK', 'Save successful');
define('COMMON_SAVE_FAIL', 'Save fail');
define('COMMON_DELETE_OK', 'Delete successful');
define('COMMON_DELETE_FAIL', 'Delete fail');
define('AT_LEAST_1_RECORD', 'You must choose at least 1 record');
/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Include The Compiled Class File
|--------------------------------------------------------------------------
|
| To dramatically increase your application's performance, you may use a
| compiled class file which contains all of the classes commonly used
| by a request. The Artisan "optimize" is used to create this file.
|
*/

$compiledPath = __DIR__.'/cache/compiled.php';

if (file_exists($compiledPath)) {
    require $compiledPath;
}
