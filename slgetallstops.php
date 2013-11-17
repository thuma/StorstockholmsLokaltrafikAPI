<?php

$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_RETURNTRANSFER => true,
));
$idlistfile = 'allsiteids.json';

if(is_file($idlistfile)==FALSE){
	$slidlist = array();
	for($i = 1; $i < 10; $i++){
		curl_setopt($ch ,CURLOPT_URL, 'https://api.trafiklab.se/sl/realtid/GetSite.json?stationSearch='.$i.'&key=');
		$data = curl_exec($ch);
		$jsonobject = json_decode($data);
		print_r($jsonobject);
		$idarray = $jsonobject->Hafas->Sites->Site;
		foreach ($idarray as $row){
			$slidlist[] = $row->Number;
		}
	}
file_put_contents($idlistfile,json_encode($slidlist));
}
$slidlist = json_decode(file_get_contents($idlistfile));

$max = count($slidlist) - 1;
for($i = 0; i < $max; $i++){
	curl_setopt($ch ,CURLOPT_URL, 'https://api.trafiklab.se/sl/reseplanerare.json?S='.$slidlist[$i].'&Z='.$slidlist[$max].'&Date=10.12.2013&Time=12%3A00&Timesel=depart&Lang=sv&key=');
	print 'https://api.trafiklab.se/sl/reseplanerare.json?S='.$slidlist[$i].'&Z='.$slidlist[$max].'&Date=10.12.2013&Time=12%3A00&Timesel=depart&Lang=sv&key=';
	$max = $max - 1;
	}
curl_close($ch);
?>