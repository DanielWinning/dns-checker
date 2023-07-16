<?php

namespace WinningSoftware\DNSTool;

class QueryParser
{
    private string $uri;
    private array $queryParams = [];

    public function __construct(string $requestUri)
    {
        $splitPath = explode('?', trim(strip_tags($requestUri), '/'));
        $this->uri = $splitPath[0];

        if (isset($splitPath[1])) {
            $this->setQueryParams($splitPath[1]);
        }
    }

    private function setQueryParams(string $queryString): void
    {
        $splitQueries = explode('&', $queryString);

        foreach($splitQueries as $query) {
            $this->queryParams[explode('=', $query)[0]] = explode('=', $query)[1];
        }
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getQueryParam(string $name): ?string
    {
        return $this->queryParams[$name] ?? null;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }
}