<?php

	require 'environment.php';
	global $config;
	
	$config = array();
	
	if(ENVIRONMENT == "development"){
		$config['dbname'] = "ead";
		$config['host'] = "localhost";
		$config['dbuser'] = "root";
		$config['dbpass'] = "";
		$config['port'] = "3308";
		
	}else{
		$config['dbname'] = "ead";
		$config['host'] = "localhost";
		$config['dbuser'] = "root";
		$config['dbpass'] = "";
		$config['port'] = "3308";
	}
?>