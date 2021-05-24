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

$router = new Router();
foreach ($routing as $route) {

    if (empty($route["method"])) {
        $route["method"] = "get";
    }

    // Adding Routes To Router Class
    $router->add($route["path"], function () use ($route, $router) {

        load_class("Loader", "library");
        load_class("Response", "library");

        // Creating Super Loader
        $super = new stdClass();
        $super->super = new stdClass();
        $super->super->response = new Response();

        if (is_array(LIBRARIES)) {
            foreach (LIBRARIES as $lib) {
                if (!is_array($lib)) {
                    if (strlen($lib) > 0) {
                        $router->load->library($lib);
                        $lib_register = new ReflectionClass($lib);
                        $register = $lib_register->newInstanceWithoutConstructor();
                        if ($register->register()["require_arguments"]) {
                            $router->load->library($lib);
                        } else {
                            $super->super->$lib = new $lib();
                        }
                    }
                } else {
                    if (isset($lib["file"]) && isset($lib["dir"])) {
                        $router->load->library($lib["file"], $lib["dir"]);
                        $super->super->$lib = new $lib["file"]();
                    }
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
            $router->load->route($route["handler"], array(
                $super,
                $route["variables"]
            ));
        } else {
            $router->load->route($route["handler"], $super);
        }

    }, $route["method"]);
}
// And Away We Go!
$router->ignite();

// This is it! you can develop your api's
// using loader class to add helpers, libraries and more!