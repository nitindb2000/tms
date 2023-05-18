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
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  //$sno = $_POST['sno'];
  $cmr_receipt_no = $_POST['cmr_receipt_no'];
  $cmr_date = $_POST['cmr_date'];
  $cmr_cmno = $_POST['cmr_cmno'];
  $cmr_amount = $_POST['cmr_amount'];
  $cmr_wr_amount = $_POST['cmr_wr_amount'];
  $cmr_paymode = $_POST['cmr_paymode'];
  $cmr_ref_chq = $_POST['cmr_ref_chq'];
  $cmr_remark = $_POST['cmr_remark'];
  $cmr_cash = $_POST['cmr_cash'];
  // Connecting to the Database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "cms_db";

  // Create a connection
  $conn = mysqli_connect($servername, $username, $password, $database);
  // Die if connection was not successful
  if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
  }
  else{
    $writeOffAmount = $_POST['cmr_wr_amount'];
    $cmrCmno = $_POST['cmr_cmno'];
    $cmrPaymode = $_POST['cmr_paymode'];
    $cmrRefChq = $_POST['cmr_ref_chq'];
    $cmrRemark = $_POST['cmr_remark'];
    $cmrCash = $_POST['cmr_cash'];
    $selectQuery = $conn->query("SELECT * FROM cash_memo where cm_no=$cmrCmno");
    while ($selectCmrCmno = $selectQuery->fetch_assoc()) {
      $cmrCmnoValue = $selectCmrCmno['cm_no'];
      if($_POST['cmr_paymode'] == "")
      {
        $cmrPaymode = "";
        $cmrPaymode = $selectCmrCmno['cmr_paymode'];
      }
      if($_POST['cmr_ref_chq'] == "")
      {
        $cmrRefChq = "";
        $cmrRefChq = $selectCmrCmno['cmr_ref_chq'];
      }
      if($_POST['cmr_remark'] == "")
      {
        $cmrRemark = "";
        $cmrRemark = $selectCmrCmno['cmr_remark'];
      }
      if($_POST['cmr_cash'] == "")
      {
        $cmrCash = "";
        $cmrCash = $selectCmrCmno['cmr_cash'];
      }
    }
    if($_POST['cmr_amount'] != ""){
      if($cmrCmnoValue != ""){
        $sql = "UPDATE cash_memo SET cmr_wr_amount = '".$writeOffAmount."',cmr_paymode = '".$cmrPaymode."',cmr_ref_chq = '".$cmrRefChq."',cmr_remark = '".$cmrRemark."',cmr_cash =  '".$cmrCash."',delivery_status = 1 WHERE cm_no ='".$cmrCmno."' ";
        //echo $sql;die;
        $result = mysqli_query($conn, $sql);
        if($result){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been submitted successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        }
        else{
          // echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Your entry was not submitted successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        }
      } else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> C.M. No is not valid!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        /*$sql = "INSERT INTO `cashmemo_rec` (`cmr_receipt_no`, `cmr_date`, `cmr_cmno`, `cmr_amount`, `cmr_wr_amount`, `cmr_paymode`, `cmr_ref_chq`, `cmr_remark`, `cmr_cash`) VALUES ('', '$cmr_date', '$cmr_cmno', '$cmr_amount', '$cmr_wr_amount', '$cmr_paymode', '$cmr_ref_chq', '$cmr_remark', '$cmr_cash')";
        $result = mysqli_query($conn, $sql);*/


      }
    } else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> C.M. No is not valid!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        /*$sql = "INSERT INTO `cashmemo_rec` (`cmr_receipt_no`, `cmr_date`, `cmr_cmno`, `cmr_amount`, `cmr_wr_amount`, `cmr_paymode`, `cmr_ref_chq`, `cmr_remark`, `cmr_cash`) VALUES ('', '$cmr_date', '$cmr_cmno', '$cmr_amount', '$cmr_wr_amount', '$cmr_paymode', '$cmr_ref_chq', '$cmr_remark', '$cmr_cash')";
        $result = mysqli_query($conn, $sql);*/


      }
  }

}
date_default_timezone_set("Asia/Kolkata");

?>

<form action="/cms/index.php?page=cash_memo_receipt" method="post">


  <!-- Article type -1 Start -->
  <div class="container">
    <div class="row">
      <div class="row g">
        <div class="col-6">

          <div class="row g-3">
            <div class="col-md-3">
              <label for="cmr_receipt_no" class="form-label form-control-sm">Receipt No.</label>
              <input type="text" name="cmr_receipt_no" class="form-control form-control-sm" id="cmr_receipt_no" readonly>
            </div>
            <div class="col-md-4">
              <label for="cmr_date" class="form-label form-control-sm">Date</label>
              <input type="date" name="cmr_date" class="form-control form-control-sm" id="cmr_date" value="<?php echo date('Y-m-d');?>">
            </div>

            <div class="col-md-3">
              <label for="cmr_cmno" class="form-label form-control-sm">C.M. No.</label>
              <input type="text" name="cmr_cmno" class="form-control form-control-sm" id="cmr_cmno" onkeyup="GetDetail(this.value)" value="">
            </div>
            <div class="col-md-4">
              <label for="cmr_amount" class="form-label form-control-sm">Received Amount</label>
              <input type="text" name="cmr_amount" class="form-control form-control-sm" id="cmr_amount" value="" readonly>
            </div>
            <div class="col-md-4">
              <label for="cmr_wr_amount" class="form-label form-control-sm">Write-Off Amount</label>
              <input type="text" name="cmr_wr_amount" class="form-control form-control-sm" id="cmr_wr_amount">
            </div>

          </div>
        </div>
        <div class="col-1">
          <div class="d-flex" style="height: 150px;">
            <div class="vr"></div>
          </div>
        </div>
        <div class="col-5">
          <div class="row g-3">
            <div class="col-md-4">
              <label for="cmr_consignor" class="form-label form-control-sm">Consignor</label>
              <input type="text" name="cmr_consignor" class="form-control form-control-sm text-danger font-weight-bold" id="cmr_consignor" value="" readonly>
            </div>
            <div class="col-md-4">
              <label for="cmr_consignee" class="form-label form-control-sm">Consignee</label>
              <input type="text" name="cmr_consignee" class="form-control form-control-sm text-danger font-weight-bold" id="cmr_consignee" value="" readonly>
            </div>
          </div>
          <div class="row g-3">
            <div class="col-md-4">
              <label for="date8" class="form-label form-control-sm">Date</label>
              <input type="text" name="date8" class="form-control form-control-sm text-danger font-weight-bold" id="date8" value="" readonly>
            </div>

            <div class="col-md-4">
              <label for="cmr_total" class="form-label form-control-sm">Total</label>
              <input type="text" name="cmr_total" class="form-control form-control-sm text-danger font-weight-bold" id="cmr_total" value="" readonly>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <hr class="border-primary">

    <div class="row g-3">
      <div class="col-md-2">
        <label class="form-control-sm" for="">Payment Mode</label>
        <select name="cmr_paymode" id="cmr_paymode" class="form-control form-control-sm">
          <option value="">Select</option>
          <option value="RTGS">RTGS</option>
          <option value="Cash">Cash</option>
          <option value="Cheque">Cheque</option>
        </select>
      </div>


      <div class="col-md-2">
        <label for="cmr_ref_chq" class="form-label form-control-sm">Ref./Chq. No.</label>
        <input type="text" name="cmr_ref_chq" class="form-control form-control-sm" id="cmr_ref_chq">
      </div>

      <div class="col-md-2">
        <label for="cmr_remark" class="form-label form-control-sm">Remarks</label>
        <input type="text" name="cmr_remark" class="form-control form-control-sm" id="cmr_remark">
      </div>

      <div class="col-md-2">
        <label for="cmr_cash" class="form-label form-control-sm">Cash/Bank A/c</label>
        <input type="text" name="cmr_cash" class="form-control form-control-sm" id="cmr_cash">
      </div>


      <div class="container">
        <div class="form-row"><br>
          <div class="col">
            <button type="submit" id='submit' name="submit" class="btn btn-primary " value="Save">Save</button>
          </div>
        </div>
      </div>

      </fieldset>
    </div>

    <hr class="border-primary">

  </div>
  </div>
</form>

<script>

  // onkeyup event will occur when the user
  // release the key and calls the function
  // assigned to this event
  function GetDetail(str) {
    document.getElementById("cmr_amount").value = "";

    document.getElementById("cmr_consignor").value = "";
    document.getElementById("cmr_consignee").value = "";
    document.getElementById("date8").value = "";
    document.getElementById("cmr_total").value = "";

    if (str.length == 0) {
      document.getElementById("cmr_consignor").value = "";
      document.getElementById("cmr_consignee").value = "";
      document.getElementById("date8").value = "";
      document.getElementById("cmr_total").value = "";

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
          ("cmr_amount").value = myObj[0];
          document.getElementById
          ("cmr_consignor").value = myObj[1];
          document.getElementById
          ("cmr_consignee").value = myObj[2];
          document.getElementById
          ("date8").value = myObj[3];
          document.getElementById
          ("cmr_total").value = myObj[4];

        }
      };

      // xhttp.open("GET", "filename", true);
      xmlhttp.open("GET", "cashmemo_rec_script.php?cm_no=" + str, true);

      // Sends the request to the server
      xmlhttp.send();
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

