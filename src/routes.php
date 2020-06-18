<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use NixEnterprise\GrafanaDatasource\Http\Middleware\AuthMiddleware;
use NixEnterprise\GrafanaDatasource\Http\Middleware\CorsMiddleware;

Route::namespace('NixEnterprise\GrafanaDatasource\Http\Controllers')
    ->prefix('grafana')
    ->middleware([AuthMiddleware::class, CorsMiddleware::class])
    ->group(function(Router $router) {

        $router->get('/', [
            'as' => 'grafana.handshake',
            'uses' => 'GrafanaController@index'
        ]);

        $router->post('/search', [
            'as' => 'grafana.search',
            'uses' => 'GrafanaController@search'
        ]);

        $router->post('/query', [
            'as' => 'grafana.query',
            'uses' => 'GrafanaController@query'
        ]);

        $router->post('/annotations', [
            'as' => 'grafana.annotations',
            'uses' => 'GrafanaController@annotations'
        ]);
    });
