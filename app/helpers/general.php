<?php
if (!function_exists("getField")) {
    /**
     * Returns Get Value
     * @param $field
     * @return mixed
     */
    function getField($field)
    {
        if (!isset($_GET[$field])) {
            echo "Required Field " . $field . " Not Filled. Killing Connection.";
            exit();
        }

        return $_GET[$field];
    }
}

if (!function_exists("require_auth")) {
    /**
     * Allows Only Basic Authentication
     */
    function require_auth()
    {
        $AUTH_USER = 'example';
        $AUTH_PASS = 'example';
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
        $is_not_authenticated = (
            !$has_supplied_credentials ||
            $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
            $_SERVER['PHP_AUTH_PW'] != $AUTH_PASS
        );
        if ($is_not_authenticated) {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access denied"');
            exit;
        }
    }
}