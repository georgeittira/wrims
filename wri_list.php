<html>
<head>
<title>WRI list</title>
<BODY>
<link rel='stylesheet' type='text/css' href='css/style_ecn.css'>

<?php

	include ("configdb.php");
	$wri_sql = "select * from master_wri";
	$result_wri=$conn-> query($wri_sql);
	  echo "<h3 align ='center'><font color=purple>WRI List</font></h3>";
  	  echo "<table width = 100%  border =1 cellspacing=0 cellpadding=2 bordercolor=white bordercolorlight=gray style=border-collapse:collapse;>";
	  echo "<th>Unit</th>";
	  echo "<th>From</th>";
	  echo "<th>Wire No.</th>";
	  echo "<th>Cable No.</th>";
	  echo "<th>Cable Binder</th>";
	  echo "<th>Colour Code</th>";
	  echo "<th>Destination</th>";
	  echo "<th>Remarks</th>";
	  echo "<th>Drawing No.</th>";
	  echo "<th>ECN/FCN No.</th>";
	    if ($result_wri->num_rows > 0) {
		while ($row = $result_wri->fetch_assoc()){
	 	echo "<tr>";
		echo "<td>";
		echo  $row["unit"];
		echo "</td><td>";
		echo  $row["unique_id_from"];
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
		echo  $row["remarks"];
		echo "</td><td>";
		echo  $row["drawing_no"];
		echo "</td><td>";
		echo  $row["change_no"];
		echo "</td></tr>";
		}
	}
	
	echo "</table>";
?>
</body>

</html>
