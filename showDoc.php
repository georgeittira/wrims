
<?php
	session_start();
	$url 		= $_GET['URL'];
	$id 	    = $_GET['docNo'];
	$typ        = $_GET['type'];
	$seq_no     = $_GET['seq_no'];
	$ag         = $_SESSION['Agency'];
	$defComments = "";
	
  	$_SESSION['id']	 = $id;
	$_SESSION['typ'] = $typ;
	
	include ("$url");
	include ("configdb.php");
	
						$statusSql = "select * from file_flow where fl_doc_type ='$typ'  and fl_doc_no= '$id' and fl_processed= 'No' ";
						$result=$conn->query($statusSql);
                        if ($result->num_rows < 1) {
							echo "---NIL----";
							exit(1);
						}
						if ( $ag == 'TSS' ) {
            				$where = " and action_key in (303, 324)";
        				}
						elseif  (substr($ag,0,3 ) == 'STE') {
                			 $where = " and action_key = 302 ";
        				}
						elseif ( $_SESSION['Agency'] == 'CS'){ 
							$where = " and action_key = 304 ";
						} 
						elseif  (substr($ag,0,3 ) == 'SME') {
                			 $where = " and action_key in (311, 321)";
        				}
						elseif  (substr($ag,0,2 ) == 'ME') {
                 			$where = " and action_key = 320 ";
        				} 
                        elseif  (substr($ag,0,2 ) == 'TE') {
                 			$where = " and action_key = 330 ";
						} 
                        elseif  (substr($ag,0,3 ) == 'QAE') {
                 			$where = " and action_key = 322 ";
						} 
                        elseif ( $_SESSION['Agency'] == 'QAS'){ 
							$where = " and action_key in (312, 323)";
						} 
                        
                        $actionSql = "select * from mast_action where action_doc='WRI'  $where  order by action_key ";
						
                        $result=$conn->query($actionSql);
 	
	//---Show the REVIEW & status
	
	include("ReviewComments.php");
	if ( !$_SESSION['continue']) {
       			 exit(-1);
     	}

	
		include ("ajax_marked_for.inc.php");
	
	//---Form
	
			echo "<form action='reviewSave.php' method='POST' >";
			echo "<table border =1 width=100%>";
			echo "<tr><td>Comments</td><td><textarea name='comments' cols=130 rows=3 >$defComments</textarea>";
			echo "</td></tr>";
			echo "<tr><td>Action</td><td>";
   		              
		  		echo "<SELECT NAME='action' CLASS ='action' >";
       			echo "<OPTION VALUE=''>---select---- </option>";
	    		if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                
                    	$c = $row["action_key"];
						$v = $row["action_name"];
						if ($v) {
			    			echo "<OPTION VALUE='$c'>$v </option>";
						}
						
	     			}
	 			}
          
	 			echo "</select>";
				echo "Marked To :- <SELECT NAME='marked_to'  class='marked_to' id='marked_to'>";
				//---
				//---Get the values thru AJAX
				//---
				echo "<OPTION VALUE=''>---select---- </option>";
	 			echo "</select> ";
          
 	echo "<input type=hidden name='id' value= '$id' >";
	echo "<input type=hidden name='doc_type' value= '$typ' >";
	echo "<input type=hidden name='seq_no' value= '$seq_no' >";
	echo "<input type=submit value='Save& Exit!!' class ='button'>";
	echo "</FORM>";
?>
