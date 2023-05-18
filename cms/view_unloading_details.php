<!DOCTYPE html>
<html>
<?php include'db_connect.php' ?>


<div class="card border-secondary mb-3" style="max-width: 66rem;">
<div class="card-body">
<div class="col-lg-12">
		<div class="card-body">
    <div class="table-responsive">
			<table class="table table-sm table-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">SNo</th>
						<th>Voucher No.</th>
						<th>Date</th>
						<th>From</th>
						<th>To</th>
						<th>Challan No.</th>
						<th>Truck No.</th>
						<th>Driver</th>
						<th>Unloading By</th>
						<th>Truck Rent</th>
            <th>Hamali</th>
						<th>Advance</th>
					</tr>
				</thead>
				<tbody>
</div>
</div>
</div>
				<?php
          $sql = "SELECT * FROM `unloading_challan`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            $voucherno= $row['voucher_no'];

            /**  start */
            $login_user_id = $_SESSION['login_id'];
            $loginUserDetails = $conn->query("SELECT `branch_id` FROM `users` where id = '".$login_user_id."'")->fetch_array();;
            $branchId = $loginUserDetails['branch_id'];
            $loadingchallansql = "SELECT * FROM `loading_challan` WHERE `from2` = $branchId";
            $loadingchallanresult = mysqli_query($conn, $loadingchallansql);
        while($loadingchallanrow = mysqli_fetch_assoc($loadingchallanresult)) {
          $loadingchallanvoucherno = $loadingchallanrow['voucher_no'];
        }
        $urlFrom = $row['unl_from'];
        $urlTo = $row['unl_to'];
            $branchDetails = $conn->query("SELECT `city` FROM `branches` where id = '".$urlFrom."'")->fetch_array();
            $branchCityFrom = $branchDetails['city'];
            $branchDetails = $conn->query("SELECT `city` FROM `branches` where id = '".$urlTo."'")->fetch_array();
            $branchCityTo = $branchDetails['city'];
            /**  end */
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td><a href='index.php?page=l_r_details&voucherno=$loadingchallanvoucherno'>". $voucherno . "</a></td>

            <td>". date("d-m-Y", strtotime($row['unl_date'])) . "</td>
			      <td>". $branchCityFrom . "</td>
            <td>". $branchCityTo . "</td>
			      <td>". $row['unl_challan_no'] . "</td>
            <td>". $row['unl_truck_no'] . "</td>
			      <td>". $row['unl_driver'] . "</td>
            <td>". $row['unloading_by'] . "</td>
			      <td>". $row['unl_truckrent'] . "</td>
            <td>". $row['unl_hamali'] . "</td>
			      <td>". $row['unl_advance'] . "</td>
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
