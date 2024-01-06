<?php


  $server = "localhost";
  $username = "root";
  $password = "";
  $database="mini";

  // Create a database connection
  $con = mysqli_connect($server, $username, $password,$database);

  // Check for connection success
  if(!$con){
      die("connection to this database failed due to" . mysqli_connect_error());
  }

function filterData(&$str){
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}

$fields = array('Transaction_id', 'Shop Name', 'Amount', 'Bill no');

$excelData = implode("\t", array_values($fields)) . "\n";

if(isset($_GET['ret_id'])){
    $sno=$_GET['ret_id'];
$query = "SELECT * FROM transaction where sno='$sno' ORDER BY trans_id asc";


$result = mysqli_query($con,$query);
while ($row = mysqli_fetch_assoc($result)) {
    array_walk($row, 'filterData');
    $excelData .= implode("\t", array_values($row)) . "\n";
}

}
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; Filename=MyData.xls");

echo $excelData;
exit;

?>
