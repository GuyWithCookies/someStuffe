<?php

  require("db.php");

  $id = intval(mysql_real_escape_string($_POST["id"]));  //Tunierkennung
  $UserID = $_POST["UserID"]; //Kennung des Users welche in den Cookies steht
  $teilnahme = $_POST["Teilnahme"];

  $exists_query = "SELECT UserID from takespartin WHERE TurnierID=".$id." AND UserID=".$UserID.";";
  $sql_user_exists = mysql_fetch_assoc(mysql_query($exists_query));


  if(!(empty($sql_user_exists))){
    $query = "UPDATE takespartin Set Teilnahme=".$teilnahme." WHERE TurnierID=".$id.";";
    $sql=mysql_query($query);

    if($sql){
      echo "success";
    }
    else{
      echo "Fehler:";
      echo mysql_error();
    }
  }else{
    $query = "INSERT INTO takespartin Values ('',".$UserID.", ".$id.", ".$teilnahme.");";
    $sql=mysql_query($query);

    if($sql){
      echo "success";
    }
    else{
      echo "Fehler:";
      echo mysql_error();
    }
  }

  
  mysql_close($con);
?>