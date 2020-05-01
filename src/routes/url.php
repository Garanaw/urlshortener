<?php

use Illuminate\Routing\Router;

$router = app(Router::class);

$router->get('all', 'AllAction')->name('url-list');
$router->get('home', 'ListAction')->name('home');
$router->post('url', 'StoreAction')->name('url.store');
$router->get('url/{url:keyword}', 'RedirectAction')->name('url.show');
