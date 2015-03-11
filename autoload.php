<?php
/*
 * Copyright 2015 anyTV Limited
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may no use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
*/

function freedom_api_php_client_autoload($className) {
    $classPath = explode('-', $className);
    if ($classPath[0] != 'AnyTV') {
        return;
    }
    if (count($classPath) > 3) {
        // Max class file path depth in this project is 3.
        $classPath = array_slice($classPath, 0, 3);
    }
    $filePath = dirname(__FILE__) . '/src/' . implode('/', $classPath) . '.php';
    if (file_exists($filePath)) {
        require_once($filePath);
    }
}

spl_autoload_register('freedom_api_php_client_autoload');
