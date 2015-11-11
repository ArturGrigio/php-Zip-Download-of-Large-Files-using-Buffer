<?php 
	$files = array("testFiles/1.jpg", "testFiles/2.jpg", "testFiles/3.jpg");

	//Getting the total size of the files array
	$totalSize = 0;
	foreach ($files as $file) {
		$totalSize += filesize($file);
	}

	header('Pragma: no-cache'); 
	header('Content-Description: File Download'); 
	header('Content-disposition: attachment; filename="myZip.zip"');
	header('Content-Type: application/octet-stream');
	header('Content-Length: ' . $totalSize+300); //I don't understand why, but the total length is always 300kb short of the correct size
	header('Content-Transfer-Encoding: binary'); 

	//Opening a zip stream
	$files = implode(" ", $files);
	if ($files){
		$fp = popen('zip -r -0 - '.$files, 'r');
	}
	
	flush(); //Flushing the butter, pre streaming
	while(!feof($fp)) {
	   echo fread($fp, 8192);
	}

	//Closing the stream
	if ($files){ 
		pclose($fp);
	}
?>