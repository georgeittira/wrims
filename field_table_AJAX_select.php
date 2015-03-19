<?php
include ("configdb.php");
$text = $_REQUEST['text'];
$text = explode(',',$text);
$field = $_REQUEST['field'];
$field = explode(',',$field);
$table = $_REQUEST['table'];
$iter = $_REQUEST['iter'];
$i =1;
$response = "";
$sql = "select DISTINCT `" . $field[0]."` from `".$table."` where `".$field[0]."` LIKE '" . $text[0] . "%'";
while($i <= $iter){
    if($text[$i] == "");
    else
        $sql .= (" AND `". $field[$i]. "`='".$text[$i]."' ");
    $i +=1;
}
$sql .= ";";
//$response = $sql ;
$result=$conn->query($sql);
if($result){
if ($result->num_rows >0)
{
    while ($row = $result->fetch_assoc()){
    $response .= $row[$field[0]];
    $response .= "\n";
    }
}
}
    echo $response;
    //echo mysqli_error($conn);
?>