<?php

namespace Exception;

use View\TemplateEngineInterface;

class ExceptionHandler
{
    /**
     * @var TemplateEngineInterface
     */
    private $templateEngine;

    /**
     * @var boolean
     */
    private $debug;

    public function __construct(TemplateEngineInterface $templateEngine, $debug = false)
    {
        $this->templateEngine = $templateEngine;
        $this->debug          = $debug;
    }

    /**
     * @param Exception $exception
     */
    public function handle(\Exception $exception)
    {
        if ($exception instanceof HttpException) {
            http_response_code($exception->getStatusCode());
        }

        if (false === $this->debug) {
            return;
        }

        if (null !== $exception->getPrevious()) {
            $exception = $exception->getPrevious();
        }

        $message = $exception->getMessage();
        $trace   = $exception->getTrace();

        array_unshift($trace, array(
            'function' => '',
            'file'     => $exception->getFile() != null ? $exception->getFile() : null,
            'line'     => $exception->getLine() != null ? $exception->getLine() : null,
            'args'     => array(),
        ));

        $firstTrace = array_shift($trace);
        $firstTrace['excerpt'] = $this->excerpt($firstTrace['file'], $firstTrace['line']);

        array_unshift($trace, $firstTrace);

        echo $this->templateEngine->render(__DIR__ . '/templates/exception.php', array(
            'message' => $message,
            'trace'   => $trace,
        ));
    }

    private function excerpt($file, $line)
    {
        if (is_readable($file)) {
            $content = preg_split('#<br />#', preg_replace('/^<code>(.*)<\/code>$/s', '$1', highlight_file($file, true)));

            $lines = array();
            for ($i = max($line - 3, 1), $max = min($line + 3, count($content)); $i <= $max; $i++) {
                $lines[] = '<li'.($i == $line ? ' class="selected"' : '').'>'.$content[$i - 1].'</li>';
            }

            return '<ol class="excerpt" start="'.max($line - 3, 1).'">'.implode("\n", $lines).'</ol>';
        }
    }
}
