<?php
defined('BASE_DIR') or exit('Sorry. No direct access allowed here!');

// Checking helper and library existence
defined("LIBRARIES") or die("Error: Libraries Are Not Settled Correctly.");
defined("HELPERS") or die("Error: Helpers Are Not Settled Correctly.");

include_once CORE_DIR . "Functions.php"; // Include functions at the top of the application.
// Load Loader Class And Begin To Read Routes.
//load_class("Loader", "library");
load_class("Router", "library");

// Lets read route data and route for it.
// Is routing filled correctly?
isset($routing) or die("Error! You Need To Fill Routing");

$router = new Router($_SERVER);
foreach ($routing as $route) {
    $router->addRoute($route["path"], function () use ($route, $router) {
        if (is_array(LIBRARIES)) {
            foreach (LIBRARIES as $lib) {
                if (strlen($lib) > 0) {
                    $router->load->library($lib);
                }
            }
        }
        if (is_array(HELPERS)) {
            foreach (HELPERS as $helper) {
                if (strlen($helper) > 0) {
                    $router->load->helper($helper);
                }
            }
        }

        if (!empty($route["variables"])) {
            $router->load->route($route["handler"], $route["variables"]);
        } else {
            $router->load->route($route["handler"]);
        }

    });
}
// And Away We Go!
$router->ignite();

// This is it! you can develop your api's
// using loader class to add helpers, libraries and more!