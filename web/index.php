<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';
require __DIR__.'/../src/router.php';
require __DIR__.'/../config/controllers.php';
require __DIR__.'/../config/services.php';

$app->run();