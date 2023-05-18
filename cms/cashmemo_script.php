<?php

// Get the user id
$lrno = $_REQUEST['lrno'];

// Database connection
$con = mysqli_connect("localhost", "root", "", "cms_db");

if ($lrno !== "") {

	// last name for that user id
  $cm_freight = "";
  $cm_labourcharges = "";
  $cm_othercharges = "";
  $cm_stcharges = "";
  $cm_doordel = "";
  $cm_amount1 = "";
  $cm_lrdate = "";
  $cm_unloading = "";
  $cm_from = "";
  $cm_to = "";
  $cm_consignor = "";
  $cm_consignee = "";
  $cm_articletype1 = "";
  $cm_art1 = "";
  $cm_wt = "";
  $cm_content = "";
  $cm_lr_total = "";
  $cm_freighttype = "";
  $cm_lrno = "";
	$query = mysqli_query($con, "SELECT freight1, labour_charges, other_charges, st_charges, door_del, lr_total,
	date, date, from1, to1, consignor, consignee, art1, articletype1, actualwt, content, freighttype,lrno,manuallr FROM new_parcel WHERE lrno='$lrno'");

	$row = mysqli_fetch_array($query);
	if(!empty($row) && $row["manuallr"] == 0){
    // Get the first name
    $cm_freight = $row["lr_total"];

    // Get the first name
    $cm_labourcharges = $row["labour_charges"];
    $cm_othercharges = $row["other_charges"];
    $cm_stcharges = $row["st_charges"];
    $cm_doordel = $row["door_del"];
    $cm_amount1 = $row["lr_total"];
    $cm_lrdate = date("d-m-Y", strtotime($row['date']));
    $cm_unloading = date("d-m-Y", strtotime($row['date']));
    $cm_from = $row["from1"];
    $cm_to = $row["to1"];
    $cm_consignor = $row["consignor"];
    $cm_consignee = $row["consignee"];
    $cm_articletype1 = $row["articletype1"];
    $cm_art1 = $row["art1"];
    $cm_wt = $row["actualwt"];
    $cm_content = $row["content"];
    $cm_lr_total = $row["lr_total"];
    $cm_freighttype = $row["freighttype"];
    $cm_lrno = $row["lrno"];
  } else {
    $manualLrQuery = mysqli_query($con, "SELECT freight1, labour_charges, other_charges, st_charges, door_del, lr_total,
	date, date, from1, to1, consignor, consignee, art1, articletype1, actualwt, content, freighttype,manuallr FROM new_parcel WHERE manuallr='$lrno'");

    $manualLrRow = mysqli_fetch_array($manualLrQuery);
    // Get the first name

    if(!empty($manualLrRow)) {
      // Get the first name
      $cm_freight = $manualLrRow["lr_total"];
      $cm_labourcharges = $manualLrRow["labour_charges"];
      $cm_othercharges = $manualLrRow["other_charges"];
      $cm_stcharges = $manualLrRow["st_charges"];
      $cm_doordel = $manualLrRow["door_del"];
      $cm_amount1 = $manualLrRow["lr_total"];
      $cm_lrdate = date("d-m-Y", strtotime($manualLrRow['date']));
      $cm_unloading = date("d-m-Y", strtotime($manualLrRow['date']));
      $cm_from = $manualLrRow["from1"];
      $cm_to = $manualLrRow["to1"];
      $cm_consignor = $manualLrRow["consignor"];
      $cm_consignee = $manualLrRow["consignee"];
      $cm_articletype1 = $manualLrRow["articletype1"];
      $cm_art1 = $manualLrRow["art1"];
      $cm_wt = $manualLrRow["actualwt"];
      $cm_content = $manualLrRow["content"];
      $cm_lr_total = $manualLrRow["lr_total"];
      $cm_freighttype = $manualLrRow["freighttype"];
      $cm_lrno = $manualLrRow["manuallr"];
    }
  }


}



// Store it in a array
$result = array("$cm_freight","$cm_lrdate","$cm_unloading","$cm_from","$cm_to","$cm_consignor","$cm_consignee","$cm_articletype1","$cm_art1","$cm_wt","$cm_content","$cm_lr_total","$cm_freighttype","$cm_lrno");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>
