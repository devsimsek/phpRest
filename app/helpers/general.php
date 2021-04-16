<?php
/**
 * Returns http status code.
 * @param $code
 * @return string
 */
if (!function_exists("http_status")) {
    function http_status($code)
    {
        $http_codes = [
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',
            103 => 'Checkpoint',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-Status',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => 'Switch Proxy',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            418 => 'Im a teapot',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            425 => 'Unordered Collection',
            426 => 'Upgrade Required',
            449 => 'Retry With',
            450 => 'Blocked by Windows Parental Controls',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates',
            507 => 'Insufficient Storage',
            509 => 'Bandwidth Limit Exceeded',
            510 => 'Not Extended'
        ];

        return $http_codes[$code] ? $http_codes[$code] : $http_codes[500];
    }
}

if (!function_exists("set_header")) {
    /**
     * Set Header
     * @param $code
     */
    function set_header($code)
    {
        header('HTTP/1.1 ' . $code . ' ' . http_status($code));
        header('Content-Type: application/json; charset=utf-8');
    }
}

if (!function_exists("allowPost")) {
    /**
     * Accepts Only Post Request
     */
    function allowPost()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo "This Request Only Allows Post";
            exit;
        }
    }
}

if (!function_exists("allowGet")) {
    /**
     * Accepts Only Get Request
     */
    function allowGet()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            echo "This Request Only Allows Get";
            exit;
        }
    }
}

if (!function_exists("allowPut")) {
    /**
     * Accepts Only Put Request
     */
    function allowPut()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'PUT') {
            echo "This Request Only Allows Put";
            exit;
        }
    }
}

if (!function_exists("allowDelete")) {
    /**
     * Accepts Only Delete Request
     */
    function allowDelete()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'DELETE') {
            echo "This Request Only Allows Delete";
            exit;
        }
    }
}

if (!function_exists("getPost")) {
    /**
     * Returns Post Value
     * @param $field
     * @return mixed
     */
    function getPost($field)
    {
        if (!isset($_POST[$field])) {
            echo "Required Field " . $field . " Not Filled. Killing Connection.";
            exit();
        }

        return $_POST[$field];
    }
}

if (!function_exists("getPut")) {
    /**
     * Returns Put Value
     * @param $field
     * @return mixed
     */
    function getPut($field)
    {
        parse_str(file_get_contents("php://input"), $rtn);

        if (!isset($rtn[$field])) {
            echo "Required Field " . $field . " Not Filled. Killing Connection.";
            exit();
        }
        return $rtn[$field];
    }
}

if (!function_exists("getGet")) {
    /**
     * Returns Get Value
     * @param $field
     * @return mixed
     */
    function getGet($field)
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