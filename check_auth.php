<?php
    session_start();
	include("configdb.php");
	$u = $_POST['emp_no'];
	$p = $_POST['MyPass'];
		$sql = "select 1 as Flag from employee.auth_iba where 
		emp_no='$u' and	passwd_iba =md5('$p') " ;
	//echo $sql;
	
	$result=$conn->query($sql);
	if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$Flag = $row['Flag'];
	
	if ($Flag == 1) {
		$sql = "select * from mast_agency where ag_empno = '$u' ";
		$result=$conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$_SESSION["Agency"] = $row['ag_desc'];
			$_SESSION["EMP"] = $u;
		}
		include ("menu.php");
	}
	else {
		echo "Error....";
		include ("login.php");
	}
	}
	else echo "Error SQL";
	
?>

