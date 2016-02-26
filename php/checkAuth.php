<?php

	  require("db.php");

	  $creds = json_decode($_POST["creds"], true);
	  $query = "SELECT ID, Vorname, Nachname, Telefonnummer, Email, Admin FROM user WHERE Nachname=\"".mysql_real_escape_string($creds["nachname"])."\" AND Password=\"".mysql_real_escape_string($creds["passwort"])."\"";
	  $sql=mysql_fetch_assoc(mysql_query($query));

	  if($sql){
	  	$sql["success"] = true;
	    echo(json_encode($sql));
	  }
	  else{
	    echo mysql_error();
	  }
	  
	  mysql_close($con);
  ?>