<?php

// Get the user id
$lrno = $_REQUEST['lrno'];

// Database connection
$con = mysqli_connect("localhost", "root", "", "cms_db");

if ($lrno !== "") {
	
	// Get corresponding first name and
	// last name for that user id	
	$query = mysqli_query($con, "SELECT freight1, lr_total FROM new_parcel WHERE lrno='$lrno'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$freight1 = $row["freight1"];

	// Get the first name
	$lr_total = $row["lr_total"];
}

// Store it in a array
$result = array("$freight1", "$lr_total");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>