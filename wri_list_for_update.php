<html>
	
  <body  bgcolor="lightgrey" text="#000000" topmargin=2>
 
  <h3 align ='center'><font color=purple>List of WRIs Pending for updating Terminal Lists.</font></h3>
  <table width="100%" border=1 cellspacing="0" cellpadding="0" 
		bordercolordark="#FFFFFF" bordercolorlight="#808080" style="border-collapse:collapse;">
	<th>Doc type</th>
	<th>Doc No</th>
    <th>Ref. ECN/FCN No</th>
	<th>ECN/FCN Title.</th>
	<th> Date</th>
	<th>From.</th>
	<th>Marked for </th>
   <?php
   session_start();
	$ag = $_SESSION['Agency'];
    echo $ag;
	
	include ("configdb.php");
	    $sql1 = "select * from file_flow where fl_to_whom ='$ag' and fl_processed= 'No' and fl_action_required = 'YES' 
		and fl_status_flag = '330'";
        $result1=$conn->query($sql1);
        if ($result1->num_rows < 1) {
        echo "---NIL----";
		exit(1);
       } 
        if ($result1->num_rows > 0) {
		while ($row1 = $result1->fetch_assoc()){	    
       	$wri_no  = $row1["fl_doc_no"];
       	$seq_no   = $row1["fl_seq_no"];
        $typ      = $row1["fl_doc_type"];
	           
        /*$sql2 = "select * from wri_list where wri_status_flag = '324'";
		$result2=$conn->query($sql2);*/
          
        $sql3 = "select f.*, w.* from  ecn_fcn_list f, wri_list w where f.ecn_fcn_key = w.ref_ecn_fcn_key and w.wri_no = '$wri_no'";
        $result3=$conn-> query($sql3);
        $row3 = $result3->fetch_assoc();
        $url = "wri_update.php";
	    echo "<tr><td>";
        echo  "WRI";
		echo "</td>";
        echo "<td><a href=\"wri_update.php?docNo=$wri_no&seq_no=$seq_no&type=$typ\">$wri_no </a></td> ";
      	echo "<td>";
		echo  $row3["ecn_fcn_no"];
		echo "</td>";
        echo "<td>";
		echo  $row3["title"];
		echo "</td>";
		echo "<td width=8%>";
		echo $row1["fl_from_date"];
		echo "</td><td width=8%>";
		echo $row1["fl_from_dsgn"];
		echo "</td><td>";
		echo $row1["fl_marked_for"];
		echo "</td></tr>";
            }
        }        
	
?>	
</table>
</body>
</html>
	
  