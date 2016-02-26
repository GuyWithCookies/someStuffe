<?php

  require("db.php");

  $data = json_decode($_POST["data"], true);

  $query = "INSERT INTO turniere VALUES ('' ,'".mysql_real_escape_string($data["Name"])."', '".mysql_real_escape_string($data["Datum"])."', '".mysql_real_escape_string($data["Startzeit"])."', '".mysql_real_escape_string($data["Ausschreibung"])."', '".mysql_real_escape_string($data["Kommentar"])."' );";
  
  $sql=mysql_query($query);

  if($sql){
    echo "success";
  }
  else{
    echo "Fehler:";
    echo mysql_error();
  }

  
  mysql_close($con);
?>