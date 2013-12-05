<?php
require_once dirname(__FILE__) . '/gtfs-stop-reader/getstopname.php';

$all = file_get_contents('StopPoints.csv');
$all = preg_split('/\n/',$all);

foreach($all as $station)
	{
			$statione = preg_split('/;/',$station);
			print "\n".$statione[1]."->";
			$stop = getClosestStation(floatval($statione[3]),floatval($statione[4]));
			file_put_contents('sl-gtfsid.csv',trim($station).';'.$stop->stop_id.';'.
			$stop->stop_name.';'.
			$stop->stop_lat.';'.
			$stop->stop_lon."\n",FILE_APPEND);
			print $stop->stop_name;
	}

?>