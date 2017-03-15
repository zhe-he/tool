<?php  

	header('Content-Type: text/html; charset=utf-8');
	// $dirName=dirname(__FILE__)+'/images';
	$dirName = 'images';
	$fileName = 'imgArr'.date('Ymd-His').'.js';
	$arrName = 'allImgArr';

	$output = findImg($dirName);
	function findImg($dirName){
		$files = scandir($dirName);
		$arr = array();
		foreach ($files as $value) {
			if ($value !== '.' && $value !== '..') {
				$v = $dirName.'/'.$value;
				if (is_dir($v)) {
					$arr = array_merge($arr, findImg($v));
				}else{
					$ext = strtolower(pathinfo($value,PATHINFO_EXTENSION));
					if ( $ext === 'jpg'  ||
						 $ext === 'jpeg' ||
						 $ext === 'png'  ||
						 $ext === 'gif') {
							$arr[] = $v;
					}
				}
			}
			
		}
		return $arr;
	}

	$output = 'var '.$arrName.' = '.stripcslashes(json_encode($output)).';';
	$fp = fopen($fileName, 'wb');
	fwrite($fp, $output);
	fclose($fp);
	echo $output;


?>