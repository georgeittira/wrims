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
	  echo "<th>WRI key</th>";
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
      echo "<th>TL updated.</th>";
	    if ($result_wri->num_rows > 0) {
		while ($row = $result_wri->fetch_assoc()){
        $fcn_key = $row["ecn_fcn_key"]; 
        $sql1 = "select f.*, w.* from  ecn_fcn_list f, wri_list w where f.ecn_fcn_key = w.ref_ecn_fcn_key and f.ecn_fcn_key = '$fcn_key'";
        $result1=$conn-> query($sql1);
        $row1 = $result1->fetch_assoc();
        echo "<tr><td>";
		echo $row["wri_key"];
        echo "</td><td>";
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
		echo  $row1["ecn_fcn_no"];
		echo "</td><td>";
		echo  $row["tl_updated"];
		echo "</td></tr>";
		}
	}
	
	echo "</table>";
?>
</body>

</html>
