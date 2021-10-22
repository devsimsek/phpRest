<?php
defined('BASE_DIR') or exit('Sorry. No direct access allowed here!');

// Checking helper and library existence
defined("LIBRARIES") or die("Error: Libraries Are Not Settled Correctly.");
defined("HELPERS") or die("Error: Helpers Are Not Settled Correctly.");

include_once CORE_DIR . "Functions.php"; // Include functions at the top of the application.

// Lets read route data and route for it.
global $router;
load_file("configuration/routing");

load_class("Model", "library");
load_class("Loader", "library");
load_class("Controller", "library");

// And Away We Go!
$router->ignite();

// This is it! you can develop your api's
// using loader class to add helpers, libraries and more!