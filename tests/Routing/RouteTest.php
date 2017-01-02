<?php

namespace Routing;

class RouteTest extends \TestCase
{
    /**
     * @dataProvider dataProviderForMatch
     */
    public function testMatch($method, $pattern, $givenMethod, $givenUri, $expectedReturn, $expectedArguments = array())
    {
        $route = new Route($method, $pattern, function () {});

        $this->assertEquals($expectedReturn, $route->match($givenMethod, $givenUri));
        $this->assertCount(count($expectedArguments), $route->getArguments());
        $this->assertEquals($expectedArguments, $route->getArguments());
    }

    public static function dataProviderForMatch()
    {
        return array(
            array('GET', '/', 'GET', '/', true),
            array('GET', '/', 'POST', '/', false),
            array('GET', '/(\d+)', 'GET', '/10', true, array(10)),
            array('GET', '/locations', 'GET', '/locations', true),
            array('GET', '/locations/(\d+)', 'GET', '/locations', false),
            array('GET', '/locations/(\d+)', 'GET', '/locations/abc', false),
            array('GET', '/locations/(\d+)', 'GET', '/locations/10', true, array(10)),
            array('GET', '/locations/(\d+)/foo/(\w+)', 'GET', '/locations/10/foo', false),
            array('GET', '/locations/(\d+)/foo/(\w+)', 'GET', '/locations/10/foo/abc', true, array(10, 'abc')),
            array('GET', '/locations/(\d+)/foo/(\w+)', 'GET', '/locations/10/foo/123', true, array(10, 123)),
        );
    }
}
