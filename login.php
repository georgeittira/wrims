<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Page</title>
<link rel="stylesheet" href="style-3.css">

</head>
<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script language="javascript">

	jQuery(document).ready(function() {
	     jQuery('[name="agency"]').change(function() {
		var id=$(this).val();
		
		jQuery('[name="emp_no"]').val(id);

	   });

               });


function check()
{
	if(document.form1.emp_no.value=='')	{
		alert("User name Should Not be Blank");
		return false;
	}
	
	if(document.form1.MyPass.value=='')	{
		alert("Password Should Not be Blank");
		return false;
	}
	
	 if((document.form1.cic[0].checked==false)&&(document.form1.cic[1].checked==false))	{
		alert("Enter IBA user name and password for login");
		return false;
	}	
		
	
	ThisCC=document.form1[0].elements['emp_no'];
	Pass1=document.form1[0].elements['MyPass'];
	if ((ThisCC.value < 1 ) || (Pass1.value=="" ) ) 	{
		alert(" User name and Password are Must to Log-in");
		document.Login.emp_no.focus();
		return;		
	}
	else 	{		
		document.form1[0].submit();
	}
}

</script>

<body bgcolor="#E9E9E9">
<form name="form1" method="post" action="check_auth.php"> <!-- check_auth.php -->	
	<table height="25"><tr><td></td></tr></table>
	
	
	<table  align="center" width="100%" border="0">
		<tr>
			<td><center><h2> <font color="red" size="6"> Terminal Lists and Wire Route Information Management System
			<br /><br />Authentication.</font></h2></center></td>
		</tr>
	</table>
	
	<table align="center" border="1" width="80%" cellpadding="3" cellspacing="8">
	<tr>
	<td>
	<br /><br />
<?php
 include ("configdb.php");

	$sql="select * from  mast_agency order by ag_desc";
   	$result=$conn->query($sql);
	if($result){
	echo "<SELECT NAME='agency' >";

		if ($result->num_rows > 0) {
		    while ($row = $result->fetch_assoc()){
			$c = $row["ag_desc"];
			$v = $row["ag_empno"];
			if ($v) {
			    echo "<OPTION VALUE='$v'>$c - $v </option>";
				$emp = $v;
			}
			}
	    }			
	
		echo "<table border = 1 align = center  width=36%>";
		echo "<td align = right><strong>Emp.No / User name:-</strong> </td><td>";
		echo "<textarea name = emp_no cols=9 rows = 1>";
		echo "$emp";
		echo "</textarea></td>";
	}
	else 
		echo mysqli_error($conn);
		

?>		
			
		</tr>
		<tr>
			<td align="right"><strong>Password:-</strong> </td>
			<td> <input type="password" name="MyPass" size="8" /> </td>
		</tr>
	
	<br />
	
		</table>
	
	<br />
	<center><input type="submit" value="Submit" onclick="return check()" /></center>
	<center><h4><font color="blue">Enter IBA user name and password for login</font></h4></center><br /><br /><br />
	</td>
	</tr>
	</table>
</form>
</body>
</html>
