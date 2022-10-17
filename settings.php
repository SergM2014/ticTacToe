<?php

declare(strict_types=1);

session_start();

require_once 'vendor/autoload.php';
require_once 'routes.php';
require_once 'viewHelpers.php';

define('DATA_LOGS', __DIR__ . '/logs.txt');
define('NOT_FOUND_ROUTE', [ Src\Actions\NotFound::class, 'report']);