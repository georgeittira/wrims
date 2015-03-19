<?php
session_start();

if($_POST['id']) {
	include ("configdb.php");
	$id     = $_POST['id'];
	$emp  = $_SESSION['EMP'];
	$ag     = $_SESSION['Agency'];
	if ($id == 301 ||$id == 302 || $id == 303 || $id == 320 || $id == 322) {
	        $sql = "select emp_report_to as ag  from emp_boss where emp_no= $emp"; 
	}
	elseif ($id == 311) {
	        $sql = "select ag_desc as ag from mast_agency m, emp_boss e 
		  	where e.emp_no = m.ag_empno and e.emp_report_to= '$ag' and ag_desc like 'ME%' order by ag_desc"; 
	}
	elseif ($id == 321|| $id == 322) {
	         $sql = "select ag_desc as ag from mast_agency where ag_desc ='QAS'"; 
	}
	elseif ($id == 323) {
	        //---TSS
	        $sql = "select ag_desc as ag from mast_agency where ag_desc ='TSS'"; 
	}
	
	
	elseif ($id == 304) {
	        //---WRI approved by CS
	        $sql = "select ag_desc as ag from mast_agency where ag_desc like 'SME%' "; 
	}
	elseif ($id == 324 ) {
	        //---For master document updation
	        $sql = "select ag_desc as ag from mast_agency where ag_desc like 'TE%'"; 
	}
    elseif ($id == 312 ) {
	        //---For master document updation
	        $sql = "select ag_desc as ag from mast_agency where ag_desc like 'QAE%'"; 
	}
		
	//echo $sql;
	if (! $sql ) {
		//----No SQL to execute
		exit(-1);
	}
		
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		
	   while ($row = $result->fetch_assoc()){
		$c = $row["ag"];
		$v = $c;
		if ($v) {
			echo "<OPTION VALUE='$c'>$v </option>";
		}
		
	     }
	}
}
?>
