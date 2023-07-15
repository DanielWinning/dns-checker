<?php

use DannyXCII\DnsTool\QueryHandler;

require_once sprintf('%s/vendor/autoload.php', dirname(__DIR__, 1));

$requestUri = $_SERVER['REQUEST_URI'];
$viewsPath = sprintf('%s/views', dirname(__DIR__, 1));

if ($requestUri === '/') {
    require_once sprintf('%s/index.view.html', $viewsPath);
    return;
}

$requestUri = explode('/', $requestUri);

if (!$requestUri[0] == '') {
    echo 'Bad Request';
    return;
}

$queryParts = explode('&', str_replace('?', '', $requestUri[1]));
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