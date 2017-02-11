<?php

/* register autoloader here */
spl_autoload_register(function ($class) {
    $directories = ['/src', '/tests'];
    echo('trying to load: '.$class.'<br/>');
    if (file_exists(__DIR__ .$class.'.php')) {
        require_once __DIR__ .$class.'.php';
        echo 'loaded';
    } else {
        foreach ($directories as $value) {
            if (file_exists(__DIR__ .$value.'/'.str_replace(['\\','_'], '/', $class).'.php')) {
                require_once __DIR__ .$value.'/'.str_replace(['\\','_'], '/', $class).'.php';
                echo 'loaded <br/>';
            } else {
            }
        }
    }
});
