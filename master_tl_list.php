<html>
<head>
<title>List of Non Safety Related CPIs</title>
<BODY>
<link rel='stylesheet' type='text/css' href='css/style_ecn.css'>

<?php

	include ("configdb.php");
	$master_tl_sql = "select * from master_tl";
	$result_master_tl=$conn-> query($master_tl_sql);
	  echo "<h3 align ='center'><font color=purple>Master Terminal List</font></h3>";
  	  echo "<table width = 100%  border =1 cellspacing=0 cellpadding=2 bordercolor=white bordercolorlight=gray style=border-collapse:collapse;>";
	  echo "<th>Unit</th>";
	  echo "<th>USI</th>";
	  echo "<th>Type</th>";
	  echo "<th>No</th>";
	  echo "<th>Strip No</th>";
	  echo "<th>Tl. No</th>";
	  echo "<th>Terminal Id</th>";
	  echo "<th>Wire No</th>";
	  echo "<th>Cable No.</th>";
	  echo "<th>Cable Binder</th>";
	  echo "<th>Col code</th>";
	  echo "<th>Destination</th>";
	  echo "<th>Ref. Drawing</th>";
	 if ($result_master_tl->num_rows > 0) {
		while ($row = $result_master_tl->fetch_assoc()){
	 	echo "<tr>";
		echo "<td>";
		echo  $row["unit"];
		echo "</td><td>";
		echo  $row["usi"];
		echo "</td><td>";		
		echo  $row["type"];
		echo "</td><td>";		
		echo  $row["type_id"];
		echo "</td><td>";			
		echo  $row["strip_id"];
		echo "</td><td>";	
		echo  $row["tl_no"];
		echo "</td><td>";		
		echo  $row["unique_id"];
		echo "</td><td>";
		echo  $row["wire_no"];
		echo "</td><td>";
		echo  $row["cable_no"];
		echo "</td><td>";
		echo  $row["cable_binder"];
		echo "</td><td>";
		echo  $row["color_code"];
		echo "</td><td>";
		echo  $row["destination"];
		echo "</td><td>";
		echo  $row["drawing_no"];
		echo "</td></tr>";
		}
	}
	
	echo "</table>";
?>
</body>

</html>
