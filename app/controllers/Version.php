<?php

class Version extends Controller
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

    public function index()
    {

        $this->res->set_header(200);

        if (isset($_SERVER['HTTP_REFERER'])) {
            $referer = $_SERVER['HTTP_REFERER'];
        } else {
            $referer = "unknown";
        }

        $server = array();

        foreach ($_SERVER as $key => $value) {
            array_push($server, array(
                "field" => $key,
                "value" => $value
            ));
        }

        echo json_encode(array(
            "message" => "You Successfully Accessed phpRest " . PR_VER . ".",
            "version" => PR_VER,
            "environment" => ENV,
            "request_id" => $this->uid->generate(),
            "server_information" => $server,
            "client_information" => array(
                "user_agent" => $_SERVER["HTTP_USER_AGENT"],
                "ip_address" => $_SERVER["REMOTE_ADDR"],
                "port" => $_SERVER["REMOTE_PORT"],
                "referer" => $referer,
                "request_uri" => $_SERVER["REQUEST_URI"],
                "request_method" => $_SERVER["REQUEST_METHOD"],
                "time" => date("Y-m-d h:i:s", time())
            )
        ), JSON_UNESCAPED_UNICODE);
    }

}