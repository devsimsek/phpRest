<?php
isset($super) or die();

$super->response->set_header(200);

// Usage
// Named-based UUID.

$v3uuid = $super->UUID->genv3('1546058f-5a25-4334-85ae-e68f2a44bbaf', 'devsimsek');
$v5uuid = $super->UUID->genv5('1546058f-5a25-4334-85ae-e68f2a44bbaf', 'devsimsek');

// Pseudo-random UUID

$v4uuid = $super->UUID->generate();

$message = $v5uuid;
echo json_encode(array(
    "message" => $message
), JSON_UNESCAPED_UNICODE);