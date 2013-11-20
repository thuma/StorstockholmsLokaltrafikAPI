<?php

$cordkey = "";

$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_RETURNTRANSFER => true,
));

$dataarray = array();
for($i = 1001; $i < 1000; $i++){
	curl_setopt($ch ,CURLOPT_URL, 'https://api.trafiklab.se/sl/reseplanerare.json?S=1000&Z='.$i.'&Date=10.12.2013&Time=12%3A00&Timesel=depart&Lang=sv&key='.$cordkey);
	$data = curl_exec($ch);
	$jsonobject = json_decode($data);
	
	$fran = new stdClass;
	$fran->id = $slidlist[$i];
	$fran->name = $jsonobject->HafasResponse->Trip[0]->Summary->Origin->{'#text'};
	$fran->lat = $jsonobject->HafasResponse->Trip[0]->Summary->Origin->{'@y'};
	$fran->lon = $jsonobject->HafasResponse->Trip[0]->Summary->Origin->{'@x'};
	$fran->sa = $jsonobject->HafasResponse->Trip[0]->Summary->Origin->{'@sa'};
	
	$till = new stdClass;
	$till->id = $slidlist[$max];
	$till->name = $jsonobject->HafasResponse->Trip[0]->Summary->Destination->{'#text'};
	$till->lat = $jsonobject->HafasResponse->Trip[0]->Summary->Destination->{'@y'};
	$till->lon = $jsonobject->HafasResponse->Trip[0]->Summary->Destination->{'@x'};
	$till->sa = $jsonobject->HafasResponse->Trip[0]->Summary->Destination->{'@sa'};
	$till->id = strval($i);
	
	$dataarray[1000]=$fran;
	$dataarray[$i]=$till;
	file_put_contents('coord.json',json_encode($dataarray));
	}
curl_close($ch);

?>