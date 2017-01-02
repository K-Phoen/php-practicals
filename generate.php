<?php
include 'vendor/autoload_cache.php';

$template = <<<EOF
<?php
namespace %namespace%;

class generate
{
    public function __construct(\$log = true)
    {
        if (\$log) {
            echo "%namespace%\\%classname%\\n";
        }
    }
}
EOF;

foreach ($autoload_map as $key => $file) {
    $vars = array(
        '%namespace%' => str_replace('/', '\\', dirname($file)),
        '%classname%' => array_pop(explode('\\', $key)),
    );

    $content = strtr($template, $vars);

    $filename = __DIR__.'/vendor/'.$file;
    echo $filename;
    file_put_contents($filename, $content);
}
