<?php

$dataarray = array();
$temparray = array();
$data = json_decode(file_get_contents('coord.json'));
foreach($data as $row){
$dataarray[$row->sa] = $row;
}

foreach($dataarray as $row){
$temparray[] = $row;
}

file_put_contents('coord-clean.json',json_encode($temparray));

?>