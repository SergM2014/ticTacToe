<?php

declare(strict_types=1);

ini_set('session.gc_maxlifetime', 300);
session_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'vendor/autoload.php';
require_once 'routes.php';
require_once 'viewHelpers.php';

define('DATA_LOGS', __DIR__ . '/logs.txt');
define('NOT_FOUND_ROUTE', [ Src\Actions\NotFound::class, 'report']);