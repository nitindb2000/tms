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
// Connecting to the Database
$servername = "localhost";
  $username = "root";
  $password = "";
  $database = "cms_db";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

if(isset($_GET['voucherno']))
{
  if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
  }
  else {
    $voucherno = $_GET['voucherno'];
    $loadingChallanDetailsQuery = "SELECT * FROM loading_challan WHERE `voucher_no` = $voucherno";
    $loadingChallanDetails = mysqli_query($conn, $loadingChallanDetailsQuery);
  }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  //$sno = $_POST['sno'];
  $voucher_no = $_POST['voucher_no'];
  $unl_date = $_POST['unl_date'];
  $unl_from = $_POST['unl_from'];
  $unl_to = $_POST['unl_to'];
  $unl_challan_no = $_POST['unl_challan_no'];
  $unl_truck_no = $_POST['unl_truck_no'];
  $unl_driver = $_POST['unl_driver'];
  $unloading_by = $_POST['unloading_by'];
  $unl_remark = $_POST['unl_remark'];
  $unl_truckrent = $_POST['unl_truckrent'];
  $unl_hamali = $_POST['unl_hamali'];
  $unl_others = $_POST['unl_others'];
  $unl_advance = $_POST['unl_advance'];


  // Die if connection was not successful
  if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
  }
  else{
    // Submit these to a database

    $sql = "INSERT INTO `unloading_challan` (`voucher_no`, `unl_date`, `unl_from`, `unl_to`, `unl_challan_no`, `unl_truck_no`, `unl_driver`, `unloading_by`, `unl_remark`, `unl_truckrent`, `unl_hamali`, `unl_others`, `unl_advance`,`status`) VALUES ('$voucher_no', '$unl_date', '$unl_from', '$unl_to', '$unl_challan_no', '$unl_truck_no', '$unl_driver', '$unloading_by', '$unl_remark', '$unl_truckrent', '$unl_hamali', '$unl_others', '$unl_advance',1)";

    $result = mysqli_query($conn, $sql);

    if($result){
      $vouchernum=$_GET['voucherno'];
      if(isset($vouchernum)) {
        $updateNewParcelStatusSql = "UPDATE loading_challan SET unloading_status=1 WHERE voucher_no =$vouchernum ";
      }
      mysqli_query($conn, $updateNewParcelStatusSql);
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

  }

}

?>

<form action="" method="post">
  <?php
  $loadingChallanDetail = array();
  if(isset($loadingChallanDetails)){
    while($row = mysqli_fetch_array($loadingChallanDetails))
      $loadingChallanDetail[] = $row;
    foreach($loadingChallanDetail as $row){
      $loadingChallanDetail['voucher_no'] = $row['voucher_no'];
      $loadingChallanDetail['date3'] = $row['date3'];
      $loadingChallanDetail['from2'] = $row['from2'];
      $loadingChallanDetail['to2'] = $row['to2'];
      $loadingChallanDetail['truck_no'] = $row['truck_no'];
      $loadingChallanDetail['driver'] = $row['driver'];
      $loadingChallanDetail['truck_rent'] = $row['truck_rent'];
      $loadingChallanDetail['l_hamali'] = $row['l_hamali'];
      $loadingChallanDetail['others1'] = $row['others1'];
      $loadingChallanDetail['advance'] = $row['advance'];


    }
  }else {
    $loadingChallanDetail[] = "";
   }
   //foreach ($rows as $loadingChallanDetails){ ?>
  <div class="row g-4">
    <div class="col-md-2">
      <label for="voucher_no" class="form-label form-control-sm">Voucher No.</label>
      <input type="text" name="voucher_no" value="<?php echo isset($loadingChallanDetail['voucher_no']) ? $loadingChallanDetail['voucher_no'] : '' ?>" class="form-control form-control-sm" id="voucher_no">
    </div>
    <div class="col-md-2">
      <label class="form-label form-control-sm"for="unl_date">Date</label>
      <input type="text" name="unl_date" value="<?php echo isset($loadingChallanDetail['date3']) ? $loadingChallanDetail['date3'] : '' ?>" class="form-control form-control-sm" id="unl_date">
    </div>
    <div class="col-md-2">
      <label for="unl_from" class="form-label form-control-sm">From</label>
      <input type="text" name="unl_from" value="<?php echo isset($loadingChallanDetail['from2']) ? $loadingChallanDetail['from2'] : '' ?>" class="form-control form-control-sm" id="unl_from">
    </div>
    <div class="col-md-2">
      <label for="unl_to" class="form-label form-control-sm">To</label>
      <input type="text" name="unl_to" class="form-control form-control-sm" value="<?php echo isset($loadingChallanDetail['to2']) ? $loadingChallanDetail['to2'] : '' ?>" id="unl_to">
    </div>

    <break>
      <div class="row g-4">
        <div class="col-md-2">
          <label for="unl_challan_no" class="form-label form-control-sm">Challan No.</label>
          <input type="text" name="unl_challan_no" class="form-control form-control-sm" id="unl_challan_no" value="<?php echo isset($loadingChallanDetail['voucher_no']) ? $loadingChallanDetail['voucher_no'] : '' ?>">
        </div>
        <!--    <div class="col-md-2">-->
        <!--          <label class="form-label form-control-sm"for="date1">Date</label>-->
        <!--        <input type="date" name="date1" class="form-control form-control-sm" id="date1">-->
        <!--    </div>-->
      </div>

      <hr class="border-primary">

      <div class="container">
        <div class="row">
          <div class="col-6">
            <div class="mb-3 row">
              <label for="unl_truck_no" class="col-sm-3 col-form-label form-control-sm">Truck No.</label>
              <div class="col-sm-3">
                <input type="text" name="unl_truck_no" class="form-control form-control-sm" id="unl_truck_no" value="<?php echo isset($loadingChallanDetail['truck_no']) ? $loadingChallanDetail['truck_no'] : '' ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="unl_driver" class="col-sm-3 col-form-label form-control-sm">Driver</label>
              <div class="col-sm-3">
                <input type="text" name="unl_driver" class="form-control form-control-sm" id="unl_driver" value="<?php echo isset($loadingChallanDetail['driver']) ? $loadingChallanDetail['driver'] : '' ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="unloading_by" class="col-sm-3 col-form-label form-control-sm">Unloading By</label>
              <div class="col-sm-3">
                <input type="text" name="unloading_by" class="form-control form-control-sm" id="unloading_by">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="unl_remark" class="col-sm-3 col-form-label form-control-sm">Remarks</label>
              <div class="col-sm-3">
                <input type="text" name="unl_remark" class="form-control form-control-sm" id="unl_remark">
              </div>
            </div>
          </div>

          <div class="col-1">
            <div class="d-flex" style="height: 200px;">
              <div class="vr"></div>
            </div>
          </div>
          <div class="col-5">
            <div class="mb-3 row">
              <label for="unl_truckrent" class="col-sm-3 col-form-label form-control-sm">Truck Rent</label>
              <div class="col-sm-3">
                <input type="text" name="unl_truckrent" class="form-control form-control-sm" id="unl_truckrent" value="<?php echo isset($loadingChallanDetail['truck_rent']) ? $loadingChallanDetail['truck_rent'] : '' ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="unl_hamali" class="col-sm-3 col-form-label form-control-sm">Hamali</label>
              <div class="col-sm-3">
                <input type="text" name="unl_hamali" class="form-control form-control-sm" id="unl_hamali" value="<?php echo isset($loadingChallanDetail['l_hamali']) ? $loadingChallanDetail['l_hamali'] : '' ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="unl_others" class="col-sm-3 col-form-label form-control-sm">Others</label>
              <div class="col-sm-3">
                <input type="text" name="unl_others" class="form-control form-control-sm" id="unl_others" value="<?php echo isset($loadingChallanDetail['others1']) ? $loadingChallanDetail['others1'] : '' ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="unl_advance" class="col-sm-3 col-form-label form-control-sm">Advance</label>
              <div class="col-sm-3">
                <input type="text" name="unl_advance" class="form-control form-control-sm" id="unl_advance" value="<?php echo isset($loadingChallanDetail['advance']) ? $loadingChallanDetail['advance'] : '' ?>">
              </div>
            </div>

          </div>
        </div>
      </div>
      <hr class="border-primary">
      <div class="container">
        <div class="form-row"><br>
          <div class="col">
            <button type="submit" id='submit' name="submit" class="btn btn-primary " value="Save">Save</button>
            <!-- <button type="button" id='print' name="print" class="btn btn-primary " value="Print">Print</button> -->
          </div>
        </div>
      </div>
<?php //} ?>
</form>

<hr class="border-primary">

<!--Unloading Table -->

<?php include'db_connect.php' ?>

<!-- Loading Challan Table -->
<hr class="border-primary">
<div class="card border-secondary mb-3 my-4" style="max-width: 66rem;">
  <div class="card-body">
    <div class="col-lg-12">

      <div class="card-body">
        <table class="table tabe-hover table-bordered" id="list">
          <thead>
          <tr>
            <th class="text-center">SNo</th>
            <th>Challan No.</th>
            <th>Date</th>
            <th>From</th>
            <th>To</th>
            <th>Vehicle No.</th>
            <th>Driver</th>
          </tr>
          </thead>
          <tbody>
      </div>
    </div>
    <?php
    $login_user_id = $_SESSION['login_id'];
    $loginUserDetails = $conn->query("SELECT `branch_id` FROM `users` where id = '".$login_user_id."'")->fetch_array();;
    $branchId = $loginUserDetails['branch_id'];
    $sql = "SELECT * FROM `loading_challan` WHERE `unloading_status` = 0 AND `to2` = $branchId";
    $result = mysqli_query($conn, $sql);
    $sno = 0;
    while($row = mysqli_fetch_assoc($result)){
      $voucherno = $row['voucher_no'];
      $to = $row['to2'];
      $from = $row['from2'];
      $toDetails = $conn->query("SELECT `city` FROM `branches` where id = '".$to."'")->fetch_array();
      $toCity = $toDetails['city'];
      $fromDetails = $conn->query("SELECT `city` FROM `branches` where id = '".$from."'")->fetch_array();
      $fromCity = $fromDetails['city'];
      $sno = $sno + 1;
      echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td><a href='index.php?page=unloading_challan&voucherno=$voucherno'>". $voucherno . "</a></td>
            <td>". date("d-m-Y", strtotime($row['date3'])) . "</td>
		      	<td>". $fromCity . "</td>
            <td>". $toCity . "</td>
			      <td>". $row['truck_no'] . "</td>
            <td>". $row['driver'] . "</td>
			     </tr>";
    }
    ?>


    <script>
      $(document).ready(function(){
        $('#list').dataTable()
        $('.parcel').click(function(){
          //	uni_modal("staff's Details","view_staff.php?id="+$(this).attr('data-id'),"large")
        })
        $('.delete_staff').click(function(){
          //_conf("Are you sure to delete this staff?","delete_staff",[$(this).attr('data-id')])
        })
      })
    </script>
    <!--
    <script src="https://text.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function () {
        var i = 1;
         $('#add').click(function () {
          i++;
          $('#dynamic_field').append('<div class="form-row" id="row' + i + '"> <div class="col-md-2"><label for="articletype" class="form-label">Article Type</label><input type="text" name="articletype" class="form-control" id="articletype"></div><div class="col-md-1"><label for="art" class="form-label">Art</label><input type="text" name="art" class="form-control" id="art"></div><div class="col-md-1"><label for="wt" class="form-label">Wt</label><input type="text" name="wt" class="form-control" id="wt"></div><div class="col-md-2"><label for="rate" class="form-label">Rate</label><input type="text" name="rate" class="form-control" id="rate"></div><div class="col-md-1"><label for="per" name="per" class="form-label">Per</label><select id="per" class="form-select"><option selected>Art</option><option>TBB</option><option>FOC</option></select></div><div class="col-md-2"><label for="amount" class="form-label">Amount</label><input type="text" name="amount" class="form-control" id="amount"></div><div class="col"> <td><button type="button" name="add" class="btn btn-danger btn_remove" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
        });
        $(document).on('click', '.btn_remove', function () {
          var button_id = $(this).attr("id");

          $('#row' + button_id + '').remove();
        });
      });
    </script>-->
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

