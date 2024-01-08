<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "mini";

// Create a database connection
$con = mysqli_connect($server, $username, $password, $database);

// Check for connection success
if (!$con) {
    die("Connection to this database failed due to" . mysqli_connect_error());
}

function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}


if (isset($_GET['ret_id'])) {
    $sno = $_GET['ret_id'];

    $shopQuery = "SELECT shop_name, ret_add, ret_phn, ret_type FROM retailer WHERE sno = $sno";
    $shopResult = mysqli_query($con, $shopQuery);
    $shopData = mysqli_fetch_assoc($shopResult);

    $shopName = $shopData['shop_name'];
    $shopAddress = $shopData['ret_add'];
    $shopPhoneNumber = $shopData['ret_phn'];
    $shoptype = $shopData['ret_type'];

    $excelData = "Company Name: UTKAL AGENCY\n";
    $excelData .= "Shop Name : $shopName\n";
    $excelData .= "Add : $shopAddress\n";
    $excelData .= "Phone Number : $shopPhoneNumber\n";
    $excelData .= "Type : $shoptype\n\n";

    $fields = array('Trans_id', 'Date', 'Amount', 'Bill No', 'Trans_Type');

$excelData .= implode("\t", array_values($fields)) . "\n";


    $query = "SELECT t.trans_id,  t.date, t.amount, t.bill_no, t.trans_type
              FROM transaction t
              JOIN retailer r ON t.sno = r.sno
              WHERE r.sno = $sno
              ORDER BY t.trans_id ASC";

    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        array_walk($row, 'filterData');
        $excelData .= implode("\t", array_values($row)) . "\n";
    }
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; Filename=Report.xls");

echo $excelData;
exit;
?>
