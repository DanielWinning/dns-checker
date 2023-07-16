<?php

namespace WinningSoftware\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WinningSoftware\DNSTool\QueryParser;

class QueryParserTest extends TestCase
{
    /**
     * @param array $expected
     * @param string $uri
     *
     * @return void
     */
    #[Test]
    #[DataProvider('requestUriParameterProvider')]
    public function testItParsesQueryParametersCorrectly(array $expected, string $uri): void
    {
        $testClass = new QueryParser($uri);

        self::assertEquals($expected, $testClass->getQueryParams());
    }

    /**
     * @return array[]
     */
    public static function requestUriParameterProvider(): array
    {
        return [
            [
                'expected' => [
                    'hello' => 'world',
                ],
                'uri' => '/?hello=world',
            ],
            [
                'expected' => [
                    'hello' => 'world',
                    'name' => 'test',
                ],
                'uri' => '/testing/?hello=world&name=test/',
            ],
        ];
    }
}