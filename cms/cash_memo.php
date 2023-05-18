<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //$sno = $_POST['sno'];
  $cm_no = $_POST['cm_no'];
  $cm_date = $_POST['cm_date'];
  $cm_lr = $_POST['cm_lr'];
  $cm_freight = $_POST['cm_freight'];
  $cm_deliverycharges = $_POST['cm_deliverycharges'];
  $cm_labourcharges = $_POST['cm_labourcharges'];
  $cm_demurrage = $_POST['cm_demurrage'];
  $cm_othercharges = $_POST['cm_othercharges'];
  $cm_stcharges = $_POST['cm_stcharges'];
  $cm_doordel = $_POST['cm_doordel'];
  $cm_amount1 = $_POST['cm_amount1'];
  $cm_consignor = $_POST['cm_consignor'];
  $cm_consignee = $_POST['cm_consignee'];
  $cm_delivered = $_POST['cm_delivered'];
  $cm_remark = $_POST['cm_remark'];
  $transporter = $_POST['transporter'];
  $cm_cash_rec = $_POST['cm_cash_rec'];

    // Connecting to the Database
  $servername = "localhost";
     $username = "root";
     $password = "";
     $database = "cms_db";

  // Create a connection
  $conn = mysqli_connect($servername, $username, $password, $database);
  // Die if connection was not successful
  if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
  } else {
    // Submit these to a database
    $selectQuery = mysqli_query($conn, "SELECT cm_lr FROM cash_memo WHERE cm_lr='$cm_lr'");

    $selectRow = mysqli_fetch_array($selectQuery);
    // Get the first name

    if(!empty($selectRow)) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Cash Memo for this LR number is already exist!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
    } else {
      $sql = "INSERT INTO `cash_memo` (`cm_no`, `cm_date`, `cm_lr`, `cm_freight`, `cm_deliverycharges`, `cm_labourcharges`, `cm_demurrage`, `cm_othercharges`, `cm_stcharges`, `cm_doordel`, `cm_amount1`, `cm_consignor`,`cm_consignee`, `cm_delivered`, `cm_remark`, `transporter`, `cm_cash_rec`) VALUES ('', '$cm_date', '$cm_lr', '$cm_freight', '$cm_deliverycharges', '$cm_labourcharges', '$cm_demurrage', '$cm_othercharges', '$cm_stcharges', '$cm_doordel', '$cm_amount1', '$cm_consignor','$cm_consignee', '$cm_delivered', '$cm_remark', '$transporter', '$cm_cash_rec')";

      $result = mysqli_query($conn, $sql);
      if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been submitted successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
      } else {
        // echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Your entry was not submitted successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
      }
    }
  }

}
$branchesQuery = "SELECT * FROM `branches`";
$branchesColl = mysqli_query($conn, $branchesQuery);
date_default_timezone_set("Asia/Kolkata");
?>

<form method="post" action="/cms/index.php?page=cash_memo" >
  <div class="row g-4">
    <div class="col-md-2">
      <label for="cm_no" class="form-label form-control-sm">CM No.</label>
      <input type="text" name="cm_no" class="form-control form-control-sm" id="cm_no" readonly>
    </div>
    <div class="col-md-2">
      <label class="form-label form-control-sm"for="date6">Date</label>
      <input type="date" name="cm_date" class="form-control form-control-sm" id="cm_date" value="<?php echo date('Y-m-d');?>">
    </div>
    <div class="col-md-2">
    <label class="form-label form-control-sm"for="cm_lr">LR No.</label>
      <input type="text" name="cm_lr" class="form-control form-control-sm" id="cm_lr" onkeyup="GetDetail(this.value)" value="">
       </div>
    <hr class="border-primary">

    <!-- Article type -1 Start -->
    <div class="container">
      <div class="row">

        <div class="col-5">
          <div class="mb-3 row">
            <label for="cm_freight" class="col-sm-2 col-form-label form-control-sm">Freight</label>
            <div class="col-sm-3">
              <input type="text" name="cm_freight" class="form-control" id="cm_freight" value="" readonly>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="cm_deliverycharges" class="col-sm-2 col-form-label form-control-sm">Delivery Charges</label>
            <div class="col-sm-3">
              <input type="text" name="cm_deliverycharges" class="form-control" id="cm_deliverycharges" onkeyup="calculatecmamount()">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="cm_labourcharges" class="col-sm-2 col-form-label form-control-sm">Labour Charges</label>
            <div class="col-sm-4">
              <input type="text" name="cm_labourcharges" class="form-control" id="cm_labourcharges" onkeyup="calculatecmamount()">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="cm_demurrage" class="col-sm-2 col-form-label form-control-sm">Demurrage</label>
            <div class="col-sm-3">
              <input type="text" name="cm_demurrage" class="form-control" id="cm_demurrage" onkeyup="calculatecmamount()">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="cm_othercharges" class="col-sm-2 col-form-label form-control-sm">Other Charges</label>
            <div class="col-sm-3">
              <input type="text" name="cm_othercharges" class="form-control" id="cm_othercharges" onkeyup="calculatecmamount()">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="cm_stcharges" class="col-sm-2 col-form-label form-control-sm">Inc/St. Charges</label>
            <div class="col-sm-3">
              <input type="text" name="cm_stcharges" class="form-control" id="cm_stcharges" onkeyup="calculatecmamount()">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="cm_doordel" class="col-sm-2 col-form-label form-control-sm">Door Delivery</label>
            <div class="col-sm-3">
              <input type="text" name="cm_doordel" class="form-control" id="cm_doordel" onkeyup="calculatecmamount()">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="cm_amount1" class="col-sm-2 col-form-label form-control-sm">CM Amount</label>
            <div class="col-sm-4">
              <input type="text" name="cm_amount1" class="form-control" id="cm_amount1" value="" readonly>
            </div>
          </div>
        </div>
        <div class="col-1">
          <div class="d-flex" style="height: 425px;">
            <div class="vr"></div>
          </div>
        </div>
        <div class="col-6">
        <div class="row g-4">
          <div class="col-md-3">
          <label for="cm_lrdate" class="form-label form-control-sm">LR Date</label>
          <input type="text" name="cm_lrdate" class="form-control form-control-sm text-danger font-weight-bold" id="cm_lrdate" value="" readonly>
          </div>
          <div class="col-md-3">
          <label class="form-label form-control-sm"for="cm_unloading">Unloading</label>
          <input type="text" name="cm_unloading" class="form-control form-control-sm text-danger font-weight-bold" id="cm_unloading" value="" readonly>
          </div>
          </div>

          <div class="row g-4">
          <div class="col-md-3">
          <label for="cm_from" class="form-label form-control-sm">From</label>
          <input type="text" name="cm_from" class="form-control form-control-sm text-danger font-weight-bold" id="cm_from" value="" readonly>
          </div>
          <div class="col-md-3">
          <label class="form-label form-control-sm"for="cm_to">To</label>
          <input type="text" name="cm_to" class="form-control form-control-sm text-danger font-weight-bold" id="cm_to" value="" readonly>
          </div>
          </div>

          <div class="row g-4">
          <div class="col-md-6">
          <label for="cm_consignor" class="form-label form-control-sm">Consignor</label>
          <input type="text" name="cm_consignor" class="form-control form-control-sm text-danger font-weight-bold" id="cm_consignor" value="" readonly>
          </div>
          <div class="col-md-6">
          <label class="form-label form-control-sm"for="cm_consignee">Consignee</label>
          <input type="text" name="cm_consignee" class="form-control form-control-sm text-danger font-weight-bold" id="cm_consignee" value="" readonly>
          </div>
          </div>

          <div class="row g-4">
          <div class="col-md-2">
          <label for="cm_art1" class="form-label form-control-sm">Article</label>
          <input type="text" name="cm_art1" class="form-control form-control-sm text-danger font-weight-bold" id="cm_art1" value="" readonly>
          </div>
          <div class="col-md-3">
          <label for="cm_articletype1" class="form-label form-control-sm">#</label>
          <input type="text" name="cm_articletype1" class="form-control form-control-sm text-danger font-weight-bold" id="cm_articletype1" value="" readonly>
          </div>
          <div class="col-md-3">
          <label class="form-label form-control-sm"for="cm_wt">Wt.</label>
          <input type="text" name="cm_wt" class="form-control form-control-sm text-danger font-weight-bold" id="cm_wt" value="" readonly>
          </div>
          </div>

          <div class="row g-4">
          <div class="col-md-4">
          <label for="cm_content" class="form-label form-control-sm">Content</label>
          <input type="text" name="cm_content" class="form-control form-control-sm text-danger font-weight-bold" id="cm_content" value="" readonly>
          </div>
          </div>

          <div class="row g-4">
          <div class="col-md-3">
          <label for="cm_lr_total" class="form-label form-control-sm">LR Amount</label>
          <input type="text" name="cm_lr_total" class="form-control form-control-sm text-danger font-weight-bold" id="cm_lr_total" value="" readonly>
          </div>
          <div class="col-md-3">
          <label for="cm_freighttype" class="form-label form-control-sm">#</label>
          <input type="text" name="cm_freighttype" class="form-control form-control-sm text-danger font-weight-bold" id="cm_freighttype" value="" readonly>
          </div>
          <div class="col-md-3">
          <label class="form-label form-control-sm"for="cm_lrno">LR No.</label>
          <input type="text" name="cm_lrno" class="form-control form-control-sm text-danger font-weight-bold" id="cm_lrno" value="" readonly>
          </div>
          </div>
          </div>

        </div>
      </div>
    </div>
    <br>
    <hr class="border-primary">


    <div class="row g-4">
      <div class="col-md-2">
        <label for="cm_delivered" class="form-label form-control-sm">Delivered By</label>
        <input type="text" name="cm_delivered" class="form-control form-control-sm" id="cm_delivered">
      </div>
      <div class="col-md-3">
        <label for="cm_remark" class="form-label form-control-sm">Remarks</label>
        <input type="text" name="cm_remark" class="form-control form-control-sm" id="cm_remark">
      </div>
     </div>

     <div class="row g-4">
      <div class="col-md-2">
        <label for="transporter" class="form-label form-control-sm">Transporter</label>
        <input type="text" name="transporter" class="form-control form-control-sm" id="transporter">
      </div>


     <div class="col-md-2">
  <label class="form-label form-control-sm"for="">Cash Recieved</label>
  <select name="cm_cash_rec" id="cm_cash_rec" class="form-control form-control-sm">
    <option value="">Select</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
  </select>
</div>
<div class="form-row">
            <div class="col">
              <button type="submit" id='submit' name="submit" class="btn btn-primary " value="Save">Save</button>
              </div>
          </div>
</div>

</fieldset>
  </div>
</form>


  <script>

		// onkeyup event will occur when the user
		// release the key and calls the function
		// assigned to this event
		function GetDetail(str) {
      document.getElementById("cm_deliverycharges").value = "";
      document.getElementById("cm_demurrage").value = "";
      document.getElementById("cm_labourcharges").value = "";
      document.getElementById("cm_othercharges").value = "";
      document.getElementById("cm_stcharges").value = "";
      document.getElementById("cm_doordel").value = "";

      document.getElementById("cm_freight").value = "";
      document.getElementById("cm_amount1").value = "";
      document.getElementById("cm_lrdate").value = "";
      document.getElementById("cm_unloading").value = "";
      document.getElementById("cm_from").value = "";
      document.getElementById("cm_to").value = "";
      document.getElementById("cm_consignor").value = "";
      document.getElementById("cm_consignee").value = "";
      document.getElementById("cm_art1").value = "";
      document.getElementById("cm_articletype1").value = "";
      document.getElementById("cm_wt").value = "";
      document.getElementById("cm_content").value = "";
      document.getElementById("cm_lr_total").value = "";
      document.getElementById("cm_freighttype").value = "";
      document.getElementById("cm_lrno").value = "";

			if (str.length == 0) {
				document.getElementById("cm_freight").value = "";
        document.getElementById("cm_amount1").value = "";
        document.getElementById("cm_lrdate").value = "";
				document.getElementById("cm_unloading").value = "";
        document.getElementById("cm_from").value = "";
        document.getElementById("cm_to").value = "";
        document.getElementById("cm_consignor").value = "";
        document.getElementById("cm_consignee").value = "";
        document.getElementById("cm_art1").value = "";
				document.getElementById("cm_articletype1").value = "";
        document.getElementById("cm_wt").value = "";
        document.getElementById("cm_content").value = "";
        document.getElementById("cm_lr_total").value = "";
        document.getElementById("cm_freighttype").value = "";
        document.getElementById("cm_lrno").value = "";

				return;
			}
			else {
				// Creates a new XMLHttpRequest object
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function () {

					// Defines a function to be called when
					// the readyState property changes
					if (this.readyState == 4 &&
							this.status == 200) {

						// Typical action to be performed
						// when the document is ready
						var myObj = JSON.parse(this.responseText);

						// Returns the response data as a
						// string and store this array in
						// a variable assign the value
						// received to first name input field

						document.getElementById
							("cm_freight").value = myObj[0];

						// Assign the value received to
						// last name input field
						// document.getElementById
            //   ("cm_labourcharges").value = myObj[1];
            //   document.getElementById
            //   ("cm_othercharges").value = myObj[2];
            //   document.getElementById
            //   ("cm_stcharges").value = myObj[3];
            //   document.getElementById
            //   ("cm_doordel").value = myObj[4];
            //   document.getElementById
            //   ("cm_amount1").value = Number(myObj[0]) + Number(myObj[1]) + Number(myObj[2]) + Number(myObj[3]) + Number(myObj[4]);
            document.getElementById
            ("cm_amount1").value = Number(myObj[0]);
            document.getElementById
              ("cm_lrdate").value = myObj[1];
              document.getElementById
              ("cm_unloading").value = myObj[2];
              document.getElementById
              ("cm_from").value = myObj[3];
              document.getElementById
              ("cm_to").value = myObj[4];
              document.getElementById
              ("cm_consignor").value = myObj[5];
              document.getElementById
              ("cm_consignee").value = myObj[6];
              document.getElementById
              ("cm_articletype1").value = myObj[7];
              document.getElementById
              ("cm_art1").value = myObj[8];
              document.getElementById
              ("cm_wt").value = myObj[9];
              document.getElementById
              ("cm_content").value = myObj[10];
              document.getElementById
              ("cm_lr_total").value = myObj[11];
              document.getElementById
              ("cm_freighttype").value = myObj[12];
              document.getElementById
              ("cm_lrno").value = myObj[13];
              }
				};

				// xhttp.open("GET", "filename", true);
				xmlhttp.open("GET", "cashmemo_script.php?lrno=" + str, true);

				// Sends the request to the server
				xmlhttp.send();
			}
		}

		function calculatecmamount()
    {
      var fright = Number(document.getElementById('cm_freight').value);
      var deliverycharges = Number(document.getElementById('cm_deliverycharges').value);
      var labourcharges = Number(document.getElementById('cm_labourcharges').value);
      var demurrage = Number(document.getElementById('cm_demurrage').value);
      var otherchanges = Number(document.getElementById('cm_othercharges').value);
      var stcharges = Number(document.getElementById('cm_stcharges').value);
      var doordel = Number(document.getElementById('cm_doordel').value);
      var cmamount = fright+deliverycharges+labourcharges+demurrage+otherchanges+stcharges+doordel;
      if (!isNaN(cmamount)) {
        document.getElementById('cm_amount1').value = cmamount;
      }
    }
	</script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>

<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

