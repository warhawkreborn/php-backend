<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get("/server/", \Controllers\ServerInfoController::class.':list');
$app->get("/server", \Controllers\ServerInfoController::class.':list');
$app->post("/server/", \Controllers\ServerInfoController::class.':addHost');
$app->post("/server", \Controllers\ServerInfoController::class.':addHost');
$app->get("/client/getExternalIP", \Controllers\ClientController::class.':getExternalIP');
$app->get("/server/checkForwarding", \Controllers\ServerInfoController::class.':checkForwarding');
$app->get("/app/versionInfo", \Controllers\AppController::class.':versionInfo');
$app->get("/app/news", \Controllers\AppController::class.':getNews');
