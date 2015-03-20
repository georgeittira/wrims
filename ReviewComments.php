<html>
<link rel='stylesheet' type='text/css' href='css/style-3.css'>

<?php
	
	$id     = $_SESSION['id'];
	$typ    = $_SESSION['typ'];
	$u      = $_SESSION["EMP"];
	$ag     = $_SESSION['Agency'];
	$upby   = $u;
	$desig  = $ag;
	
	$_SESSION['continue']= 1;
	$_SESSION["upDocType"]	= $typ;
	$_SESSION["upDocNo"] 	= $id;
	$_SESSION["upby"]       = $upby;
	$_SESSION["upbydesig"]  = $desig;
	if (! $id ) {
		echo "Error....!"; exit(-1);
	}		
	//include_once("common.php");
	//include ("uploadFile.inc.html");
	//----Show attachements
	$sql = "select a.*, e.* from attachments a, employee.emp_data e where a.doc_type='$typ' and a.doc_no = '$id' and a.doc_upload_by = e.emp_no";
	$R0=$conn->query($sql);
	
		echo " <table width='60% align = center' cellspacing=0 cellpadding=2 border=1 style=border-collapse:collapse;> ";
		echo "<th align = center>Attached documents</th>";
        echo "<th>";
		echo "<a href='javascript:openAttach()'>Attach new document </a>";
		echo "</th>";
		echo " </table>";
		if ($R0->num_rows > 0) {
		echo " <table width='60% align = center' cellspacing=0 cellpadding=2 border=1 style=border-collapse:collapse;> ";
		echo "<th> View documents attached</th> ";
		echo "<th>Uploaded by</th> ";
		echo "<th>Designation</th> ";
		echo "<th>Section</th> ";
		while ($row = $R0->fetch_assoc()){
		echo "<tr><td>";			
		$f = $row["doc_name"];
		echo "<a href='maxFileUpload/UploadedFiles/$f' > $f </a> ";
		echo "</td><td>";
		echo $row["emp_chq_name"];
		echo "</td><td> ";			
		echo $row["doc_upload_agency"];
		echo "</td><td> ";			
		echo $row["emp_section"];
		echo "</td></tr>";			
		    }
        } 
		echo "</table>";
	
		/*echo " <table width='20% align = left' cellspacing=0 cellpadding=2 border=1 style=border-collapse:collapse;> ";*/
		
	
	//---
		$filestat = "select f.*,e.*,a.action_name  from file_flow f,employee.emp_data e ,mast_action a
	     			 where f.fl_doc_type='$typ' and f.fl_status_flag > 1 and fl_doc_no='$id'
					 and f.fl_from_empno=e.emp_no and 
					f.fl_status_flag=a.action_key 
					 and a.action_doc='WRI' order by fl_seq_no; ";
	//echo $filestat;
		echo "<table width='100%' cellspacing=0 cellpadding=2 border=1 bordercolordark=#FFFFFF bordercolorlight=#808080 						   					      			style=border-collapse:collapse;>";
		echo "<th align center> Review comments-:-</th>";
		echo "</table>";
	$R1=$conn->query($filestat);
	echo " <table width='100%' cellspacing=0 cellpadding=2 border=1 style=border-collapse:collapse;> ";
	
    if ($R1->num_rows > 0) {
		
		echo "<th width=15%>Forwarded by </th> ";
		echo "<th>Designation</th> ";
		echo "<th>Date</th> ";
		echo "<th>Marked to </th>";
		echo "<th width=40%>Coments</th>";
        echo "<th>Marked for </th>";
		 $doNotContinue =0;
        while ($row1 = $R1->fetch_assoc()){
		
		        $curStatus = $row1["fl_status_flag"];
		        if (($curStatus == 330 ) ) {
             		  	$doNotContinue = 1;
            	}
		     echo "<tr><td>";
			 echo $row1["emp_chq_name"];
			 echo "</td><td>";
			 echo $row1["fl_from_dsgn"];
			 echo "</td><td>";
			 echo $row1["fl_from_date"];
			 echo "</td><td>";
			 echo $row1["fl_to_whom"];
			 echo "</td><td>";
			 echo "<font color=blue>" . $row1["fl_comments"] ." </font>";
			 echo "</td><td>";
			 echo  "<font color=green>" . $row1["fl_marked_for"]. " </font>";
             echo "</td></tr>";
             } 
		 }
         echo " </table>";
		//echo "======$doNotContinue";
		  if ( $doNotContinue == 1 ){
           $_SESSION['continue'] = 0;
      	 }
		 
	    
?>