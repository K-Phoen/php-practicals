<?php

namespace View;

use View\TemplateEngine;

class TemplateEngineTest extends \TestCase
{
    public function testRender()
    {
        $engine = new TemplateEngine(__DIR__ . '/../fixtures/templates');
        $result = $engine->render('1.php', array(
            'message' => 'World'
        ));

        $this->assertNotEmpty($result);
        $this->assertEquals("<h1>Hello World</h1>\n", $result);
    }

    public function testRenderWithAbsoluteTemplatePath()
    {
        $engine = new TemplateEngine(__DIR__ . '/../fixtures/templates');
        $result = $engine->render(__DIR__ . '/../fixtures/templates/1.php', array(
            'message' => 'World'
        ));

        $this->assertNotEmpty($result);
        $this->assertEquals("<h1>Hello World</h1>\n", $result);
    }
}
