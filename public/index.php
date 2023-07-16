<?php

use WinningSoftware\DNSTool\QueryHandler;
use WinningSoftware\DNSTool\QueryParser;

require_once sprintf('%s/vendor/autoload.php', dirname(__DIR__, 1));

$viewsPath = sprintf('%s/views', dirname(__DIR__, 1));
$requestParser = new QueryParser($_SERVER['REQUEST_URI']);

$requestUri = trim(strip_tags($_SERVER['REQUEST_URI']), '/');

if (empty($requestParser->getUri()) && empty($requestParser->getQueryParams())) {
    require_once sprintf('%s/index.view.html', $viewsPath);
    return;
}

if (!empty($requestParser->getUri())) {
    require_once sprintf('%s/no-access.view.html', $viewsPath);
    return;
}

if (!$requestParser->getQueryParam('domain') || !$requestParser->getQueryParam('provider')) {
    echo 'Request required the domain name and provider arguments';
    return;
}

echo (new QueryHandler())
    ->handleRequest(
        $requestParser->getQueryParam('domain'),
        $requestParser->getQueryParam('provider')
    );