<?php

/**
 * Class index
 * Testing Class
 */

class Home extends Controller
{

    protected $res;
    protected $uid;

    public function __construct()
    {
        $this->load_library("Response");
        $this->load_library("UUID");
        $this->res = new Response();
        $this->uid = new UUID();
        parent::__construct();
    }

    public function home()
    {
        print_r("Welcome. Please use post request to authenticate user.");
        print_r("Request ID: " . $this->uid->generate());
    }
}