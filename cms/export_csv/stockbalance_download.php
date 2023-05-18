<?php
include "db_connect.php";
$filename = 'stock_balance_'.date('Ymd') .'.csv';

// POST values
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];

// Select query
$query = "SELECT * FROM new_parcel ORDER BY lrno asc";

if(isset($_POST['from_date']) && isset($_POST['to_date'])){
	$query = "SELECT * FROM new_parcel where date between '".$from_date."' and '".$to_date."' ORDER BY lrno asc";
}

$result = mysqli_query($con,$query);
$export_arr = array();

// file creation
$file = fopen($filename,"w");

// Header row - Remove this code if you don't want a header row in the export file.
$export_arr = array("lrno","date","manuallr","from1","to1","freighttype","consignor","consignee","articletype1","art1","wt1","rate1","per1","amount1","articletype2","art2","wt2","rate2","per2","amount2","articletype3","art3","wt3","rate3","per3","amount3","articletype4","art4","wt4","rate4","per4","amount4","freight1","labour_charges","st_charges","other_charges","pf","door_del","lr_total","content","actualwt","invoice","value","eway","madeby","remark");
fputcsv($file,$export_arr);
while($row = mysqli_fetch_assoc($result)){
  $lrno = $row['lrno'];
  $date = $row['date'];
  $manuallr = $row['manuallr'];
  $from1 = $row['from1'];
  $to1 = $row['to1'];
  $freighttype = $row['freighttype'];
  $consignor = $row['consignor'];
  $consignee = $row['consignee'];
  $articletype1 = $row['articletype1'];
  $art1 = $row['art1'];
  $wt1 = $row['wt1'];
  $rate1 = $row['rate1'];
  $per1 = $row['per1'];
  $amount1 = $row['amount1'];
  $articletype2 = $row['articletype2'];
  $art2 = $row['art2'];
  $wt2 = $row['wt2'];
  $rate2 = $row['rate2'];
  $per2 = $row['per2'];
  $amount2 = $row['amount2'];
  $articletype3 = $row['articletype3'];
  $art3 = $row['art3'];
  $wt3 = $row['wt3'];
  $rate3 = $row['rate3'];
  $per3 = $row['per3'];
  $amount3 = $row['amount3'];
  $articletype4 = $row['articletype4'];
  $art4 = $row['art4'];
  $wt4 = $row['wt4'];
  $rate4 = $row['rate4'];
  $per4 = $row['per4'];
  $amount4 = $row['amount4'];
  $freight1 = $row['freight1'];
  $labour_charges = $row['labour_charges'];
  $st_charges = $row['st_charges'];
  $other_charges = $row['other_charges'];
  $pf = $row['pf'];
  $door_del = $row['door_del'];
  $lr_total = $row['lr_total'];
  $content = $row['content'];
  $actualwt = $row['actualwt'];
  $invoice = $row['invoice'];
  $value = $row['value'];
  $eway = $row['eway'];
  $madeby = $row['madeby'];
  $remark = $row['remark'];


    // Write to file
  $export_arr = array($lrno,$date,$manuallr,$from1,$to1,$freighttype,$consignor,$consignee,$articletype1,$art1,$wt1,$rate1,$per1,$amount1,$articletype2,$art2,$wt2,$rate2,$per2,$amount2,$articletype3,$art3,$wt3,$rate3,$per3,$amount3,$articletype4,$art4,$wt4,$rate4,$per4,$amount4,$freight1,$labour_charges,$st_charges,$other_charges,$pf,$door_del,$lr_total,$content,$actualwt,$invoice,$value,$eway,$madeby,$remark);
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
