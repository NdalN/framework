<?php

/**
 * Register application autoload function.
 */
spl_autoload_register(function ($classname) {

    $filename = APP . 'modules/'.str_replace('\\', '/', $classname).'.php';

    if (is_readable($filename)) {
        require $filename;
    } else {
        echo "<h1>Want to load $classname.</h1><br/>";
        var_dump($filename, is_readable($filename));
    }
});
