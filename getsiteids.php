<?php

$cordkey = '';

$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_RETURNTRANSFER => true,
));

$dataarray = array();
$temparray = array();
$data = json_decode(file_get_contents('coord-clean.json'));

foreach($data as $key => $row){
	if(isset($data->{$key}->idbyname)){continue;}
	curl_setopt($ch ,CURLOPT_URL, 'https://api.trafiklab.se/sl/realtid/GetSite.json?stationSearch='.$row->name.'&key='.$cordkey);
	$data = curl_exec($ch);
	$data = json_decode($data);
	$data->{$key}->id = $data->Hafas->Sites->Site->Number;
	$data->{$key}->idbyname = true;
	print $data->{$key}->id.'->'.$row->name."\n";
	file_put_contents('coord-siteid.json',json_encode($data));
}

curl_close($ch);
file_put_contents('coord-siteid.json',json_encode($data));

?>