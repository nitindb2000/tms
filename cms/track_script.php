<?php

// Get the user id
$lrno = $_REQUEST['lrno'];

// Database connection
$con = mysqli_connect("localhost", "root", "", "cms_db");

if ($lrno !== "") {

  // Get corresponding first name and
  // last name for that user id
  $query = mysqli_query($con, "SELECT consignor, consignee FROM new_parcel WHERE lrno='$lrno'");

  $row = mysqli_fetch_array($query);

  // Get the first name
  $consignor = $row["consignor"];

  // Get the first name
  $consignee = $row["consignee"];
}

// Store it in a array
$result = array("$consignor", "$consignee");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>
