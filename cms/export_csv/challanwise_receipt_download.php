<?php
include "db_connect.php";
$filename = 'challanwise_receipt_'.date('Ymd') .'.csv';

// POST values
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];

// Select query
$query = "SELECT * FROM loading_challan ORDER BY voucher_no asc";

if(isset($_POST['from_date']) && isset($_POST['to_date'])){
  $query = "SELECT * FROM loading_challan where date3 between '".$from_date."' and '".$to_date."' ORDER BY voucher_no asc";
}

$result = mysqli_query($con,$query);
$export_arr = array();

// file creation
$file = fopen($filename,"w");

// Header row - Remove this code if you don't want a header row in the export file.
$export_arr = array("voucher_no","date3","from2","to2","truck_no", "driver","license_no","supplier","owner","loading_by","remarks1","truck_rent","l_hamali","others1","total_a","advance","balance","date4","date5","total_lrs","article11","weight11","topay11","paid11","tbb11", "branches");
fputcsv($file,$export_arr);
while($row = mysqli_fetch_assoc($result)){
  $voucher_no = $row['voucher_no'];
  $date3 = $row['date3'];
  $from2 = $row['from2'];
  $to2 = $row['to2'];
  $truck_no = $row['truck_no'];
  $driver = $row['driver'];
  $license_no = $row['license_no'];
  $supplier = $row['supplier'];
  $owner = $row['owner'];
  $loading_by = $row['loading_by'];
  $remarks1 = $row['remarks1'];
  $truck_rent = $row['truck_rent'];
  $l_hamali = $row['l_hamali'];
  $others1 = $row['others1'];
  $total_a = $row['total_a'];
  $advance = $row['advance'];
  $balance = $row['balance'];
  $date4 = $row['date4'];
  $date5 = $row['date5'];
  $total_lrs = $row['total_lrs'];
  $article11 = $row['article11'];
  $weight11 = $row['weight11'];
  $topay11 = $row['topay11'];
  $paid11 = $row['paid11'];
  $tbb11 = $row['tbb11'];
  $branches = $row['branches'];

  // Write to file
  $export_arr = array($voucher_no,$date3,$from2,$to2,$truck_no,$driver,$license_no,$supplier,$owner,$loading_by,$remarks1,$truck_rent,$l_hamali,$others1,$total_a,$advance,$balance,$date4,$date5,$total_lrs,$article11,$weight11,$topay11,$paid11,$tbb11,$branches);
  fputcsv($file,$export_arr);
}

fclose($file);

// download
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Type: application/csv; ");

readfile($filename);

// deleting file
unlink($filename);
exit();
