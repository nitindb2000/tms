
<!DOCTYPE html>
<html>
<?php include'db_connect.php' ?>

<div class="card border-secondary mb-3" style="max-width: 66rem;">
<div class="col-lg-12">
			<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="./index.php?page=party_rate"><i class="fa fa-plus"></i> Add New Rate</a>
			</div>
		</div>
		
			<div class="card-body">
			    <div class="table-responsive">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">SNo</th>
						<th>Party</th>
						<th>LR Charges</th>
						<th>Hamali Per Article</th>
						<th>Freight Type</th>
						<th>Station</th>
						<th>Article Type</th>
						<th>Rate</th>
						<th>Per</th>
					</tr>
				</thead>
				<tbody>
  </div>
  </div>
  </div>
				<?php 

          $sql = "SELECT * FROM `party_rate`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['party_name1'] . "</td>
            <td>". $row['lrcharges'] . "</td>
			      <td>". $row['hamali'] . "</td>
            <td>". $row['party_freighttype'] . "</td>
            <td>". $row['station'] . "</td>
		      	<td>". $row['party_articletype'] . "</td>
            <td>". $row['party_rate'] . "</td>
		      	<td>". $row['party_per'] . "</td>
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