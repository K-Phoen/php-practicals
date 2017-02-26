<?php

namespace View;

class TemplateEngine implements TemplateEngineInterface
{
    /**
     * @var string
     */
    private $templateDir;

    public function __construct($templateDir)
    {
        $this->templateDir = $templateDir;
    }

    /**
     * {@inheritDoc}
     */
    public function render($template, array $parameters = array())
    {
        extract($parameters);

        if (false === $this->isAbsolutePath($template)) {
            $template = $this->templateDir . DIRECTORY_SEPARATOR . $template;
        }

        ob_start();
        include $template;

        return ob_get_clean();
    }

    private function isAbsolutePath($file)
    {
        if (strspn($file, '/\\', 0, 1)
            || (strlen($file) > 3 && ctype_alpha($file[0])
            && substr($file, 1, 1) === ':'
            && (strspn($file, '/\\', 2, 1))
        )
        || null !== parse_url($file, PHP_URL_SCHEME)
        ) {
            return true;
        }

        return false;
    }
}
