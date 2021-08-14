<?php

class Loader
{

    public function load_helper(string $file)
    {
        if (include APP_DIR . "helpers/" . $file . ".php") {
            return include APP_DIR . "helpers/" . $file . ".php";
        } else if (include APP_DIR . "helpers/" . $file . "_h.php") {
            return include APP_DIR . "helpers/" . $file . "_h.php";
        } else {
            die("Error: The helper " . $file . " does not exists in " . APP_DIR . "helpers/" . " directory.");
        }
    }

    public function load_library(string $file, string $dir = null)
    {
        if ($dir == null) {
            if (file_exists(APP_DIR . "libraries/" . $file . ".php")) {
                return include APP_DIR . "libraries/" . $file . ".php";
            } else if (file_exists(APP_DIR . "libraries/" . $file . "_lib.php")) {
                return include APP_DIR . "libraries/" . $file . "_lib.php";
            } else {
                die("Error: The libraries " . $file . " does not exists in " . APP_DIR . "libraries/" . " directory.");
            }
        } else {
            if (file_exists(APP_DIR . "libraries/" . $dir . "/" . $file . ".php")) {
                return include APP_DIR . "libraries/" . $dir . "/" . $file . ".php";
            } else {
                die("Error: The libraries " . $file . " does not exists in " . APP_DIR . "libraries/" . " directory.");
            }
        }
    }

    public function load_model(string $file, $variables = array())
    {

        if (file_exists(MODELS . $file . ".php")) {
            if (!is_array($variables)) {
                $variables = get_object_vars($variables);
            }
            extract($variables);
            require MODELS . $file . ".php";
            return true;
        } else if (file_exists(MODELS . $file . "_m.php")) {
            require MODELS . $file . "_m.php";
            return true;
        }
        return new $file();
    }
}
