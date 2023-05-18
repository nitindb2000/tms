<!DOCTYPE html>
<html>
<?php include'db_connect.php' ?>


<div class="card border-secondary mb-3" style="max-width: 66rem;">
<div class="card-body">
<div class="col-lg-12">
			<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="./index.php?page=new_party"><i class="fa fa-plus"></i> Add New Party</a>
			</div>
		</div>
		<div class="card-body">
		    <div class="table-responsive">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">SNo</th>
						<th>Code</th>
						<th>Name</th>
						<th>City</th>
						<th>Address</th>
						<th>State</th>
						<th>Pin</th>
						<th>Contact No</th>
						<th>Party Type</th>
						<th>Credit Period</th>
					</tr>
				</thead>
				<tbody>
</div>
</div>
</div>
				<?php 
          $sql = "SELECT * FROM `new_party`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['party_code'] . "</td>
            <td>". $row['party_name'] . "</td>
			<td>". $row['party_city'] . "</td>
            <td>". $row['party_add'] . "</td>
			<td>". $row['party_state'] . "</td>
            <td>". $row['party_pin'] . "</td>
			<td>". $row['party_contact'] . "</td>
            <td>". $row['party_type'] . "</td>
			<td>". $row['credit_period'] . "</td>
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