<?php
	  $action = $_POST["action"];

	  require("db.php");

	  $date_next = $_POST["time"];
	  $comp = $_POST["id"];
	  if($comp == -1){	  
		  if($date_next){
		  	$query = "SELECT ID, Name, DATE_FORMAT(datum,\"%d.%m.%Y\") AS Datum FROM turniere WHERE Datum >= CURDATE() ORDER BY Datum ASC;";
		  }
		  else{
		  	$query = "SELECT ID, Name, DATE_FORMAT(datum,\"%d.%m.%Y\") AS Datum FROM turniere WHERE Datum < CURDATE() ORDER BY Datum ASC;";
		  }

		  $sql=mysql_query($query);

		  if(mysql_num_rows($sql) > 0){
		  	$First = 1;
		  	echo "<div class=\"list-group\">";
				while ($row = mysql_fetch_assoc($sql)) {					
					echo "<a href=\"#\" id=\"competition".$row["ID"]."\" class=\"list-group-item ";
					if($First == 1){
						echo "active";
						$First = 0;
					}

					echo "\" data-toggle=\"tooltip\" title=\"".$row["Datum"]."\">".$row["Name"];
					echo "</a>";

				}
			echo "</div>";
		  }
		  else if(mysql_num_rows($sql) === 0){
		    echo "<h3><small>Keine anstehenden Tuniere</small></h3>";
		  }
		  else{
		  	echo "Fehler: " + mysql_error();
		  }
	  }
	  else{
	  	$query = "SELECT ID, Name, DATE_FORMAT(datum,\"%d.%m.%Y\") AS Datum, Startzeit, Ausschreibung, Kommentar FROM turniere WHERE ID=".$comp.";";

	  	$sql=mysql_query($query);

	  	if(mysql_num_rows($sql) > 0){

		  	echo ' <ul class="nav nav-tabs">
  					<li class="active" id="info"><a href="#">Informationen</a></li>
  					<li id="players"><a href="#">Teilnehmer</a></li>  					
				   </ul>';

			while ($row = mysql_fetch_assoc($sql)) {
				echo '<div class="panel-group">
	  				  <div class="panel panel-info">
					      <div class="panel-heading"><h4 class="text-left"><u>Turniername</u></h4></div>
					      <div class="panel-body">'.$row["Name"].'</div>
					  </div>
	  				  <div class="panel panel-info">
					      <div class="panel-heading"><h4 class="text-left"><u>Datum</u></h4></div>
					      <div class="panel-body">'.$row["Datum"].'</div>
					  </div>
					  <div class="panel panel-info">
					      <div class="panel-heading"><h4 class="text-left"><u>Startzeit</u></h4></div>
					      <div class="panel-body">'.$row["Startzeit"].' Uhr</div>
					  </div>';
				if($row["Ausschreibung"] !== ""){
					echo ' <div class="panel panel-info">
					      		<div class="panel-heading"><h4 class="text-left"><u>Ausschreibung</u></h4></div>
					      		<div class="panel-body"><a href="'.$row["Ausschreibung"].'">'.$row["Ausschreibung"].'</a></div>
					  		</div>';
				}
				if($row["Kommentar"] !== ""){
					echo '  <div class="panel panel-info">
					      <div class="panel-heading"><h4 class="text-left"><u>Kommentar/Zusatzinformationen</u></h4></div>
					      <div class="panel-body">'.$row["Kommentar"].'</div>
					  </div>';
				}
				
				echo '</div>
					<button id="change" class="btn btn-info">Daten ändern</button>
					<button id="delete" type="button" class="btn btn-danger">Turnier löschen</button>'	;	
			}   
		  }
		  else{
		  	echo "Fehler: " + mysql_error();
		  }

	  }
	  mysql_close($con);
	

  ?>