<?php

require_once('PersonApi.php');
require_once('AddressApi.php');

try {
    $api = new personApi();
    echo $api->run();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
?>

