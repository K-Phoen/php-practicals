<?php

class AppTest extends TestCase
{
    private $app;

    public function setUp()
    {
        $this->app = new \App($this->createMock('View\TemplateEngineInterface'));
    }

    public function testRender()
    {
        $mock = $this->createMock('View\TemplateEngineInterface');
        $mock
            ->expects($this->once())
            ->method('render')
            ->will($this->returnValue('Heya'));

        $app = new \App($mock);
        $this->assertEquals('Heya', $app->render('a/template.php'));
        $this->assertEquals(200, $this->readStatusCode($app));
    }

    public function testRenderWithStatusCode()
    {
        $mock = $this->createMock('View\TemplateEngineInterface');
        $mock
            ->expects($this->once())
            ->method('render')
            ->will($this->returnValue('Heya'));

        $app = new \App($mock);
        $this->assertEquals('Heya', $app->render('a/template.php', array(), 201));
        $this->assertEquals(201, $this->readStatusCode($app));
    }

    public function testGet()
    {
        $this->assertCount(0, $this->readRoutes($this->app));

        $this->app->get('/foo', function () {});
        $routes = $this->readRoutes($this->app);

        $this->assertCount(1, $routes);
        $this->assertEquals('GET', $routes[0]->getMethod());
        $this->assertEquals('/foo', $routes[0]->getPattern());
    }

    public function testPost()
    {
        $this->assertCount(0, $this->readRoutes($this->app));

        $this->app->post('/foo', function () {});
        $routes = $this->readRoutes($this->app);

        $this->assertCount(1, $routes);
        $this->assertEquals('POST', $routes[0]->getMethod());
        $this->assertEquals('/foo', $routes[0]->getPattern());
    }

    public function testPut()
    {
        $this->assertCount(0, $this->readRoutes($this->app));

        $this->app->put('/foo', function () {});
        $routes = $this->readRoutes($this->app);

        $this->assertCount(1, $routes);
        $this->assertEquals('PUT', $routes[0]->getMethod());
        $this->assertEquals('/foo', $routes[0]->getPattern());
    }

    public function testDelete()
    {
        $this->assertCount(0, $this->readRoutes($this->app));

        $this->app->delete('/foo', function () {});
        $routes = $this->readRoutes($this->app);

        $this->assertCount(1, $routes);
        $this->assertEquals('DELETE', $routes[0]->getMethod());
        $this->assertEquals('/foo', $routes[0]->getPattern());
    }

    /**
     * @expectedException Exception\HttpException
     */
    public function testRun()
    {
        $this->app->run();
    }

    private function readStatusCode($object)
    {
        $reflObj  = new \ReflectionObject($object);
        $reflProp = $reflObj->getProperty('statusCode');
        $reflProp->setAccessible(true);

        return $reflProp->getValue($object);
    }

    private function readRoutes($object)
    {
        $reflObj  = new \ReflectionObject($object);
        $reflProp = $reflObj->getProperty('routes');
        $reflProp->setAccessible(true);

        return $reflProp->getValue($object);
    }
}
