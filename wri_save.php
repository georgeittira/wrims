<?php
	
	session_start();
	include ("configdb.php");
   	$units   				= array (1,2);
	$prepd_by     			= $_GET['prepd_by'];
    $prepd_by_desig         = $_GET['prepd_by_desig'];
	$issue_to       		= array ('SME(I)', 'SME (E)');
    $fcn_key       		    = $_GET['fcn_key'];
    $boss_desig             = $_GET['boss_desig'];
   
	   
    $sql = "insert into wri_list (ref_ecn_fcn_key, wri_date, prepared_by, prepared_desig, wri_status_flag) values ('$fcn_key', now(), '$prepd_by','$prepd_by_desig', '301')";
	//echo $sql;
	$result=$conn->query($sql);
	
	$sql =  "select last_insert_id() as id";
	$result=$conn->query($sql);
    $row1 = $result->fetch_assoc();
	$inserted_id = $row1['id'];
	$emp = $_SESSION['EMP'];

	//-- now insert into workflow
	//--- Multiple Agencies--//
	
	   foreach ($issue_to as $idAgency) {
		$sql 	= "select * from mast_agency where ag_desc = '$idAgency' ";
		$result	= $conn->query($sql);
        $row2 = $result->fetch_assoc();
		$ag 	=  $row2['ag_id'] ;
		foreach ($units as $uid) 	{
			$sql = "insert into wri_issued (wri_no, agency_id, unit_id)
					values ('$inserted_id', '$ag', '$uid' )";
			$result=$conn->query($sql);
		}
	}
	
	$sql = "insert into file_flow (fl_doc_type, fl_doc_no, fl_from_date, fl_from_empno, fl_from_dsgn,
		 fl_to_whom, fl_comments, fl_status_flag,  fl_marked_for)
        		values ('WRI', '$inserted_id', now(), '$emp','$prepd_by_desig', '$boss_desig', 
		'WRI Prepared',  '301', 'For WRI checking')";
	$result=$conn->query($sql);
	//---Update status of WRI
	
	include("main_menu.php");
	
	
?>