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
     * The request we're working with.
     *
     * @var string
     */
    public $request;

    /**
     * The $routes array will contain our URI's and callbacks.
     * @var array
     */
    public $routes = [];

    /**
     * For this example, the constructor will be responsible
     * for parsing the request.
     *
     * @param array $request
     */
    public function __construct(array $request)
    {
        /**
         * This is a very (VERY) simple example of parsing
         * the request. We use the $_SERVER superglobal to
         * grab the URI.
         */
        $this->request = basename($request['REQUEST_URI']);

        load_class('Loader', 'library');
        $this->load = new Loader();
    }

    /**
     * Add a route and callback to our $routes array.
     *
     * @param string $uri
     * @param Callable $fn
     */
    public function addRoute(string $uri, \Closure $fn): void
    {
        $this->routes[$uri] = $fn;
    }

    /**
     * Determine is the requested route exists in our
     * routes array.
     *
     * @param string $uri
     * @return boolean
     */
    public function hasRoute(string $uri): bool
    {
        return array_key_exists($uri, $this->routes);
    }

    /**
     * Run the router.
     *
     * @return mixed
     */
    public function ignite()
    {
        if ($this->hasRoute($this->request)) {
            $this->routes[$this->request]->call($this);
        }
    }
}