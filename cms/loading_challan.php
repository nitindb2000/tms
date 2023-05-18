<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script type="text/javascript">
    function sum() {
      var trent = Number(document.getElementById('truck_rent').value);
      var lhamali = Number(document.getElementById('l_hamali').value);
      var others = Number(document.getElementById('others1').value);
      result = 0;
      if(trent == "")
      {
        trent = 0
      }
      if(lhamali == "")
      {
        lhamali = 0
      }
      if(others == "")
      {
        others = 0
      }
      result = (trent + lhamali + others);
      if (!isNaN(result)) {
        document.getElementById('total_a').value = result;
      }
      /*var frombranch = document.getElementById('from2').value;
      document.getElementById('frombranch').value = frombranch;*/
      var totala = Number(document.getElementById('total_a').value);
      var advance = Number(document.getElementById('advance').value);
      balance = (totala - advance);
      if (!isNaN(balance)) {
        document.getElementById('balance').value = balance;
      }
    }
  </script>
  </head>
<body>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //$sno = $_POST['sno'];
      $voucher_no = $_POST['voucher_no'];
      $date3 = $_POST['date3'];
      if($date3 == null)
      {
        $date3 = date('Y-m-d H:i:s');
      }
      $from2 = $_POST['from2'];
      $to2 = $_POST['to2'];
      $truck_no = $_POST['truck_no'];
      $driver = $_POST['driver'];
      $license_no = $_POST['license_no'];
      $supplier = $_POST['supplier'];
      $owner = $_POST['owner'];
      $loading_by = $_POST['loading_by'];
      $remarks1 = $_POST['remarks1'];
      $truck_rent = $_POST['truck_rent'];
      $l_hamali = $_POST['l_hamali'];
      $others1 = $_POST['others1'];
      $total_a = $_POST['total_a'];
      $advance = $_POST['advance'];
      $balance = $_POST['balance'];
      $date4 = $_POST['date4'];
      $date5 = $_POST['date5'];
      $branches = $_POST['branches'];
      $branches = "'" . implode ( "', '", $branches ) . "'";
      //$branches = $branchWithCount;


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
        $currentuser=$_SESSION['login_id'];
        $user = mysqli_query($conn,"SELECT branches.city,branches.id FROM branches LEFT JOIN users ON branches.id = users.branch_id WHERE users.id =" . $currentuser);

        while ($userCity = $user->fetch_assoc()) {
          $city = $userCity['city'];
          $from2 = $userCity['id'];
        }
        // Submit these to a database

        $lrnoselectQuery = "select `lrno` from new_parcel where `to1` IN ($branches) and status1=0";
        $lrnoselectQuery = mysqli_query($conn, $lrnoselectQuery);
        $test = array();
        while($lrnoselectQueryrow = mysqli_fetch_array($lrnoselectQuery)){
$test[] = $lrnoselectQueryrow['lrno'];
        }
        $branchColl = implode(',',$test);
        $sql = "INSERT INTO `loading_challan` (`voucher_no`, `date3`, `from2`, `to2`, `truck_no`, `driver`, `license_no`, `supplier`, `owner`, `loading_by`, `remarks1`, `truck_rent`, `l_hamali`, `others1`, `total_a`, `advance`, `balance`, `date4`, `date5`, `branches`) VALUES ('', '$date3', '$from2', '$to2', '$truck_no', '$driver', '$license_no', '$supplier', '$owner', '$loading_by', '$remarks1', '$truck_rent', '$l_hamali', '$others1', '$total_a', '$advance', '$balance', '$date4', '$date5', '$branchColl')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
          $updateNewParcelStatusSql = "UPDATE new_parcel SET status1=1 WHERE lrno IN ($branchColl)";
          mysqli_query($conn, $updateNewParcelStatusSql);
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
$branchesQuery = "SELECT * FROM `branches`";
$branchesColl = mysqli_query($conn, $branchesQuery);
date_default_timezone_set("Asia/Kolkata");
?>

<form action="/cms/index.php?page=loading_challan" method="post">
<div class="row g-4">
<div class="col-md-2">
    <label for="voucher_no" class="form-label form-control-sm">Voucher No.</label>
    <input type="text" name="voucher_no" class="form-control form-control-sm" id="voucher_no" readonly>
  </div>
  <div class="col-md-2">
          <label class="form-label form-control-sm"for="date1">Date</label>
        <input type="date" name="date3" class="form-control form-control-sm" id="date3" value="<?php echo date('Y-m-d');?>">
    </div>
<div class="col-md-2">
    <label for="from2" class="form-label form-control-sm">From</label>
  <?php
  $currentuser=$_SESSION['login_id'];
  $user = mysqli_query($conn,"SELECT branches.city FROM branches LEFT JOIN users ON branches.id = users.branch_id WHERE users.id =" . $currentuser);

  while ($userCity = $user->fetch_assoc()) {
    $city = $userCity['city'];
  }
  ?>
  <input list="from2" name="from2" id="from2" type="text" class="form-control form-control-sm" placeholder="From" aria-label="From" value="<?php echo $city; ?>" required readonly>
  <datalist id="from2">
    <?php
    $branches = $conn->query("SELECT *,concat(city) as city FROM branches");
    while($row = $branches->fetch_assoc()):
      ?>
      <option value="<?php echo $row['id'] ?>"><?php echo $row['city']?></option>
    <?php endwhile; ?>
  </datalist>
  </div>
  <div class="col-md-2">
    <label for="to2" class="form-label form-control-sm">To</label>
    <select name="to2" id="to2" class="form-control form-control-sm input-sm select2" required>
                  <option value=""></option>
                  <?php
                    $branches = $conn->query("SELECT *,concat(city) as city FROM branches");
                    while($row = $branches->fetch_assoc()):
                  ?>
                  <option value="<?php echo $row['id'] ?>"><?php echo $row['city']?></option>
                <?php endwhile; ?>
                </select>
  </div>

  <hr class="border-primary">

  <!-- Article type -1 Start -->
  <div class="container">
<div class="row">

    <div class="col-6">
  <div class="mb-3 row">
    <label for="truck_no" class="col-sm-2 col-form-label form-control-sm">Truck No.</label>
    <div class="col-sm-4">
      <input type="text" name="truck_no" class="form-control form-control-sm" id="truck_no">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="driver" class="col-sm-2 col-form-label form-control-sm">Driver</label>
    <div class="col-sm-4">
      <input type="text" name="driver" class="form-control form-control-sm" id="driver">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="license_no" class="col-sm-2 col-form-label form-control-sm">License No.</label>
    <div class="col-sm-4">
      <input type="text" name="license_no" class="form-control form-control-sm" id="license_no">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="supplier" class="col-sm-2 col-form-label form-control-sm">Supplier</label>
    <div class="col-sm-4">
      <input type="text" name="supplier" class="form-control form-control-sm" id="supplier">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="owner" class="col-sm-2 col-form-label form-control-sm">Owner</label>
    <div class="col-sm-4">
      <input type="text" name="owner" class="form-control form-control-sm" id="owner">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="loading_by" class="col-sm-2 col-form-label form-control-sm">Loading By</label>
    <div class="col-sm-4">
      <input type="text" name="loading_by" class="form-control form-control-sm" id="loading_by">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="remarks1" class="col-sm-2 col-form-label form-control-sm">Remarks</label>
    <div class="col-sm-4">
      <input type="text" name="remarks1" class="form-control form-control-sm" id="remarks1">
    </div>
  </div>
                    </div>
                    <div class="col-1">
                    <div class="d-flex" style="height: 300px;">
  <div class="vr"></div>
</div>
</div>
                    <div class="col-5">
  <div class="mb-3 row">
    <label for="truck_rent" class="col-sm-2 col-form-label form-control-sm">Truck Rent</label>
    <div class="col-sm-3">
      <input type="text" name="truck_rent" class="form-control form-control-sm" id="truck_rent" onkeyup="sum()">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="l_hamali" class="col-sm-2 col-form-label form-control-sm">Loading Hamali</label>
    <div class="col-sm-3">
      <input type="text" name="l_hamali" class="form-control form-control-sm" id="l_hamali" onkeyup="sum()">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="others1" class="col-sm-2 col-form-label form-control-sm">Others</label>
    <div class="col-sm-3">
      <input type="text" name="others1" class="form-control form-control-sm" id="others1" onkeyup="sum()">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="total_a" class="col-sm-2 col-form-label form-control-sm">Total[A]</label>
    <div class="col-sm-3">
      <input type="text" name="total_a" class="form-control form-control-sm" id="total_a" onkeyup="sum()">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="advance" class="col-sm-2 col-form-label form-control-sm">Advance</label>
    <div class="col-sm-3">
      <input type="text" name="advance" class="form-control  form-control-sm" id="advance" onkeyup="sum()">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="balance" class="col-sm-2 col-form-label form-control-sm">Balace</label>
    <div class="col-sm-3">
      <input type="text" name="balance" class="form-control form-control-sm" id="balance">
    </div>
  </div>


                    </div>
                    </div>
                    </div>
  <br>
<hr class="border-primary">
<div class="row g">
  <div class="col-md-2">
          <label class="form-label form-control-sm" for="date4">Date</label>
        <input type="date" name="date4" class="form-control form-control-sm" id="date4" >
    </div>
    <div class="col-md-2">
          <label class="form-label form-control-sm" for="date5">Date</label>
        <input type="date" name="date5" class="form-control form-control-sm" id="date5">
    </div>
  </div>


<div class="container">
          <div class="form-row"><br>
            <div class="col">
              <button type="button" class="btn btn-primary generate" data-bs-toggle="modal" data-bs-target="#loadingcityModal">Generate</button>
            </div>
          </div>
        </div>

      </fieldset>
    </div>


<br>

  <div class="modal" id="loadingcityModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Select Stations</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <!--<form method="post" action="lr_details.php">-->
          <!-- Modal body -->
          <div class="modal-body">
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
          </div>
        <!--</form>-->
      </div>
    </div>
  </div>
</form>

<!-- Loading Challan Table -->
<hr class="border-primary">
<div class="card border-secondary mb-3 my-1" style="max-width: 66rem;">
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
        $branchDetails = $conn->query("SELECT `city` FROM `branches` where id = '".$branchId."'")->fetch_array();;
        $branchCity = $branchDetails['city'];
          $sql = "SELECT * FROM `loading_challan` WHERE `unloading_status` = 0 AND `from2` = $branchId";
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
            <td><a href='index.php?page=l_r_details&voucherno=$voucherno'>". $voucherno . "</a></td>
            <td>". date("d-m-Y", strtotime($row['date3'])) . "</td>
		      	<td>". $fromCity . "</td>
            <td>". $toCity . "</td>
			      <td>". $row['truck_no'] . "</td>
            <td>". $row['driver'] . "</td>
			     </tr>";
        }
          ?>

<!-- Search Option and Pagination -->

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

<script>
  $(document).ready(function () {
    $(document).on('click', '.generate', function () {
      var fromdate = document.getElementById('date4').value;
      var todate = document.getElementById('date5').value;
      $.ajax({
        url: 'ajaxfile.php',
        type: 'post',
        data: {fromdate: fromdate,todate: todate},
        success: function(response){
          // Add response in Modal body
          $('.modal-body').html(response);

          // Display Modal
          $('#loadingcityModal').modal('show');
        }
      });

    });
  });
</script>
<!-- The Modal -->
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

