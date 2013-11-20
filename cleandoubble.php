<?php

$dataarray = array();
$temparray = array();
$data = json_decode(file_get_contents('coord.json'));
foreach($data as $row){
$dataarray[$row->sa] = $row;
$dataarray[$row->sa]->id = substr($row->sa,-4);
}

foreach($dataarray as $row){
$temparray[] = $row;
}

	
file_put_contents('coord-clean.json',json_encode($temparray));

?>