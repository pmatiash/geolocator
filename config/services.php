<?php

$app['api.client.service'] = function() use ($app) {
    return new MatiashApp\Service\Api\Client($app->getConfig());
};
$app['model.factory'] = function() use ($app) {
    return new MatiashApp\Factory\ModelFactory($app);
};
$app['ip-format-converter.service'] = function() use ($app) {
    return new MatiashApp\Service\IpFormatConverter();
};
$app['visitor.saver.service'] = function() use ($app) {
    return new MatiashApp\Service\VisitorSaver($app['ip-format-converter.service']);
};
$app['data-fetcher.service'] = function() use ($app) {
    return new MatiashApp\Service\DataFetcher(
        $app['api.client.service'],
        $app['model.factory'],
        $app['ip-format-converter.service'],
        $app['visitor.saver.service']
    );
};

