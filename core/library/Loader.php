<?php

class Loader
{

    public function route(string $file, $variables = array())
    {

        if (file_exists(HANDLERS_DIR . $file . ".php")) {
            if (!is_array($variables)) {
                $variables = get_object_vars($variables);
            }
            extract($variables);
            include HANDLERS_DIR . $file . ".php";
        } else if (file_exists(HANDLERS_DIR . $file . "_r.php")) {
            include HANDLERS_DIR . $file . "_r.php";
        } else {
            die("Error: The route " . $file . " does not exists in " . HANDLERS_DIR . " directory.");
        }
    }

    public function helper(string $file)
    {
        if (include APP_DIR . "helpers/" . $file . ".php") {
            return include APP_DIR . "helpers/" . $file . ".php";
        } else if (include APP_DIR . "helpers/" . $file . "_h.php") {
            return include APP_DIR . "helpers/" . $file . "_h.php";
        } else {
            die("Error: The helper " . $file . " does not exists in " . APP_DIR . "helpers/" . " directory.");
        }
        return null;
    }

    public function library(string $file, string $dir = null)
    {

        if ($dir == null) {
            if (include APP_DIR . "library/" . $file . ".php") {
                return include APP_DIR . "library/" . $file . ".php";
            } else if (include APP_DIR . "library/" . $file . "_lib.php") {
                return include APP_DIR . "library/" . $file . "_lib.php";
            } else {
                die("Error: The library " . $file . " does not exists in " . APP_DIR . "library/" . " directory.");
            }
        } else {
            if (include APP_DIR . "library/" . $dir . "/" . $file . ".php") {
                return include APP_DIR . "library/" . $dir . "/" . $file . ".php";
            } else {
                die("Error: The library " . $file . " does not exists in " . APP_DIR . "library/" . " directory.");
            }
        }
        return null;
    }

    public function view(string $file, $variables = array())
    {

        if (file_exists(HANDLERS_DIR . $file . ".php")) {
            if (!is_array($variables)) {
                $variables = get_object_vars($variables);
            }
            extract($variables);
            include HANDLERS_DIR . $file . ".php";
        } else if (file_exists(HANDLERS_DIR . $file . "_v.php")) {
            include HANDLERS_DIR . $file . "_v.php";
        } else {
            die("Error: The view " . $file . " does not exists in " . HANDLERS_DIR . " directory.");
        }
    }


    /*
    public function load(string $file, $variables = array())
    {
        if (file_exists($file)) {
            extract($variables);
            include $file . ".php";
        }
    }

    public function route(string $file, $variables = array())
    {
        if (file_exists(BASE_DIR . "/routes/" . $file . "_route.php")) {

            if (!is_array($variables)) {
                $variables = get_object_vars($variables);
            }

            extract($variables);
            include BASE_DIR . "/routes/" . $file . "_route.php";
        }
    }

    public function view(string $file, $variables = array())
    {
        if (file_exists(BASE_DIR . "/views/" . $file . "_view.php")) {
            extract($variables);
            include BASE_DIR . "/views/" . $file . "_view.php";
        }
    }

    public function helper(string $file)
    {
        if (file_exists(BASE_DIR . "/helpers/" . $file . "_helper.php")) {
            include BASE_DIR . "/helpers/" . $file . "_helper.php";
        }
    }

    public function library(string $library)
    {
        if (file_exists(BASE_DIR . "/library/" . $library . ".php")) {
            include BASE_DIR . "/library/" . $library . ".php";
        }
        if (file_exists(BASE_DIR . "/library/" . $library . "_lib.php")) {
            include BASE_DIR . "/library/" . $library . "_lib.php";
        }
    }
    */
}