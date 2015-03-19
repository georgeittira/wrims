<?php
	
	session_start();
	session_unset();
	session_destroy();
	?>
<html>
<head>
<body>

<?php 


header('Location:login.php');
?>

</body>
</head>
</html>
