<?php

use WinningSoftware\DNSTool\QueryHandler;
use WinningSoftware\DNSTool\QueryParser;

require_once sprintf('%s/vendor/autoload.php', dirname(__DIR__, 1));

$viewsPath = sprintf('%s/views', dirname(__DIR__, 1));
$requestParser = new QueryParser($_SERVER['REQUEST_URI']);

$requestUri = trim(strip_tags($_SERVER['REQUEST_URI']), '/');

if (empty($requestUri)) {
    require_once sprintf('%s/index.view.html', $viewsPath);
    return;
}

$queryString = explode('/', $requestUri)[0];

if (!str_starts_with($queryString, '?')) {
    require_once sprintf('%s/no-access.view.html', $viewsPath);
    return;
}

$queryParts = explode('&', str_replace('?', '', $queryString));
$queryParams = [];

foreach ($queryParts as $queryPart) {
    $split = explode('=', $queryPart);

    if (count($split) == 2) {
        $queryParams[$split[0]] = $split[1];
    }
}

if (!isset($queryParams['domain']) || !isset($queryParams['provider'])) {
    return false;
}

echo (new QueryHandler())->handleRequest($queryParams['domain'], $queryParams['provider']);