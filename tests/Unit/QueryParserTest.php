<?php

namespace WinningSoftware\Tests\Unit;

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
    public function testItParsesQueryParameters(array $expected, string $uri): void
    {
        $testClass = new QueryParser($uri);

        self::assertEquals($expected, $testClass->getQueryParams());
    }

    /**
     * @param string $expected
     * @param string $uri
     *
     * @return void
     */
    #[Test]
    #[DataProvider('requestUriProvider')]
    public function testItParsesRequestUri(string $expected, string $uri): void
    {
        $testClass = new QueryParser($uri);

        self::assertEquals($expected, $testClass->getUri());
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

    /**
     * @return array[]
     */
    public static function requestUriProvider(): array
    {
        return [
            [
                'expected' => '',
                'uri' => '/',
            ],
            [
                'expected' => 'hello/world',
                'uri' => '/hello/world?name=test',
            ],
            [
                'expected' => 'hello/world',
                'uri' => '/hello/world?name=test/',
            ],
            [
                'expected' => '',
                'uri' => '/?name=test',
            ],
            [
                'expected' => '',
                'uri' => '?name=test',
            ],
        ];
    }
}