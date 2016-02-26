<?php

  require("db.php");

  $data = json_decode($_POST["data"], true);

  $sql="UPDATE user SET Vorname=\"".mysql_real_escape_string($data["vorname"])."\", Nachname=\"".mysql_real_escape_string($data["nachname"])."\", Password=\"".mysql_real_escape_string($data["passwort"])."\", Telefonnummer=\"".mysql_real_escape_string($data["tel"])."\", Email=\"".mysql_real_escape_string($data["mail"])."\" WHERE ID=\"".mysql_real_escape_string($data["id"])."\";";

  if(mysql_query($sql)){
    echo "success";
  }
  else{
    echo mysql_error();
  }

  
  mysql_close($con);
?>
