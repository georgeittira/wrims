<html>
	
  <body  bgcolor="lightgrey" text="#000000" topmargin=2>
 
  <h3 align ='center'><font color=purple>List of WRIs Pending/Forwared to you.</font></h3>
  <table width="100%" border=1 cellspacing="0" cellpadding="0" 
		bordercolordark="#FFFFFF" bordercolorlight="#808080" style="border-collapse:collapse;">
	<th>Doc type</th>
	<th>Doc No</th>
    <th>Ref. ECN/FCN No</th>
	<th>Doc Title</th>
	<th> Date</th>
	<th>From / Name</th>
	<th>Desig.</th>
	<th>File marked for </th>
   <?php
   session_start();
	$ag = $_SESSION['Agency'];
   
	
	include ("configdb.php");
	    $pendingsql = "select * from file_flow 
		where fl_to_whom ='$ag' and fl_processed= 'No' and fl_action_required = 'YES' 
		order by fl_doc_type, fl_doc_no";
        $result=$conn->query($pendingsql);
		if ($result->num_rows < 1) {
        echo "---NIL----";
		exit(1);
	}     
		if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()){	    
       	echo "<tr><td>";
		$empno  = $row["fl_from_empno"];
		$sqlname="select e.* from  employee.emp_data e where e.emp_no = '$empno'";
		$resultname=$conn->query($sqlname);
        if ($resultname->num_rows > 0) {
		while ($rowname = $resultname->fetch_assoc()){
        $name =  $rowname["emp_chq_name"];   
          }
        }
       	
        $typ      = $row["fl_doc_type"];
		$id       = $row["fl_doc_no"];
		$seq_no   = $row["fl_seq_no"];
        $sql1 = "select f.*, w.* from  ecn_fcn_list f, wri_list w where f.ecn_fcn_key = w.ref_ecn_fcn_key and w.wri_no = '$id'";
        $result1=$conn-> query($sql1);
        $row1 = $result1->fetch_assoc();
        $title = $row1["title"];
        $ecn_fcn_no = $row1["ecn_fcn_no"];
        $url = "wri_show.php";
        echo "<tr><td>";
        echo  "$typ";
		echo "</td>";
		echo "<td><a href=\"showDoc.php?URL=$url&docNo=$id&seq_no=$seq_no&type=$typ\">$id </a></td> ";
		echo "<td>";
		echo  $ecn_fcn_no;
		echo "</td>";
        echo "<td>";
		echo  $title;
		echo "</td>";
		echo "<td width=8%>";
		echo $row["fl_from_date"];
		echo "</td><td width=13%>";
		echo  $name;
		echo "</td><td width=8%>";
		echo $row["fl_from_dsgn"];
		echo "</td><td>";
		echo $row["fl_marked_for"];
		echo "</td></tr>";
            }
        }        
	
?>	
</table>
</body>
</html>
	
  