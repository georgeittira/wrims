 
<?php
 
	session_start();
	include ("configdb.php");
   	   
       $doc_no          = $_GET['doc_no'];
       $ecn_fcn_key_key = $_GET['ecn_fcn_key'];
       $unit            =  $_GET['unit'];
       $from            = $_GET['from'];
       $wire_no         = $_GET['wire_no'];
       $cable_no        = $_GET['cable_no'];
       $cable_binder    = $_GET['cable_binder'];
       $color_code      =  $_GET['color_code'];
       $cable_mod       = $_GET['cable_mod'];
       $destination     = $_GET['destination'];
       $remarks         = $_GET['remarks'];
       $drawing_no      = $_GET['drawing_no'];
       
	 	