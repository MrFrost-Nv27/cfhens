<?php

use App\Controllers\Api\DiseaseController;
use App\Controllers\Api\RuleController;
use App\Controllers\Api\SymptomController;
use App\Controllers\Frontend\Manage;
use App\Controllers\Migrate;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->addPlaceholder('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');

service('auth')->routes($routes);

$routes->environment('development', static function ($routes) {
    $routes->get('migrate', [Migrate::class, 'index']);
    $routes->get('migrate/(:any)', [Migrate::class, 'execute']);
});

$routes->group('kelola', static function (RouteCollection $routes) {
    $routes->get('', [Manage::class, 'index']);
    $routes->get('disease', [Manage::class, 'disease']);
    $routes->get('symptom', [Manage::class, 'symptom']);
    $routes->get('rule', [Manage::class, 'rule']);
    // $routes->get('implementasi', [Manage::class, 'implementasi']);
});

$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    $routes->group('v2', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    });
    $routes->post('implementasi', [Manage::class, 'implementasi']);
    $routes->resource('disease', ['namespace' => '', 'controller' => DiseaseController::class, 'websafe' => 1]);
    $routes->resource('symptom', ['namespace' => '', 'controller' => SymptomController::class, 'websafe' => 1]);
    $routes->resource('rule', ['namespace' => '', 'controller' => RuleController::class, 'websafe' => 1]);
});
