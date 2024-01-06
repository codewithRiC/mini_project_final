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

$fields = array('Transaction_id', 'date', 'Amount', 'Bill no');

$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();

// Set font
$pdf->SetFont('times', '', 12);

// Add table headers
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(30, 10, $fields[0], 1, 0, 'C', 1);
$pdf->Cell(40, 10, $fields[1], 1, 0, 'C', 1);
$pdf->Cell(30, 10, $fields[2], 1, 0, 'C', 1);
$pdf->Cell(30, 10, $fields[3], 1, 1, 'C', 1);

if(isset($_GET['ret_id'])){
    $sno=$_GET['ret_id'];
$query = "SELECT * FROM transaction where sno='$sno' ORDER BY trans_id asc";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($result)) {
    array_walk($row, 'filterData');
    $pdf->Cell(30, 10, $row['trans_id'], 1);
    $pdf->Cell(40, 10, $row['date'], 1);
    $pdf->Cell(30, 10, $row['amount'], 1);
    $pdf->Cell(30, 10, $row['bill_no'], 1, 1);
}

}
// Output PDF to browser
$pdf->Output('MyData.pdf', 'D');

// Close the database connection
mysqli_close($con);
exit;
?>
