<?php

$app['index.controller'] = function() use ($app) {
    return new MatiashApp\Controller\IndexController();
};
$app['geolocation.controller'] = function() use ($app) {
    return new MatiashApp\Controller\GeoLocationController(
        $app['data-fetcher.service']
    );
};