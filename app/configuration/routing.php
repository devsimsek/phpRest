<?php
global $router;
load_class("Router", "library");
$router = new Router();

// --------------------------------------------------------------------
// Routing Schema
// --------------------------------------------------------------------
// phpRest requires schema to route requests. It is a simple function or controller.
// Example: $router->add("/", "home&index", "get");
//                        |    |             |-> (optional, default get) The request type of the route.
//                        |    |-> The controller file and function
//                        |-> The request path to awake route
// Example 2: $router->add("/", function () {echo 'hi!';}, "get");
//                         |    |                            |-> (optional, default get) The request type of the route.
//                         |    |-> The function that router will call
//                         |-> The request path to awake route
$router->add("/", "home&index");
$router->add("/version", "version&index");