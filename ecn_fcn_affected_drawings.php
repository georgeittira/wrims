<html><title>ECN/FCN affected drawings</title>
<BODY>
<link rel='stylesheet' type='text/css' href='css/style_ecn.css'>
 
 <h3 align ='center'><font color=purple>ECNs/FCNs affected drawings.</font></h3>
 <table width = 90%  border =1 cellspacing=0 cellpadding=2 bordercolor=white
				bordercolorlight=gray style=border-collapse:collapse;>
<th>ECN/FCN No</th>


<?php
	include ("configdb.php");
	$sql ="select * from ecn_fcn_list";
		$result=$conn-> query($sql);
		echo "<td><SELECT NAME='ecn_fcn'>";
		if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()){	  
		
			$c2 = $row["tu_ref_no"];
			$v2 = $row["ecn_fcn_no"];
			if ($v2) {
			    echo "<OPTION VALUE='$c2'>$v2</option>";
			}
			    }
        }            
		$sql ="select a.*, b.* from  from drawing_schedule a, ecn_fcn_affected_drawing b where b.ecn_fcn_no = '$c2' and a.drawing_no = b.drawing_no";
        $result=$conn-> query($sql);
      echo "<table width = 100%  border =1 cellspacing=0 cellpadding=2 bordercolor=white bordercolorlight=gray style=border-collapse:collapse;>";
	  echo "<th>Drawing No.</th>";
      echo "<th>Rev.No</th>";
      echo "<th>Rev.Date</th>";
      echo "<th>Revised</th>";
	  if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()){
	 	echo "<tr><td>";
		echo  $row["drawing_no"];
		echo "</td><td>";
		echo  $row["rev_no"];
		echo "</td><td>";		
		echo  $row["dial_date"];
		echo "</td><td>";		
		echo  $row["revised"];
		echo "</td></tr>";
		}
	}
            
            
 ?>


</table>
</body>

</html>
