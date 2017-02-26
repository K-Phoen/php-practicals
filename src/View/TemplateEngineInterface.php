<?php

namespace View;

interface TemplateEngineInterface
{
    public function render($template, array $parameters = array());
}
