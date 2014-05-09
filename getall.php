<?php
header('Content-type: application/json; charset=UTF-8');

if(file_exists('all.cache')){
	$nu = filemtime('all.cache');
	if(microtime(true)-$nu<1000000){
		$data = file_get_contents('all.cache');
	}
}
else{
	$data = file_get_contents('http://sl.se/api/map/GetSitePoints/61.0/15.0/58.0/20.0/1,2,32,4,8,16');
	file_put_contents('all.cache',$data);
}

print $data

?>