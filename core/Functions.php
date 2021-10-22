<?php
defined('BASE_DIR') or exit('Sorry. No direct access allowed here!');

if (!function_exists("load_class")) {
    function load_class($class, $directory = CORE_DIR)
    {
        if (substr($directory, -1) === "/") {
            $path = $directory;
        } else {
            $path = $directory . "/";
        }
        if (file_exists($path . $class . ".php")) {
            require $path . $class . ".php";
        } else if (CORE_DIR . $path . $class . ".php") {
            require $path . $class . ".php";
        } else {
            print_r($path . $class . ".php");
            die("Error: Cannot Load " . $class . " class.");
        }
    }
}

if (!function_exists("load_file")) {
    function load_file($filename, $directory = APP_DIR)
    {
        if (substr($directory, -1) === "/") {
            $path = $directory;
        } else {
            $path = $directory . "/";
        }
        if (file_exists($path . $filename . ".php")) {
            require $path . $filename . ".php";
        } else if (CORE_DIR . $path . $filename . ".php") {
            require $path . $filename . ".php";
        } else {
            print_r($path . $filename . ".php");
            die("Error: Cannot Load " . $filename . " File.");
        }
    }
}