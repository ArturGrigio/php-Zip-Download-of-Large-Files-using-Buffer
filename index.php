<?php 
	header('Content-disposition: attachment; filename="myZip.zip"');
	header('Content-Type: application/octet-stream');
	header('Content-Length: 5000000') // You will have to either pass a variable to Content-Length or assign a value in bytes

	//if using a MySQL database
	/**********************************************
	$query = 'SELECT `tableName` FROM `dbName`;';
	$result = mysqli_query($link, $query);
	$info = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$files = $info['tableName'];
	if (is_array($files))
		$files = implode(" ",$files);
	**********************************************/	
	if ($files){
		$fp = popen('zip -r - '.$files, 'r');
	}
	else{
		$fp = popen('zip -r - 1.jpg 2.jpg 3.jpg', 'r');
	}
	
	flush() //flushing the buffer once brfore using	
	$bufsize = 8192; //apperently max buffer size is 8192 before cutoff
	$buff = '';
	while( !feof($fp) ) {
	   $buff = fread($fp, $bufsize);
	   echo $buff;
	   flush() //flusing the buffer afte reach fread
	}
	pclose($fp);
?>