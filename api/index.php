<?php

// Initialize autoloader
require __DIR__ . '/../vendor/autoload.php';

// Handle request
$app = require_once __DIR__ . '/../bootstrap/app.php';
$request = Illuminate\Http\Request::capture();

// Pass request to the application
$app->run($request);
