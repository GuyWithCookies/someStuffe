<?php

  require("db.php");

  $id = $_POST["id"];
  $time = $_POST["time"];

  $sql="SELECT ID, UserID, Teilnahme From takespartin WHERE TurnierID=".intval(mysql_real_escape_string($id))." ORDER BY Teilnahme DESC;";

  $query = mysql_query($sql);  

  echo '<ul class="nav nav-tabs">
  		  <li id="info"><a href="#">Informationen</a></li>
  		  <li class="active" id="players"><a href="#">Teilnehmer</a></li>  					
	    </ul>';

  if(mysql_num_rows($query) > 0){
  		echo "<ul class='list-group'>";
			while ($row = mysql_fetch_assoc($query)) {
				//Get the Username by the UserId in the takesPartIn table
				//echo "Select Vorname, Nachname From user WHERE ID=".intval(mysql_real_escape_string($row["UserID"])).";";
				$userQuery = mysql_query("Select Vorname, Nachname From user WHERE ID=".intval(mysql_real_escape_string($row["UserID"])).";");
				
				$user = mysql_fetch_assoc($userQuery);

				echo '<li class="list-group-item list-group-item-';
				//Color of Player depends on participation
				//0 ---> not
				//1 ---> maybe
				//2 ---> sure
				if($row["Teilnahme"] == 1){
					echo "warning";
				}elseif ($row["Teilnahme"] == 2) {
					echo "success";
				}else{
					echo "danger";
				}
				echo '">'.$user["Vorname"].' '.$user["Nachname"].'</li>';
			}
			echo "</ul><br>";
  }
  else{

  	if($time){
    	echo "<h2><small>Bisher nimmt niemand Teil! Sei der Erste!</small></h2><br>";
    }else{
    	echo "<h2><small>Es hat leider niemand an diesem Tunier teilgenommen.</small></h2><br>";
    }
  }
	if($time){
  		echo '<button type="button" class="btn btn-success" id="do2">Teilnehmen</button>
  		<button type="button" class="btn btn-warning" id="do1">Vielleicht teilnehmen</button>
		<button type="button" class="btn btn-danger" id="do0">Nicht teilnehmen</button>';
	}
  mysql_close($con);
?>
