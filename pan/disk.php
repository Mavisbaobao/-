<?php
	define('DISK', 'F:\\');
	$total=round((disk_total_space(DISK) /1024 /1024/1024),1);
	$free=round((disk_free_space(DISK)/1024/1024/1024),1);
	$used=$total-$free;
	$percent=round($used/$total ,2)*100 . '%';
	return array(
		'total'=>$total,
		'free'=>$free,
		'used'=>$used,
		'percent'=>$percent

		);
	 // print_r($a);