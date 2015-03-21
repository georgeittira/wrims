 <HTML>

<head>
 </head>
 <BODY topmargin="1" bgcolor="#C0C0C0">

<link rel='stylesheet' type='text/css' href='css/style_ecn.css'>

<H4 align=center><u>Wire Route Information (WRI)for ECNs/FCNs </u><H4>

<?php
 
	include ("configdb.php");
	$u   = $_SESSION["EMP"];
	$id  = $_GET['docNo'];
	$sql = "select t1.*, t2.* from file_flow t1, mast_action t2
			where fl_doc_type='WRI'and fl_doc_no ='$id' and t2.action_doc='WRI' and t1.fl_status_flag= t2.action_key";
			
	$sql_wri = "select * from wri_list where wri_no = '$id'";
	$result  = $conn->query($sql_wri);
    $row = $result->fetch_assoc();
       
	$sql1="select u.*, c.* from  mast_unit u, wri_list c where c.wri_no = '$id' and c.unit_id = u.unit_id";
	$result1  = $conn->query($sql1);
       	
    $sql2 = "select f.*, w.* from  ecn_fcn_list f, wri_list w where (f.ecn_fcn_key = w.ref_ecn_fcn_key) and w.wri_no = '$id'";
    $result2=$conn-> query($sql2);
    $row2 = $result2->fetch_assoc();
    $title = $row2["title"];
    $ecn_fcn_no = $row2["ecn_fcn_no"];

    $issued_sql = "select distinct(m.ag_desc) as ag  from ecn_fcn_issued e,  mast_agency m where e.ecn_fcn_no = '$id' and e.agency_id= m.ag_id";
	$issued_result=$conn->query($issued_sql);	
       
		echo "<table width = 100%  border =1 cellspacing=0 cellpadding=2 bordercolor=white
				bordercolorlight=gray style = border-collapse:collapse;>";
		echo "<th>WRI No.</th>";
		echo "<td align=center>";
		echo "$id</td>";
		echo "<th> Applicable for</th>";
		/*if ($result1->num_rows > 0) {
		while ($row_unit = $result1->fetch_assoc()){
       	$unit = $row_unit["unit"];*/
         //     }
		//}
		echo "<td></td>";
		echo "<th>Issued with ref.to FCN</th>";
		echo "<td>$ecn_fcn_no</td>";
		echo "<th>Issued to :- </th>";
		/*if ($issued_result->num_rows > 0) {
		while ($row_issued = $issued_result->fetch_assoc()){
       	$toWhom = $row_issued["ag"];*/
        echo "<td></td>";
		echo "<tr><th>Prepared By :-</th>";
		echo "<td align=center>";
        echo $row["prepared_by"];
        echo "<br>";
        echo $row["prepared_desig"];
        echo "<br>";
        echo $row["wri_date"];
      	echo "</td><th>Checked By :- </th>";
        echo "<td align=center>";
        echo $row["check_by"];
        echo "<br>";
		echo $row["check_by_desig"];
        echo "<br>";
        echo $row["check_date"];
    	echo "</td><th>Reviewed By :- </th>";
		echo "<td align=center>";
        echo $row["reviewed_by"];
        echo "<br>";
		echo $row["rev_by_desig"];
        echo "<br>";
        echo $row["reviewed_date"];
        echo "</td><th>Approved By :- </th>";
		echo "<td align=center>";
        echo $row["approved_by"];
        echo "<br>";
		echo $row["appr_by_desig"];
        echo "<br>";
        echo $row["approved_date"];
        echo "</td></tr>";
		echo "</table>";
        echo "<table width = 100%  border =1 cellspacing=0 cellpadding=2 bordercolor=white
				bordercolorlight=gray style = border-collapse:collapse;>";
         echo "<th>FCN Title</th>";
		echo "<td>$title</td>";
        echo "</table>";
                
    $wri_sql = "select a.*,b.* from master_wri a, wri_list b where b.wri_no = '$id' and b.ref_ecn_fcn_key = a.ecn_fcn_key";
	$result_wri=$conn-> query($wri_sql);
	  echo "<h3 align ='center'><font color=purple>Wire Route Information</font></h3>";
  	  echo "<table width = 100%  border =1 cellspacing=0 cellpadding=2 bordercolor=white bordercolorlight=gray style=border-collapse:collapse;>";
	  echo "<th>WRI Key</th>";
	  echo "<th>Unit</th>";
	  echo "<th>From</th>";
	  echo "<th>Wire No.</th>";
	  echo "<th>Cable No.</th>";
	  echo "<th>Cable Binder</th>";
	  echo "<th>Colour Code</th>";
	  echo "<th>Destination</th>";
	  echo "<th>Remarks</th>";
      echo "<th>Ref. Drawing No.</th>";
	  
        if ($result_wri->num_rows > 0) {
		while ($row = $result_wri->fetch_assoc()){
		$i = $row["wri_key"];
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
		echo "</td></tr>";
		}
	}
	echo "</table>";
	
	
?>

</body>
</html>