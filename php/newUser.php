<?php

  require("db.php");

  $data = json_decode($_POST["data"], true);

  $exists_query = "SELECT ID from user WHERE Vorname=\"".mysql_real_escape_string($data["vorname"])."\" AND Nachname=\"".mysql_real_escape_string($data["nachname"])."\";";
  $sql_user_exists = mysql_fetch_assoc(mysql_query($exists_query));


  if(empty($sql_user_exists)){
    $query = "INSERT INTO user VALUES ('' ,'".mysql_real_escape_string($data["vorname"])."', '".mysql_real_escape_string($data["nachname"])."', '".md5("volleyball")."', '', '', '".mysql_real_escape_string($data["admin"])."' );";
    $sql=mysql_query($query);

    if($sql){
      echo "success";
    }
    else{
      echo "fehler";
      echo mysql_error();
    }
  }else{
    echo "exists";
  }

  
  mysql_close($con);
?>