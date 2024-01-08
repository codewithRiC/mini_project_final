<?php

require_once('TCPDF/tcpdf.php');

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
// Fetch shop information from retailer table
$shopQuery = "SELECT shop_name, ret_add, ret_phn ,ret_type FROM retailer WHERE sno = $sno"; 
$shopResult = mysqli_query($con, $shopQuery);
$shopData = mysqli_fetch_assoc($shopResult);

$shopName = $shopData['shop_name'];
$shopAddress = $shopData['ret_add'];
$shopPhoneNumber = $shopData['ret_phn'];
$shoptype =$shopData['ret_type'];

$fields = array('S.No', 'Trans_id', 'Date', 'Amount', 'Bill No', 'Trans_Type');

$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();

$pdf->SetFont('times', 'B', 20);
$pdf->Cell(0, 10, "Company Name: UTKAL AGENCY", 0, 1, 'C');

$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, "Shop Name: $shopName", 0, 1, 'C');

$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 10, "Add: $shopAddress", 0, 1, 'C');

$pdf->SetFont('courier', '', 12);

// Assuming $shopPhoneNumber is a numeric phone number

$pdf->Cell(0, 10, "Phone number: $shopPhoneNumber", 0, 1, 'C');


$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 10, "Shop Type: $shoptype", 0, 1, 'C');

$pdf->Ln();

$pdf->SetFont('times', '', 12);

$pdf->SetFillColor(200, 220, 255);
foreach ($fields as $field) {
    $pdf->Cell(25, 10, $field, 1, 0, 'C', 1);
}
$pdf->Ln();

$query = "SELECT t.trans_id, r.shop_name, t.date, t.amount, t.bill_no, t.trans_type
          FROM transaction t
          JOIN retailer r ON t.sno = r.sno
          WHERE r.sno = $sno
          ORDER BY t.trans_id ASC";

    $result = mysqli_query($con, $query);
    $srno = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        array_walk($row, 'filterData');
        $pdf->Cell(25, 10, $srno++, 1);
        $pdf->Cell(25, 10, $row['trans_id'], 1);
        $pdf->Cell(25, 10, $row['date'], 1);
        $pdf->Cell(25, 10, $row['amount'], 1);
        $pdf->Cell(25, 10, $row['bill_no'], 1);
        $pdf->Cell(25, 10, $row['trans_type'], 1);

        $pdf->Ln();  
    }
}

// Output PDF to browser
$pdf->Output('Report.pdf', 'D');

// Close the database connection
mysqli_close($con);
exit;
?>
