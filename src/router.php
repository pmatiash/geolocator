<?php

$app->get('/', "index.controller:getAction");
$app->post('/geolocation', "geolocation.controller:postAction");