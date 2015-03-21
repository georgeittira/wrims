 
<?php
 
	
	include ("configdb.php");
   	   
       $doc_no          = $_GET['doc_no'];
       $unit            = $_GET['unit'];
       $from            = $_GET['from'];
       $wire_no         = $_GET['wire_no'];
       $cable_no        = $_GET['cable_no'];
       $cable_binder    = $_GET['cable_binder'];
       $color_code      = $_GET['color_code'];
       $cable_mod       = $_GET['cable_mod'];
       $destination     = $_GET['destination'];
       $remarks         = $_GET['remarks'];
       $drawing_no      = $_GET['drawing_no'];
       $wri_key         = $_GET['wri_key'];  
    //updating 'destination' details to terminal_list   
	switch ($remarks)	{
        case ($remarks == 'ADDITION') :
            if ( $cable_mod == 'yes' ) {
             $sql = "update terminal_list  set wire_no ='$wire_no',  cable_no ='$cable_no', cable_binder = '$cable_binder', color_code = '$color_code', destination ='$destination', drawing_no = '$drawing_no', wri_no = '$doc_no', update_date = Now() where unique_id = '$from'";
		    }
			elseif  ( $cable_mod == '' ) {
            $sql = "update terminal_list  set wire_no ='$wire_no', destination ='$destination', drawing_no = '$drawing_no', wri_no = '$doc_no', update_date = Now() where unique_id = '$from'";
        	}
            $result=$conn->query($sql);
        BREAK;
			
		case ($remarks == 'DELETION') :
         if ( $cable_mod == 'yes' ) {
             $sql = "update terminal_list  set wire_no ='spare',  cable_no ='', cable_binder = '', color_code = '', destination ='', drawing_no = '', wri_no = '$doc_no', update_date = Now() where unique_id = '$from'";
		    }
			elseif  ( $cable_mod == '' ) {
            $sql = "update terminal_list  set wire_no ='spare', destination ='', drawing_no = '', wri_no = '$doc_no', update_date = Now() where unique_id = '$from'";
        	}
            $result=$conn->query($sql);
         BREAK;
    }
       //updating 'destination' details to terminal_list  
       switch ($remarks)	{
        case ($remarks == 'ADDITION') :
            if ( $cable_mod == 'yes' ) {
             $sql = "update terminal_list  set wire_no ='$wire_no',  cable_no ='$cable_no', cable_binder = '$cable_binder', color_code = '$color_code', destination ='$from', drawing_no = '$drawing_no', wri_no = '$doc_no', update_date = Now() where unique_id = '$destination'";
		    }
			elseif  ( $cable_mod == '' ) {
            $sql = "update terminal_list  set wire_no ='$wire_no', destination = '$from', drawing_no = '$drawing_no', wri_no = '$doc_no', update_date = Now() where unique_id = '$destination'";
        	}
            $result=$conn->query($sql);
        BREAK;
			
		case ($remarks == 'DELETION') :
         if ( $cable_mod == 'yes' ) {
             $sql = "update terminal_list  set wire_no ='spare',  cable_no ='', cable_binder = '', color_code = '', destination ='', drawing_no = '', wri_no = '$doc_no', update_date = Now() where unique_id = '$destination'";
		    }
			elseif  ( $cable_mod == '' ) {
            $sql = "update terminal_list  set wire_no ='spare', destination ='', drawing_no = '', wri_no = '$doc_no', update_date = Now() where unique_id = '$destination'";
        	}
            $result=$conn->query($sql);
         BREAK;
    }
    // update tl_update flag in master_wri
       
       $sql = "update master_wri set tl_updated ='Yes' where wri_key = '$wri_key'";
       $result=$conn->query($sql);
      
            
    //update tl_update flag in wri_list
    	
    $sql1 = "select 1 as Flag from master_wri where wri_key = '$wri_key' and tl_updated = ''";
	$result1=$conn->query($sql1);
    if ($result1->num_rows > 0) {  
    $Flag = 1;
	}
	else
		$Flag = 0;
   if ($Flag == 1){
	header("Location: wri_update.php?docNo=".urlencode($doc_no));  
   }
	elseif ($Flag == 0){
	$sql2 = "update wri_list set tl_updated ='Yes' where wri_no = '$doc_no'";
	$result2=$conn->query($sql2);
	header("Location: wri_list_for_update.php");  
	}
  ?>  
   