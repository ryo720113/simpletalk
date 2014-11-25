<?php
$json = array();
$txt = isset($_GET['txt'])?$_GET['txt']:'';
$type = isset($_GET['type'])?$_GET['type']:'';

if($txt!=''){
	$file = $type.".txt";
	if(file_exists($file)){
		$fp = fopen($file,"a");
		$str = "\r\n".'Admin：'.$txt;
		//$str = $txt."\n"//linux;
		fwrite($fp, $str);
		fclose($fp);
		$json['status']=200;
		echo json_encode($json);
		exit;
	}
}
?>