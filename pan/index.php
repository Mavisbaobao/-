<?php


	$dir=include './disk.php';
	$road=isset($_GET['name'])?$_GET['name']:DISK;
	// print_r($_GET);

	// exit();

	// print_r($road);

	function gen($road){
		static $parr=array();
		$parent=dirname($road);
		$parr[]=$parent;
		if($road!=DISK){	
			gen($parent);
		}
		return $parr;
	}
	$breadcrumb=array_reverse(gen($road));
	print_r($breadcrumb);

	function scand_dir($road){
		if(!is_dir($road)){
			echo "对不起，不是一个目录";
			return;
		}
		$rows=scandir($road);//得到当前目录。，以及子目录
		$items=array();

		//判断当前下的目录中的文件名、大小、修改日期
		foreach ($rows as $key => $val) {
			if($val=='.'||$val==".."){
				continue;
			}
			$real=$road.'\\'.$val;
			$tmp['name']=iconv('gbk','utf-8',basename($real));
			$tmp['changedate']=date('Y-m-d h:i:s',filemtime($real));
			$tmp['flag']='folder';
			$tmp['mark']=true;
			$tmp['realpath']=realpath($real);

			if(is_file($real)){
				// 如果是文件，就计算文件的大小
				$tmp['size']=filesize($real);
				$tmp['flag']=pathinfo($real)['extension'];
				$tmp['mark']=false;
			}
			if (is_dir($real)) {
				$tmp['size']='-';
			}

				$items[]=$tmp;
		}
	
		return $items;

	}

	$items=scand_dir($road);
	// print_r($items);

	include './view/index.html';