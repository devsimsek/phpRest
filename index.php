<?php
/**
 * smskSoft Restful Api Development Framework.
 * This software uses a customized part from phpIgniter and Lightr projects.
 * Please serve this software with phpRestCLI
 * https://makale.me/phpRest-nedir
 * Copyright smskSoft, mtnsmsk, devsimsek, Metin Şimşek.
 * @package        phpRest
 * @file        index
 * @version     v1.5.2
 * @author        devsimsek
 * @copyright    Copyright (c) 2021, smskSoft, mtnsmsk
 * @license        https://opensource.org/licenses/MIT	MIT License
 * @link        https://devsimsek.github.io/phpRest
 * @since        Version 1.0
 * @filesource
 */
// Settings
// --------------------------------------------------------------------
// Application Environment
// --------------------------------------------------------------------
// phpRest supports environment types. For now we only accept testing
// and production.
// Example: $env = "production";
$env = "test";

// --------------------------------------------------------------------
// Core Directory
// --------------------------------------------------------------------
// phpRest has a well built lightweight core which can handle connections
// and most of the functions. Please set this variable correctly.
// Note: NO TRAILING SLASH!
// Example: $core = "core";
$core = "core";

// --------------------------------------------------------------------
// App Directory
// --------------------------------------------------------------------
// phpRest have mvc structured application system which can handle views
// custom helpers and libraries. it is like a little framework of yours!
// Note: NO TRAILING SLASH!
// Example: $app = "";
$app = "";

// --------------------------------------------------------------------
// Handlers Directory
// --------------------------------------------------------------------
// phpRest have mvc structured routing system which can handle most of the
// request types such as post, put and delete.
// You need to set your handlers directory correctly to avoid errors.
// Note: NO TRAILING SLASH!
// Example: $handlers = "handlers";
$handlers = "handlers";

// --------------------------------------------------------------------
// Custom Helpers
// --------------------------------------------------------------------
// phpRest is supporting helpers.
// By automatically system searches all helpers in app/helpers directory.
// Example: $helpers = array("custom");
$helpers = array();

// --------------------------------------------------------------------
// Custom Libraries
// --------------------------------------------------------------------
// phpRest is supporting mvc based libraries.
// By automatically system searches all libraries in app/library directory.
// Example: $libraries = array("Custom");
$libraries = array();


// --------------------------------------------------------------------
// Routing Schema
// --------------------------------------------------------------------
// phpRest requires schema to route requests. It is a simple json array.
// Example: $routing = array(
//      array(
//          "path" => "version", // path that url will visit. for index use "".
//          "handler" => "version", // Handler file in app/handlers directory.
//          "method" => "post", // Request Will Be Only Accepted With This Field.
//          "variables" => null // Variables that you can pass to handler file.
//      )
//  )
$routing = array(
    array(
        "path" => "/",
        "handler" => "index",
        "variables" => null
    ),
    array(
        "path" => "/version",
        "handler" => "version",
        "variables" => null
    )
);

// End of the user specified settings. please do not touch unless you
// know what are you doing.
// --------------------------------------------------------------------
//                        DO NOT TOUCH BELLOW                        //
// --------------------------------------------------------------------
define("BASE_DIR", getcwd()); // Get the base directory.
define("PR_VER", "v1.5.2");
define("HELPERS", $helpers);
define("LIBRARIES", $libraries);
// First things first lets check our environment option then we create
// an instance for it.

switch ($env) {
    case "test":
        // Lets define our env first.
        define("ENV", $env);
        // Now we start some logging errors.
        error_reporting(-1);
        break;
    case "production":
        // Same thing without all errors!
        define("ENV", $env);
        // Run the api endpoint without error logging.
        error_reporting(0);
        break;
    default:
        define("ENV", $env);
        // In default we always report our errors.
        error_reporting(-1);
        break;
}

// Lets check our directories existence

// First we check core directory to include.
$core = $core . "/"; // Appending trailing slash.
if (file_exists($core)) {
    // Now we check the is core a directory. if not we trigger an error.
    if (is_dir($core)) {
        // Finally define core directory.
        define("CORE_DIR", $core);
    } else {
        die("FATAL ERROR! <br> Core " . $core . " is not an directory!");
    }
} else {
    die("FATAL ERROR! <br> Core " . $core . " directory does not exists!");
}

if ($app === "") {
    $app = "app";
}
// Lets do the same thing on app directory.
$app = $app . "/";
if (file_exists($app)) {
    if (is_dir($app)) {
        define("APP_DIR", $app);
    } else {
        die("FATAL ERROR! <br> Application " . $app . " is not an directory!");
    }
} else {
    die("FATAL ERROR! <br> Application " . $app . " directory does not exists!");
}

// Lets do the same thing on handlers directory.
$handlers = $app . $handlers . "/";
if (file_exists($handlers)) {
    if (is_dir($handlers)) {
        define("HANDLERS_DIR", $handlers);
    } else {
        die("FATAL ERROR! <br> Handler " . $handlers . " is not an directory!");
    }
} else {
    die("FATAL ERROR! <br> Handler " . $handlers . " directory does not exists!");
}

// And here we go!
require_once CORE_DIR . "phpRest.php";