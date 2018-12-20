<?php
	error_reporting(E_ALL ^ E_NOTICE);
	error_reporting(E_ALL ^ E_DEPRECATED);
	
	session_start();
	if(session_destroy()){
		header("Location: index.php");
	}
?>