<?php
/*
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pramga: no-cache");
set_time_limit(0);		//秒數設為0，無時間上限
*/

$get = $_GET['action'];
$type = $_GET['type'];
$file = $type.".txt";

if(isset($get) && isset($type) && file_exists($file)){

	switch($get){
		case 'first':
			$chat = file_get_contents($file);
			$json=array(
				'status' => 200,
				'time' => gmdate("s"),
				'chat' => $chat
			);
			echo json_encode($json);
			break;
		case 'while':
			$oldsize = filesize($file);
			$newsize = filesize($file);
			
			while(true){
				if($oldsize!=$newsize){
					$chat = file_get_contents($file);
					$json=array(
						'status' => 200,
						'time' => gmdate("s"),
						'chat' => $chat
					);
					echo json_encode($json);
					exit;
				}
				clearstatcache();
				$newsize = filesize($file);
				usleep(10000);	//延遲時間
			}
			break;
	}
}
?>