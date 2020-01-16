<?php


require 'vendor/autoload.php';

use App\HotRoll\Database\Manager;

$db = Manager::getDatabase("mes");

$data = $db->select("RHS_RESULT", [
    "ACTCOILID", "PRODSTART", "PRODEND", "ACTSLABID", "GRADENAME", "HEXIT"
], [
    "ACTCOILID[=]" => "H110188900",
]);

print_r($db);
print_r($data);
