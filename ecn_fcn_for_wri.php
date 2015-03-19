<html><title>List of DCRVs approved by SORC for ECN/FCN</title>
<BODY>
<link rel='stylesheet' type='text/css' href='css/style_ecn.css'>
 
 <h3 align ='center'><font color=purple>List of ECNs/FCNs for WRI preparation.</font></h3>
 <table width = 90%  border =1 cellspacing=0 cellpadding=2 bordercolor=white
				bordercolorlight=gray style=border-collapse:collapse;>
<th>ECN/FCN No</th>
<th>Title</th>
<th>Date</th>
<th>Prepared by</th>

<?php
	include ("configdb.php");
	$ecn_sql = "select * from ecn_fcn_list where wri_reqd = 'yes' and wri_prepd = 'no'";
	$result_ecn=$conn-> query($ecn_sql);
		if (!$result_ecn) {
		echo "No ECNs/FCNs pending for preparation of WRI";
		exit(1);
	}
	  	if ($result_ecn->num_rows > 0) {
		while ($row = $result_ecn->fetch_assoc()){	
		$id  = $row["ecn_fcn_no"];
        $sqlname="select e.*, f.* from  employee.emp_data e, ecn_fcn_list f where e.emp_no = f.prepared_by";
		$resultname=$conn->query($sqlname);
        $rowname = $resultname->fetch_assoc();
        	echo "<tr><td>";			
			echo "<a href='wri_new.php?forWRI=$id'>$id </a>";
			echo "</td><td>";		
			echo  $row["title"];
			echo "</td><td>";
			echo  $row["ecn_date"];
			echo "</td><td>";	
			echo  $rowname["emp_chq_name"];
			echo "</td></tr>";
                       
		}
		}
?>
</table>
</body>

</html>
