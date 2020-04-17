<?php
require_once __DIR__ . '/vendor/autoload.php';

use Maulana20\GojekID;

$gojek = new GojekID();
try {
	$response = $gojek->loginPhone('<mobilePhone>');
} catch (Exception $e) {
	echo $e->getMessage();
}

var_dump($response);
