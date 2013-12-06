<?php
$all = file_get_contents('sl-gtfsid.csv');
$all = preg_split('/\n/',$all);

$sites = file_get_contents('sl-gtfsid.csv');
$sites = preg_split('/\n/',$sites);
$idlist = array();

foreach($sites as $site)
	{
		$site = preg_split('/;/',$site);
		$idlist[$site[2]] = $site[0];
	}

foreach($all as $station)
	{
			$statione = preg_split('/;/',$station);
			file_put_contents('sl-complete.csv',trim($station).';'.$idlist[$statione[2]]."\n",FILE_APPEND);
	}
?>
