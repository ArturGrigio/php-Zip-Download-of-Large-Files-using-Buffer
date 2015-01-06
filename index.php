<?php 
	header('Content-disposition: attachment; filename="myZip.zip"');
	header('Content-Type: application/octet-stream');

	//if using a MySQL database
	/**********************************************
	$query = 'SELECT `tableName` FROM `dbName`;';
	$result = mysqli_query($link, $query);
	$info = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$files = $info['tableName'];
	if (is_array($files))
		$files = implode(" ",$files);
	**********************************************/	

	$fp = popen('zip -r - 1.jpg 2.jpg 3.jpg', 'r');
	$bufsize = 8192;
	$buff = '';
	while( !feof($fp) ) {
	   $buff = fread($fp, $bufsize);
	   echo $buff;
	}
	pclose($fp);
?>