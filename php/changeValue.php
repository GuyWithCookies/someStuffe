<?php

  require("db.php");

  $data = json_decode($_POST["data"], true);

  $sql="UPDATE user SET ".mysql_real_escape_string($data["Key"])."=".mysql_real_escape_string($data["Value"])." WHERE ID=".intval(mysql_real_escape_string($data["id"])).";";

  if(mysql_query($sql)){
  }
  else{
    echo "Error when changing admin settings: ".mysql_error();
  }

  
  mysql_close($con);
?>
