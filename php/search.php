<?php
	  $string = $_POST["searchstring"];

	  //if($string != ""){

	  require("db.php");


	  $query = "SELECT ID, Vorname, Nachname FROM user WHERE Admin=0 AND (Vorname LIKE \"%".$string."%\" OR Nachname LIKE \"%".$string."%\") LIMIT 10;";
	  $sql=mysql_query($query);

	  if(mysql_num_rows($sql) > 0){
	  	echo "<table class=\"table table-striped\"><thead><tr><th>Vorname</th><th>Nachname</th></tr></thead><tbody>";
			while ($row = mysql_fetch_assoc($sql)) {
				echo "<tr id=row".$row["ID"].">";
				echo "<td><a href=\"showProfile.html?id=".$row["ID"]."\"><p>".$row["Vorname"]."</p></a></td>"; 
				echo "<td><a href=\"showProfile.html?id=".$row["ID"]."\"><p>".$row["Nachname"]."</p></a></td>";
				echo "<td><button type=\"button\" class=\"btn btn-success\" id=\"adminbtn".$row["ID"]."\">Adminrechte</button></td>";
				echo "</tr>";
			}
		echo "</tbody></table>";
	  }
	  else if(mysql_num_rows($sql) === 0){
	    echo "<h3><small>Zu deiner Suche passt kein Spielername...</small></h3>";
	  }
	  else{
	  	echo "Fehler: " + mysql_error();
	  }
	  
	  mysql_close($con);
	

  ?>