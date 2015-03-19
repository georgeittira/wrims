<html>
<head>
<title>Drawing Schedule</title>
<BODY>
<link rel='stylesheet' type='text/css' href='css/style_ecn.css'>

<?php

	include ("configdb.php");
	$Drawing_sch_sql = "select * from drawing_schedule";
	$result_Drawing_sch=$conn-> query($Drawing_sch_sql);
	  echo "<h3 align ='center'><font color=purple>Drawing Schedule</font></h3>";
  	  echo "<table width = 100%  border =1 cellspacing=0 cellpadding=2 bordercolor=white bordercolorlight=gray style=border-collapse:collapse;>";
	  echo "<th>Project</th>";
	  echo "<th>USI</th>";
	  echo "<th>SL. NO</th>";
	  echo "<th>Type</th>";
	  echo "<th>Title</th>";
	  echo "<th>Sheets</th>";
	  echo "<th>Rev.No</th>";
	  echo "<th>Rev.Date</th>";
	  echo "<th>Size</th>";
	  echo "<th>Drawing No.</th>";
	  echo "<th>PLC</th>";
	  	 if ($result_Drawing_sch->num_rows > 0) {
		while ($row = $result_Drawing_sch->fetch_assoc()){
	 	echo "<tr>";
		echo "<td>";
		echo  $row["project"];
		echo "</td><td>";
		echo  $row["usi"];
		echo "</td><td>";		
		echo  $row["sl_no"];
		echo "</td><td>";		
		echo  $row["type"];
		echo "</td><td>";			
		echo  $row["title"];
		echo "</td><td>";	
		echo  $row["no_of_sheets"];
		echo "</td><td>";		
		echo  $row["rev_no"];
		echo "</td><td>";
		echo  $row["dial_date"];
		echo "</td><td>";
		echo  $row["size"];
		echo "</td><td>";
		echo  $row["drawing_no"];
		echo "</td><td>";
		echo  $row["plc"];
		echo "</td></tr>";
		}
	}
	
	echo "</table>";
?>
</body>

</html>
