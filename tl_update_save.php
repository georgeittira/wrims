 
<?php
 
	session_start();
	include ("configdb.php");
   	   
       $doc_no          = $_GET['doc_no'];
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
    //updating 'destination' details to terminal_list   
	switch ($remarks)	{
        case ($remarks == 'ADDITION') :
            if ( $cable_mod == 'yes' ) {
             $sql = "update terminal_list  set wire_no ='$wire_no',  cable_no ='$cable_no', cable_binder = '$cable_binder', color_code = '$color_code', destination ='$destination', drawing_no = '$drawing_no', wri_no = '$doc_no', update_date = Now() where unique_id = '$from'";
		    }
			elseif  ( $cable_mod == 'no' ) {
            $sql = "update terminal_list  set wire_no ='$wire_no', destination ='$destination', drawing_no = '$drawing_no', wri_no = '$doc_no', update_date = Now() where unique_id = '$from'";
        	}
            $result=$conn->query($sql);
        BREAK;
			
		case ($remarks == 'DELETION') :
         if ( $cable_mod == 'yes' ) {
             $sql = "update terminal_list  set wire_no ='spare',  cable_no ='', cable_binder = '', color_code = '', destination ='', drawing_no = '', wri_no = '$doc_no', update_date = Now() where unique_id = '$from'";
		    }
			elseif  ( $cable_mod == 'no' ) {
            $sql = "update terminal_list  set wire_no ='spare', destination ='', drawing_no = '', wri_no = '$doc_no', update_date = Now() where unique_id = '$from'";
        	}
            $result=$conn->query($sql);
         BREAK;
    }
       //updating 'destination' details to terminal_list  
       
       
        header("Location: wri_update.php?docNo=".urlencode($doc_no));
   