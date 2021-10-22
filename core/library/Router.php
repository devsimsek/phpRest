<?php
defined('BASE_DIR') or exit('Sorry. No direct access allowed here!');

class Router
{

    /**
     * Loader object to use.
     * @var
     */
    public $load;

    /**
     * The $routes array will contain our URI's and callbacks.
     * @var array
     */
    private static $routes = array();

    /**
     * The variable to store if the path found or not.
     */
    private static $pathNotFound = null;

    /**
     * The variable to store if the method is not allowed or not.
     */
    private static $methodNotAllowed = null;

    /**
     * @param $expression
     * @param $function
     * @param string $method
     */
    public static function add($expression, $function, $method = 'get')
    {
        $patterns = [
            '{url}' => '([0-9a-zA-Z]+)',
            '{id}' => '([0-9]+)',
            '{all}' => '(.*)'
        ];

        $expression = str_replace(array_keys($patterns), array_values($patterns), $expression);
        array_push(self::$routes, array(
            'expression' => $expression,
            'function' => $function,
            'method' => $method
        ));
    }

    /**
     * @param $function
     */
    public static function pathNotFound($function)
    {
        self::$pathNotFound = $function;
    }

    /**
     * @param $function
     */
    public static function methodNotAllowed($function)
    {
        self::$methodNotAllowed = $function;
    }

    /**
     * Start Routing Process
     * @param string $basepath
     */
    public static function ignite($basepath = '/')
    {

        // Parse current url
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);//Parse Uri

        if (isset($parsed_url['path'])) {
            $path = $parsed_url['path'];
        } else {
            $path = '/';
        }

        // Get current request method
        $method = $_SERVER['REQUEST_METHOD'];

        $path_match_found = false;

        $route_match_found = false;

        foreach (self::$routes as $route) {

            // If the method matches check the path

            // Add basepath to matching string
            if ($basepath != '' && $basepath != '/') {
                $route['expression'] = '(' . $basepath . ')' . $route['expression'];
            }

            // Add 'find string start' automatically
            $route['expression'] = '^' . $route['expression'];

            // Add 'find string end' automatically
            $route['expression'] = $route['expression'] . '$';

            // Check path match
            if (preg_match('#' . $route['expression'] . '#', $path, $matches)) {

                $path_match_found = true;

                // Check method match
                if (strtolower($method) == strtolower($route['method'])) {

                    array_shift($matches);// Always remove first element. This contains the whole string

                    if ($basepath != '' && $basepath != '/') {
                        array_shift($matches);// Remove basepath
                    }
                    if (is_callable($route['function'])) {
                        call_user_func_array($route['function'], $matches);
                    } else {
                        $controller = explode('&', $route['function']);
                        $classPath = explode('/', $controller[0]);
                        $className = end($classPath);

                        $controllerFile = array_pop($classPath);
                        $controllerPath = implode("", $classPath);
                        $controllerFile = APP_DIR . 'controllers' . DIRECTORY_SEPARATOR . $controllerPath . DIRECTORY_SEPARATOR . ucfirst($controllerFile);

                        if (file_exists($controllerFile . '.php')) {
                            $controllerFile = $controllerFile . '.php';
                        } else {
                            die("Error, Can't Find $controllerFile Controller");
                        }
                        if (file_exists($controllerFile)) {
                            require $controllerFile;
                            call_user_func_array([new $className, $controller[1]], $matches);
                        } else {
                            die("Error, Can't Find $controllerFile Controller");
                        }
                    }

                    $route_match_found = true;

                    // Do not check other routes
                    break;
                }
            }
        }

        // No matching route was found
        if (!$route_match_found) {

            // But a matching path exists
            if ($path_match_found) {
                header("HTTP/1.0 405 Method Not Allowed");
                if (self::$methodNotAllowed) {
                    call_user_func_array(self::$methodNotAllowed, array($path, $method));
                }
            } else {
                header("HTTP/1.0 404 Not Found");
                if (self::$pathNotFound) {
                    call_user_func_array(self::$pathNotFound, array($path));
                }
            }

        }

    }

}