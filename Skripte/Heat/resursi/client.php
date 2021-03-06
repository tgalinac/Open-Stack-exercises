<?php
require_once "nusoap.php";
$serviceIP = explode("\n", file_get_contents('./serviceIP.txt'));

$client = new nusoap_client("http://".$serviceIP[0]."/service.php?wsdl", true);

$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}

$result = $client->call("checkService", array("name" => "Student"));

if ($client->fault) {
    echo "<h2>Fault</h2><pre>";
    print_r($result);
    echo "</pre>";
}
else {
    $error = $client->getError();
    if ($error) {
        echo "<h2>Error</h2><pre>" . $error . "</pre>";
    }
    else {
        echo "<h2>Status:</h2><pre>";
        echo $result;
        echo "</pre>";
    }
}
?>