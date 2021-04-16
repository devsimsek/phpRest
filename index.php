<?php
/**
 * smskWebServices License Authentication Api Endpoint.
 * This software uses a customized part from phpIgniter and Lightr projects.
 * Please serve this software with goServe web server solution. www.goserve.it
 * www.smsk.me/blog/what-is-smsk-api#licensing
 * Copyright smsk Web Services, mtnsmsk, smsk Foundation, Metin Şimşek.
 * 2021 - April
 * Index File
 */
// Settings
// --------------------------------------------------------------------
// Application Environment
// --------------------------------------------------------------------
// smskApi supports enviroment types. For now we only accept testing
// and production.
// Example: $env = "production";
$env = "test";

// --------------------------------------------------------------------
// Core Directory
// --------------------------------------------------------------------
// smskApi has a well built lightweight core which can handle connections
// and most of the functions. Please set this variable correctly.
// Note: NO TRAILING SLASH!
// Example: $core = "core";
$core = "core";

// --------------------------------------------------------------------
// App Directory
// --------------------------------------------------------------------
// smskApi have mvc structured application system which can handle views
// custom helpers and libraries. it is like a little framework of yours!
// Note: NO TRAILING SLASH!
// Example: $app = "";
$app = "";

// --------------------------------------------------------------------
// Routes Directory
// --------------------------------------------------------------------
// smskApi have mvc structured routing system which can handle most of the
// request types such as post, put and delete.
// You need to set your routes directory correctly to avoid errors.
// Note: NO TRAILING SLASH!
// Example: $routes = "routes";
$routes = "routes";

// --------------------------------------------------------------------
// Custom Helpers
// --------------------------------------------------------------------
// smskApi is supporting helpers.
// By automatically system searches all helpers in app/helpers directory.
// Example: $helpers = array("custom");
$helpers = array();

// --------------------------------------------------------------------
// Custom Libraries
// --------------------------------------------------------------------
// smskApi is supporting mvc based libraries.
// By automatically system searches all libraries in app/library directory.
// Example: $libraries = array("Custom");
$libraries = array();


// --------------------------------------------------------------------
// Routing Schema
// --------------------------------------------------------------------
// smskApi requires schema to route requests. It is a simple json array.
// Example: $routing = array(
//      array(
//          "path" => "version", // path that url will visit. for index use "".
//          "handler" => "version", // Handler file in app/routes directory.
//          "variables" => null // Variables that you can pass to handler file.
//      )
//  )
$routing = array(
    array(
        "path" => "", // This means / route.
        "handler" => "index", // Required! this must be filled
        "variables" => null, // Accepts array, object or null
    ),
    array(
        "path" => "version",
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
define("API_VER", "v1.2");
define("HELPERS", $helpers); // todo: assign this defined array to simple variable.
define("LIBRARIES", $libraries); // todo: assign this defined array to simple variable.
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

// Lets do the same thing on routes directory.
$routes = $app . $routes . "/";
if (file_exists($routes)) {
    if (is_dir($routes)) {
        define("ROUTE_DIR", $routes);
    } else {
        die("FATAL ERROR! <br> Routes " . $routes . " is not an directory!");
    }
} else {
    die("FATAL ERROR! <br> Routes " . $routes . " directory does not exists!");
}

// And here we go!
require_once CORE_DIR . "smskAPI.php";