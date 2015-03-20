 
<html> <head>

<link rel='stylesheet' type='text/css' href='css/link.css'>
<title>KGS 1&2 DCMS</title>
</head>

<body leftmargin=6 bgcolor="#6699FF" text="#FFFFFF" link='#FFFFFF' vlink= '#FFFFFF' >
	<table border=0 width='100%' cellspacing="1" cellpadding="1">
		<tr><td bgcolor='#EE1122' align=center>
<?php
	session_start(); 
	$u       = $_SESSION['EMP'];
	$ag      = $_SESSION['Agency'];
	include ("configdb.php");
	$sql     = "select * from emp_data where emp_no = $u ";
	$result=$conn-> query($sql);
	$Agency  = 0;
	if ($result->num_rows > 0) 
		$row = $result->fetch_assoc();
	$login = $row["emp_chq_name"];
	
	echo "<tr><td>";
	echo "</td></tr>";
	
	
		//---Agency Login-----//
		$Agency =1;
		echo "<tr><td bgcolor=#CCDDEE> <b><font color=red>";
		echo "\n$login";
        echo ', ';
        echo $ag;
		echo ' - logged in';
		echo "</b></font></td></tr>";
		echo "<tr><td>";
		echo "<a href='main_menu.php' target='right' class='navigation'>Home</a><br>";
        echo "</td><td>";
        echo "<a href='logout.php' target='right' class='navigation'>Logout</a><br>";
        echo "</td></tr>";
?>

</table>
</body>
</html>



