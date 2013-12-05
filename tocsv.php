<?php

file_put_contents('sl.csv',"name;lat;lon;sa;id;gtfsid;gtfsname;gtfslat;gtfslon\n");
$data = json_decode(file_get_contents('coord-gtfs.json'));
foreach($data as $row){
file_put_contents('sl.csv',
$row->name.";".
$row->lat.";".
$row->lon.";".
$row->sa.";".
$row->id.";".
$row->gtfs->id.";".
$row->gtfs->name.";".
$row->gtfs->lat.";".
$row->gtfs->long."\n",FILE_APPEND);
}
?>