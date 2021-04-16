<?php

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
    "message" => "You Successfully Accessed smskAPI " . API_VER . ".",
    "version" => API_VER,
    "environment" => ENV,
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