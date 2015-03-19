 <HTML>

<head>
 </head>
 <BODY topmargin="1" bgcolor="#C0C0C0">

<link rel='stylesheet' type='text/css' href='css/style_ecn.css'>

<H4 align=center><u>Wire Route Information (WRI)for Field Change Notice (FCN) </u><H4>

<?php
 session_start();
	$d = date("Y");
	$fcn_no = $_REQUEST['forWRI'];
	$u       = $_SESSION["EMP"];
	$ag      = $_SESSION['Agency'];
	include ("configdb.php");
	//require_once("DCMS/common.php");
	//include ("DCMS/uploadFile.inc.html");
   	$sql = "select max(wri_no) from wri_list";
	$result1=$conn-> query($sql);
    $row1 = $result1->fetch_assoc();
    $max1 = $row1["max(wri_no)"];
	if ( ! $max1 ) {
		$max1 = 1;
	}
	else {
	$max1 = $max1+1;
	}
	echo "<script src = 'field_table_AJAX_select.js'></script>"; //include this for AJAX field function.
 	$sql1 = "select * from ecn_fcn_list where ecn_fcn_no = '$fcn_no' ";
	$result1=$conn-> query($sql1);
	$row1 = $result1->fetch_assoc();
	$title = $row1["title"];
    $fcn_key  = $row1["ecn_fcn_key"];
		
	$sql2 = "select e.*, b.* from  emp_data e, emp_boss b where e.emp_no = '$u' and e.emp_no = b.emp_no";
    $result2=$conn-> query($sql2);
	$row2 = $result2->fetch_assoc();
	$prepd_by = $row2["emp_chq_name"];
    $prepd_by_desig = $row2["emp_desig"];
	$boss = $row2["emp_report_to"];
	
	$sql3="select e.*, a.* from  emp_data e, mast_agency a where a.ag_desc = '$boss' and e.emp_no = a.ag_empno";
    $result3=$conn-> query($sql3);
	$row3 = $result3->fetch_assoc();
	$boss_name = $row3["emp_chq_name"];
	$boss_desig = $row3["ag_desc"];
	
    $sql4="select e.*, a.* from  emp_data e, mast_agency a where a.ag_desc = 'TSS' and e.emp_no = a.ag_empno";
   	$result4=$conn-> query($sql4);
	$row4 = $result4->fetch_assoc();
	$TSS = $row4["emp_chq_name"];
	
	$sql5="select e.*, a.* from  emp_data e, mast_agency a where a.ag_desc = 'CS' and e.emp_no = a.ag_empno";
   	$result5=$conn-> query($sql5);
	$row5 = $result5->fetch_assoc();
	$CS = $row5['emp_chq_name'];
	
	$_SESSION["upDocType"]	= 'WRI';
	$_SESSION["upDocNo"] 	= $max1;
	$_SESSION["upby"]	    = $u ;
	$_SESSION["upbydesig"] 	= $ag;
   	
		echo "<table width = 100%  border =1 cellspacing=0 cellpadding=2 bordercolor=white
				bordercolorlight=gray style = border-collapse:collapse;>";
		echo "<th>WRI No.</th>";
		echo "<td align=center>";
		echo "<b><font color=red>:- ";
		echo "$max1</b></font></td>";
		echo "<th> Applicable for</th>";
		$sql6 =" select * from mast_unit where unit_id in (1,2,12,99) order by unit_id";
		$result6=$conn-> query($sql6);
		echo "<td><SELECT NAME='units[]'  multiple size=4>";
		if ($result6->num_rows > 0) {
		while ($row6 = $result6->fetch_assoc()){	  
		
			$c = $row6["unit_id"];
			$v = $row6["unit_desc"];
			if ($v) {
			    echo "<option VALUE='$c'>$v </option>";
			}
			    }
		}
		echo "</select></td>";
		
		echo "<th>Issued to :- </th>";
		$sql7 =" select * from mast_agency where ag_desc like 'SME%' order by ag_desc";
		$result7=$conn-> query($sql7);
		
		echo "<td><select name ='issue_to[]' multiple size=4> ";
		if ($result7->num_rows > 0) {
		while ($row7 = $result7->fetch_assoc()){
		
				$c = $row7["ag_desc"];
				$v1 = $row7["ag_desc"];
				if ($v1) {
			 	   echo "<OPTION VALUE='$c'>$v1 </option>";
				}
	     	  }
		}
		echo "</select>";
		echo "</td>";
        echo "<th>Issued with ref.to FCN</th>";
		echo "<td>";
        echo "$fcn_no";
		echo "</td>";
		echo "<th>FCN Title</th>";
		echo "<td>";
        echo "$title";
		echo "</td>";
        echo "</table>";
		echo "<table border=0 width=100% cellspacing=0 cellpadding=0>";
		echo "<tr><td align=right>";
		echo "<a href='javascript:openAttach()'>Attach documents</a>";
	 	echo "</td></tr></table>";
 		
	$wri_sql = "select * from master_wri where ecn_fcn_key='$fcn_key'";
	$result_wri=$conn-> query($wri_sql);
	  echo "<h3 align ='center'><font color=purple>Wire Route Information</font></h3>";
  	  echo "<table width = 100%  border =1 cellspacing=0 cellpadding=2 bordercolor=white bordercolorlight=gray style=border-collapse:collapse;>";
	  echo "<th>WRI Key</th>";
	  echo "<th>Unit</th>";
	  echo "<th>From</th>";
	  echo "<th>Wire No.</th>";
	  echo "<th>Cable No.</th>";
	  echo "<th>Cable Binder</th>";
	  echo "<th>Colour Code</th>";
      echo "<th>Change cable</th>";
	  echo "<th>Destination</th>";
	  echo "<th>Remarks</th>";
      echo "<th>Drawing No.</th>";
	  echo "<th>Edit</th>";
      echo "<th>Delete</th>";
	    if ($result_wri->num_rows > 0) {
		while ($row = $result_wri->fetch_assoc()){
		$i = $row["wri_key"];
	 	echo "<tr>";
		echo "<td id = 'wri_key#".$i."'>";
		echo $row["wri_key"];
		echo "</td><td id = 'unit#".$i."'>";
		echo  $row["unit"];
		echo "</td><td id = 'unique_id_from#".$i."'>";
		echo  $row["unique_id_from"];
		echo "</td><td id = 'wire_no#".$i."'>";		
		echo  $row["wire_no"];
		echo "</td><td id = 'cable_no#".$i."'>";		
		echo  $row["cable_no"];
		echo "</td><td id = 'cable_binder#".$i."'>";			
		echo  $row["cable_binder"];
		echo "</td><td id = 'color_code#".$i."'>";	
		echo  $row["color_code"];
        echo "</td><td id = 'cable_mod#".$i."'>";	
		echo  $row["cable_mod"];
		echo "</td><td id = 'destination#".$i."'>";		
		echo  $row["destination"];
		echo "</td><td id = 'remarks#".$i."'>";
		echo  $row["remarks"];
		echo "</td><td id = 'drawing_no#".$i."'>";
		echo  $row["drawing_no"];
		echo "</td><td>";
		echo "<button id = 'edit#".$i."' onclick = 'editHandler(this,0)'>Edit</button>";
		echo "</td><td>";
		echo "<button id = 'delete#".$i."' onclick = 'editHandler(this,-1)'>Delete</button>";
		echo "</td></tr>";
		}
	}
	echo "</table>";
	
	$wri_sql = "select * from master_wri ";
	$result_wri=$conn-> query($wri_sql);
	  echo "<h3 align ='center'><font color=purple>Add/Delete/Edit row</font></h3>";
	  echo "<form method='post' action='#'>";
	  echo "<table width = 100%  border =1 cellspacing=0 cellpadding=2 bordercolor=white bordercolorlight=gray style=border-collapse:collapse;>";
	  echo "<th>Unit</th>";
      echo "<th>USI</th>";
      echo "<th>Type</th>";
      echo "<th>Type No.</th>";
      echo "<th>Strip No.</th>";
      echo "<th>TL No.</th>";
	  echo "<th>From Terminal</th>";
	  echo "<th>Wire No.</th>";
	  echo "<th style = 'width: 30px;'>Cable No.</th>";
	  echo "<th style = 'width: 30px;'>Binder </th>";
	  echo "<th>Colour Code</th>";
      echo "<th>Change cable</th>";
      echo "<th>USI</th>";
      echo "<th>Type</th>";
      echo "<th>Type No.</th>";
      echo "<th>Strip No.</th>";
      echo "<th>TL No.</th>";
	  echo "<th>Destination Terminal</th>";
	  echo "<th>Remarks</th>";
	  echo "<th>Drawing No.</th>";
	    //if ($result_wri->num_rows ()) {
		$row = $result_wri->fetch_assoc();
	 	echo "<tr>";
		$sql6 =" select * from mast_unit where unit_id in (1,2,12,99) order by unit_id";
		$result6=$conn-> query($sql6);
		echo "<td><SELECT NAME='unit'  multiple size=3>";
		if ($result6->num_rows > 0) {
		while ($row6 = $result6->fetch_assoc()){	  
		
			$c2 = $row6["unit_id"];
			$v2 = $row6["unit_desc"];
			if ($v2) {
			    echo "<OPTION VALUE='$c2'>$v2</option>";
			}
			    }
		}
		echo "</select>";
		echo "</td><td valign = 'top'>";
		echo "<input id = 'check' name= 'check' type = 'hidden' value = '1'></input>";
		echo "<input id = 'wri_key' name= 'wri_key' type = 'hidden' value = '-1'></input>";
        echo "<input name = 'usi_from' id = 'usi,master_tl,0' type = 'text' onkeyup = 'get_data(value,id,name,0,0)' style = 'width: 40px;'></input><br />";
        echo "<select id = 'usi_from_sel' onclick='update_input(this)' style = 'width: 40px;'></select>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'type_from' id = 'type,master_tl,0' type = 'text' onkeyup = 'get_data(value,id,name,1,0)' style = 'width: 50px;'></input><br />";
        echo "<select id = 'type_from_sel' onclick='update_input(this)'></select>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'type_id_from' id = 'type_id,master_tl,0' type = 'text' onkeyup = 'get_data(value,id,name,2,0)' style = 'width: 50px;'></input><br />";
        echo "<select id = 'type_id_from_sel' onclick='update_input(this)'></select>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'strip_from' id = 'strip_id,master_tl,0' type = 'text' onkeyup = 'get_data(value,id,name,3,0)' style = 'width: 50px;'></input><br />";
        echo "<select id = 'strip_from_sel' onclick='update_input(this)' style = 'width: 50px;'></select>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'tl_no_from' id = 'tl_no,master_tl,0' type = 'text' onkeyup = 'get_data(value,id,name,4,0)' style = 'width: 50px;'></input><br />";
        echo "<select id = 'tl_no_from_sel' onclick='update_input(this)'></select>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'unique_id_from' id = 'unique_id,master_tl,0' type = 'text' onkeyup = 'get_data(value,id,name,5,0)' style = 'width: 150px;'></input><br />";
        echo "<select id = 'unique_id_from_sel' onclick='update_input(this)'></select>";
		echo "</td><td valign = 'top'>";		
		echo "<input type='text' name = 'wire_no' id = 'wire_no' style = 'width: 70px;'>";
        echo "</input>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'cable_no' id = 'cable_no,master_cable_schedule,0' type = 'text' onkeyup = 'get_data(value,id,name,0,0)' style = 'width: 60px;'></input><br />";
        echo "<select id = 'cable_no_sel' onclick='update_input(this)'></select>";
        echo "</td><td valign = 'top'>";
        echo "<select name = 'cable_binder' size=1 style = 'width: 50px;'><option value=''> </option>";
        echo "<option value='BL-BD'>BL-BD</option>";
		echo "<option value='RD-BD'>RD-BD</option></select>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'color_code' id = 'col_code,cable_col_code,0' type = 'text' onkeyup = 'get_data(value,id,name,0,0)' style = 'width: 50px;'></input><br />";
        echo "<select id = 'color_code_sel' onclick='update_input(this)'></select>";
		echo "</td><td valign = 'top'>";
        echo "<select name = 'cable_mod' size=1 style = 'width: 50px;'><option value=''> </option>";
       	echo "<option value='yes'>yes</option></select>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'usi_destination' id = 'usi,master_tl,1' type = 'text' onkeyup = 'get_data(value,id,name,0,1)' style = 'width: 40px;'></input><br />";
        echo "<select id = 'usi_destination_sel' onclick='update_input(this)'></select>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'type_destination' id = 'type,master_tl,1' type = 'text' onkeyup = 'get_data(value,id,name,1,1)' style = 'width: 50px;'></input><br />";
        echo "<select id = 'type_destination_sel' onclick='update_input(this)'></select>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'type_id_destination' id = 'type_id,master_tl,1' type = 'text' onkeyup = 'get_data(value,id,name,2,1)' style = 'width: 50px;'></input><br />";
        echo "<select id = 'type_id_destination_sel' onclick='update_input(this)'></select>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'strip_destination' id = 'strip_id,master_tl,1' type = 'text' onkeyup = 'get_data(value,id,name,3,1)' style = 'width: 50px;'></input><br />";
        echo "<select id = 'strip_destination_sel' onclick='update_input(this)'></select>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'tl_no_destination' id = 'tl_no,master_tl,1' type = 'text' onkeyup = 'get_data(value,id,name,4,1)' style = 'width: 50px;'></input><br />";
        echo "<select id = 'tl_no_destination_sel' onclick='update_input(this)'></select>";
        echo "</td><td valign = 'top'>";
        echo "<input name = 'unique_id_destination' id = 'unique_id,master_tl,1' type = 'text' onkeyup = 'get_data(value,id,name,5,1)' style = 'width: 150px;'></input><br />";
        echo "<select id = 'unique_id_destination_sel' onclick='update_input(this)'></select>";
		echo "</td><td valign = 'top'>";
		echo "<select name = 'remarks' size=1 style = 'width: 75px;'><option value='Addition'>Addition</option>";
       	echo "<option value='Deletion'>Deletion</option></select>";
		echo "</td><td valign = 'top'>";
		echo "<input name = 'drawing_no' id = 'drawing_no,drawing_schedule,0' type = 'text' onkeyup = 'get_data(value,id,name,0,0)' style = 'width: 120px;'></input><br />";
        echo "<select id = 'drawing_no_sel' onclick='update_input(this)'></select>";
		echo "</td></tr>";
		
	//}
	echo "</table>";
    echo "<input type=submit value='Update Changes' class='button'>";
	echo "</form>";
	echo "<a href = './wri_save.php?doc_no=$max1&fcn_key=$fcn_key&prepd_by=$prepd_by&prepd_by_desig=$prepd_by_desig&boss_desig=$boss_desig'>Save and Exit!</a>";
     
    if(isset($_POST['unique_id_from']) && $_POST['unique_id_from'] != "" && $_POST['wri_key'] == -1 && $_POST['check'] == 1){
		$sql = "INSERT INTO `master_wri`( `unit`, `unique_id_from`, `wire_no`, `cable_no`, `cable_binder`, `color_code`, `destination`, `drawing_no`, `remarks`, `ecn_fcn_key`, `cable_mod`) VALUES ('$_POST[unit]','$_POST[unique_id_from]','$_POST[wire_no]','$_POST[cable_no]','$_POST[cable_binder]','$_POST[color_code]','$_POST[unique_id_destination]','$_POST[drawing_no]','$_POST[remarks]','$fcn_key','$_POST[cable_mod]')";
    }
	if(isset($_POST['unique_id_from']) && $_POST['unique_id_from'] != "" && $_POST['wri_key'] > -1 && $_POST['check'] == 0){
		$sql = "UPDATE `master_wri` SET `unit` ='$_POST[unit]',`unique_id_from`='$_POST[unique_id_from]',`wire_no`='$_POST[wire_no]',`cable_no`='$_POST[cable_no]',`cable_binder`='$_POST[cable_binder]',`color_code`='$_POST[color_code]',`destination`='$_POST[unique_id_destination]',`drawing_no`='$_POST[drawing_no]',`remarks`='$_POST[remarks]',`ecn_fcn_key`='$fcn_key',`cable_mod`='$_POST[cable_mod]'  WHERE `wri_key` = '$_POST[wri_key]'";	
    }
	if(isset($_POST['check'])  && $_POST['wri_key'] > -1 && $_POST['check'] == -1){
		$sql = "DELETE FROM `master_wri` WHERE `wri_key`='$_POST[wri_key]'";
	}
	$result = $conn->query($sql);
    if(!$result)
         echo mysqli_error($conn);
   
    
?>
</table>
</body>
</html>