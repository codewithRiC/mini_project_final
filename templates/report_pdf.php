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
if(isset($_POST['generate_pdf'])){
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}


    $fromDate = $_POST['from'];
    $toDate = $_POST['to'];

    $fields = array('Transaction_id', 'date', 'Amount', 'Bill no');

    $pdf = new TCPDF();
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('times', '', 12);

    // Add table headers
    $pdf->SetFillColor(200, 220, 255);
    foreach ($fields as $field) {
        $pdf->Cell(30, 10, $field, 1, 0, 'C', 1);
    }
    $pdf->Ln();

    $query = "SELECT * FROM transaction WHERE date BETWEEN '$fromDate' AND '$toDate' ORDER BY trans_id asc";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        array_walk($row, 'filterData');
        $pdf->Cell(30, 10, $row['trans_id'], 1);
        $pdf->Cell(30, 10, $row['date'], 1);
        $pdf->Cell(30, 10, $row['amount'], 1);
        $pdf->Cell(30, 10, $row['bill_no'], 1);
        $pdf->Ln();
    }

    // Output PDF to browser
    $pdf->Output('Report.pdf', 'D');

    // Close the database connection
    mysqli_close($con);
    exit;
}

if(isset($_POST['generate_excel'])){
    function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}


    $fromDate = $_POST['from'];
    $toDate = $_POST['to'];

    $fields = array('Transaction_id', 'date', 'Amount', 'Bill no');

    $excelData = implode("\t", array_values($fields)) . "\n";



$query ="SELECT * FROM transaction WHERE date BETWEEN '$fromDate' AND '$toDate' ORDER BY trans_id asc";
$result = mysqli_query($con,$query);
while ($row = mysqli_fetch_assoc($result)) {
    array_walk($row, 'filterData');
    $excelData .= implode("\t", array_values($row)) . "\n";
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; Filename=MyData.xls");

echo $excelData;
exit;

}
?>

