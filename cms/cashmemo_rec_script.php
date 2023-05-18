<?php

// Get the user id
$cm_no = $_REQUEST['cm_no'];

// Database connection
$con = mysqli_connect("localhost", "root", "", "cms_db");

if ($cm_no !== "") {

  // last name for that user id

  $query = mysqli_query($con, "SELECT cm_no, cm_date, cm_amount1, cm_consignor, cm_consignee FROM cash_memo WHERE cm_no='$cm_no'");

  $row = mysqli_fetch_array($query);

  // Get the first name
  $cmr_amount = $row["cm_amount1"];

  // Get the first name
  $cmr_consignor = $row["cm_consignor"];
  $cmr_consignee = $row["cm_consignee"];
  $date8 = date("d-m-Y", strtotime($row['cm_date']));
  $cmr_total = $row["cm_amount1"];

}

// Store it in a array
$result = array("$cmr_amount","$cmr_consignor","$cmr_consignee","$date8","$cmr_total");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>
