<?php
set_header(200);
echo json_encode(array(
    "message" => "You Successfully Accessed smskAPI " . PR_VER . "."
), JSON_UNESCAPED_UNICODE);