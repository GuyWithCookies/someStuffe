<?php

	$ip = 'localhost';
	$username = "root";
	$passwd = '';


	$con = mysql_connect($ip, $username, $passwd);
	$db = mysql_select_db("volleyball", $con);
	
	if (!$con) {
	    echo (mysql_error());
	}
?>