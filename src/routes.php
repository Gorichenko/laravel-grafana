<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::namespace('NixEnterprise\GrafanaDatasource')
    ->prefix('grafana')
    ->group(function (Router $router) {

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
