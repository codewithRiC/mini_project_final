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

    $fields = array('S.No','Trans_id', 'Shop Name', 'Date', 'Amount', 'Bill No', 'Trans_Type');

    $pdf = new TCPDF();
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->AddPage();

    // Set font
 

    // Add decorative heading
    $pdf->SetFont('times', 'B', 20); // Set font to Times, bold, size 16
    $pdf->Cell(0, 10, 'Company Name:Utkal Agency', 0, 1, 'C');
    
    $pdf->SetFont('helvetica', 'B', 14); // Set font to Helvetica, bold, size 14
    $pdf->Cell(0, 10, 'Transaction Details', 0, 1, 'C');
    
    $pdf->SetFont('courier', '', 12); // Set font to Courier, regular, size 12
    $pdf->Cell(0, 10, "From: $fromDate To: $toDate", 0, 1, 'C');
   
    $pdf->Ln();
 
    $pdf->SetFont('times', '', 12);
    // Add table headers
    $pdf->SetFillColor(200, 220, 255);
    foreach ($fields as $field) {
        $pdf->Cell(25, 10, $field, 1, 0, 'C', 1);
    }
    $pdf->Ln();

    // Modify the query to join the 'transaction' and 'retailer' tables
    $query = "SELECT t.trans_id, r.shop_name, t.date, t.amount, t.bill_no, t.trans_type
              FROM transaction t
              JOIN retailer r ON t.sno = r.sno
              WHERE t.date BETWEEN '$fromDate' AND '$toDate'
              ORDER BY t.trans_id ASC";

    $result = mysqli_query($con, $query);
    $srno=1;
    while ($row = mysqli_fetch_assoc($result)) {
        array_walk($row, 'filterData');

        $pdf->Cell(25, 10, $srno++ , 1);
        $pdf->Cell(25, 10, $row['trans_id'], 1);
        $pdf->Cell(25, 10, $row['shop_name'], 1);
        $pdf->Cell(25, 10, $row['date'], 1);
        $pdf->Cell(25, 10, 'Rs' . number_format($row['amount'], 2), 1); // Assuming 'amount' is a numeric field
        $pdf->Cell(25, 10, $row['bill_no'], 1);
        $pdf->Cell(25, 10, $row['trans_type'], 1);
       
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

    $fields = array('Trans_id', 'Shop Name', 'Date', 'Amount', 'Bill No', 'Trans_Type', 'Remark');

    // Add heading with "Transaction Details" and date range
    $excelData = "Transaction Details\n";
    $excelData .= "From: $fromDate To: $toDate\n\n";
    $excelData .= implode("\t", array_values($fields)) . "\n";

    $query = "SELECT t.trans_id, r.shop_name, t.date, t.amount, t.bill_no, t.trans_type, t.remark
              FROM transaction t
              JOIN retailer r ON t.sno = r.sno
              WHERE t.date BETWEEN '$fromDate' AND '$toDate'
              ORDER BY t.trans_id ASC";

    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        array_walk($row, 'filterData');
        $excelData .= implode("\t", array_values($row)) . "\n";
    }

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; Filename=TransactionDetails.xls");

    echo $excelData;
    exit;
}

?>

