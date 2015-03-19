<?php
session_start();
	$id  	= $_POST['id'];
	$typ 	= $_POST['doc_type'];
	$toWhom = $_POST['marked_to'];
	$cmt	= $_POST['comments'];
	$act    = $_POST['action'];
	$old   	= $_POST['seq_no'];
	$emp 	= $_SESSION["EMP"];
    
	$ag     = $_SESSION['Agency'];
	include ("configdb.php");
	$sql="select e.*, b.* from  employee.emp_data e, emp_boss b where e.emp_no = '$emp' and e.emp_no = b.emp_no";
    $result=$conn->query($sql);
    $row1 = $result->fetch_assoc();
   	$usr 	 = $row1 ["emp_chq_name"];
	$desig	 = trim($row1["emp_desig"]);
	
	if (! $id ) {
		echo "Error....!"; exit(-1);
	}		
	
    if (! $act ) {
        $act = 306;
    }
	//----Update fILE FLOW  status for WRI
	$sql = "update file_flow set fl_processed ='Yes' where fl_seq_no = '$old'";
	$result=$conn->query($sql);
	//----Get Designation
	$sql    = "select * from mast_agency where ag_empno =  $emp";
	$result = $conn->query($sql);
    $row2 = $result->fetch_assoc();
	$dsgn   = $row2['ag_desc'];
	
	//---
	
	
		/*$sql =" select * from file_flow where fl_seq_no = '$old' ";
		$result=$conn->query($sql);
        $row3 = $result->fetch_assoc();
		$curStat = $row3['fl_status_flag'];
		$sql = "select * from mast_action where action_doc='WRI' and action_key > '$curStat'  order by action_key limit 1 ";
		$result=$conn->query($sql);
        $row4 = $result->fetch_assoc();
		//---- store it into variable $act for future updates....
		$act = $row4['action_key'];*/
	switch ($ag)	{
        case ($ag == 'CS') :
				//---- Approved by cs now mark to agencies
				$sql = "select distinct(m.ag_desc) as ag  from wri_issued e,  mast_agency m where e.wri_no = '$id' and e.agency_id= m.ag_id";
				$result=$conn->query($sql);
				if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){	  
                   
                   //----Insert into File Flow
					$toWhom = $row["ag"];
					$sqlF = "insert into file_flow 
							(fl_doc_no,fl_doc_type, fl_from_date, fl_from_dsgn, fl_to_whom, fl_comments, 
							 fl_from_empno, fl_status_flag, fl_marked_for ) values	
						 	('$id', '$typ', now(),'$dsgn', '$toWhom','$cmt','$emp', '$act', 'For implementation')";
					$resultF=$conn->query($sqlF);
					
					//--- Now loop
					   }
                }
                
			 if ($act == 304 ) {
			 $sql = "update wri_list  set approved_by ='$usr',  appr_by_desig ='$ag', approved_date = Now() where wri_no = '$id'";
					$result=$conn->query($sql);
				}
			BREAK;
			
		case ($ag == 'TSS') :
			
				if ($act == 303 ) {
					$sql = "update wri_list set reviewed_by ='$usr',  rev_by_desig ='$ag', reviewed_date = Now() 
						where wri_no = '$id'";
					$result=$conn->query($sql);
				
				$sql  = "insert into file_flow (fl_doc_no,fl_doc_type, fl_from_date, fl_from_dsgn, fl_to_whom, fl_comments, 
						fl_from_empno, fl_status_flag, fl_marked_for)
						values	('$id', '$typ', now(),'$dsgn', '$toWhom','$cmt','$emp', '$act', 'For WRI approval')";
				$result=$conn->query($sql);
                }
                if ($act == 324 ) {
					$sql  = "insert into file_flow (fl_doc_no,fl_doc_type, fl_from_date, fl_from_dsgn, fl_to_whom, fl_comments, 
						fl_from_empno, fl_status_flag, fl_marked_for)
						values	('$id', '$typ', now(),'$dsgn', '$toWhom','$cmt','$emp', '$act', 'For document updation')";
                $result=$conn->query($sql);        
                }    
			BREAK;
		case (substr($ag,0,3 ) == 'STE') :	
			
				if ($act == 302 ) {
					$sql = "update wri_list  set check_by ='$usr',  check_by_desig ='$ag', check_date = Now(),wri_status_flag=$act 
						where wri_no = '$id'";
					$result=$conn->query($sql);
				}
				$sql  = "insert into file_flow (fl_doc_no,fl_doc_type, fl_from_date, fl_from_dsgn, fl_to_whom, fl_comments, 
						fl_from_empno, fl_status_flag, fl_marked_for )
						values	('$id', '$typ', now(),'$dsgn', '$toWhom','$cmt','$emp', '$act', 'For WRI review')";
				$result=$conn->query($sql);
               
			BREAK;
         
        case (substr($ag,0,3 ) == 'SME') :	     
           
				if ($act == 311 ) {
				$sql  = "insert into file_flow (fl_doc_no,fl_doc_type, fl_from_date, fl_from_dsgn, fl_to_whom, fl_comments, 
						fl_from_empno, fl_status_flag, fl_marked_for )
						values	('$id', '$typ', now(),'$dsgn', '$toWhom','$cmt','$emp', '$act', 'For implementation')";
				 $result=$conn->query($sql);
                }
               
			    if ($act == 321 ) {
				$sql  = "insert into file_flow (fl_doc_no,fl_doc_type, fl_from_date, fl_from_dsgn, fl_to_whom, fl_comments, 
						fl_from_empno, fl_status_flag, fl_marked_for )
						values	('$id', '$typ', now(),'$dsgn', '$toWhom','$cmt','$emp', '$act', 'For QA check')";
                $result=$conn->query($sql);
				}
            BREAK;	
         
        case (substr($ag,0,2 ) == 'ME') :	   
				
				if ($act == 320 ) {
				$sql  = "insert into file_flow (fl_doc_no,fl_doc_type, fl_from_date, fl_from_dsgn, fl_to_whom, fl_comments, 
						fl_from_empno, fl_status_flag, fl_marked_for )
						values	('$id', '$typ', now(),'$dsgn', '$toWhom','$cmt','$emp', '$act', 'WRI implemented')";
                    $result=$conn->query($sql);       
				}
				
			BREAK;	
            
			case ($ag == 'QAS') :                
            
				if ($act == 312 ) {
					$sql  = "insert into file_flow (fl_doc_no,fl_doc_type, fl_from_date, fl_from_dsgn, fl_to_whom, fl_comments, 
						fl_from_empno, fl_status_flag, fl_marked_for )
						values	('$id', '$typ', now(),'$dsgn', '$toWhom','$cmt','$emp', '$act', 'For QA checks')";
                    $result=$conn->query($sql);
				}	
                if ($act == 323 ) {
					$sql  = "insert into file_flow (fl_doc_no,fl_doc_type, fl_from_date, fl_from_dsgn, fl_to_whom, fl_comments, 
						fl_from_empno, fl_status_flag, fl_marked_for )
						values	('$id', '$typ', now(),'$dsgn', '$toWhom','$cmt','$emp', '$act', 'For document updation')";
				    $result=$conn->query($sql);
                 }  
            BREAK;     
         case (substr($ag,0,3 ) == 'QAE') :     
			
				if ($act == 322 ) {
				$sql  = "insert into file_flow (fl_doc_no,fl_doc_type, fl_from_date, fl_from_dsgn, fl_to_whom, fl_comments, 
						fl_from_empno, fl_status_flag, fl_marked_for )
						values	('$id', '$typ', now(),'$dsgn', '$toWhom','$cmt','$emp', '$act', 'For QA approval')";
				
                $result=$conn->query($sql);
                }
			BREAK;					            
		  
       case (substr($ag,0,2 ) == 'TE') :     
			
				if ($act == 330 ) {
				$sql  = "insert into file_flow (fl_doc_no,fl_doc_type, fl_from_date, fl_from_dsgn, fl_to_whom, fl_comments, 
						fl_from_empno, fl_status_flag, fl_marked_for )
						values	('$id', '$typ', now(),'$dsgn', '$toWhom','$cmt','$emp', '$act', 'For QA approval')";
				 $result=$conn->query($sql);
                }
               
                
			BREAK;					              
	}
	header("Location: pending_list.php/");
?>
