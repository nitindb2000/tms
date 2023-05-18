<!DOCTYPE html>
<html>
<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<!-- <a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="./index.php?page=new_parcel"><i class="fa fa-plus"></i> Add New LR Entry</a> -->
			</div>
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-sm table-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">SNo</th>
						<th>Cash Memo No</th>
						<th>Date</th>
						<th>Consignor</th>
						<th>Consignee</th>
						<th>Amount</th>
            <th>Write Off Amount</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
          $sql = "SELECT * FROM `cash_memo`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $id = $row['cm_no'];
            $sno = $sno + 1;
            //$lrNumber = substr($row['from1'],0,3).$row['lrno'];
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['cm_no'] . "</td>
            <td>". date("d-m-Y", strtotime($row['cm_date'])) . "</td>
			<td>". $row['cm_consignor'] . "</td>
            <td>". $row['cm_consignee'] . "</td>
			<td>". $row['cm_amount1'] . "</td>
			<td>". $row['cmr_wr_amount'] . "</td>
			<td>
			<div class='btn-group'>
			<a href='fpdf/cashmemo_print.php?id=$id'><i class='fa fa-print'></i></a>
           </div>
			</td>
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
          $(document).ready(function(){
            $('.print_data').click(function(){
              uni_modal("Laxmi Roadlines","print_parcel.php?id="+$(this).attr('data-id'),"mid-large")
            })
          })
          </script>
        <script>
          $(document).ready(function(){
            $('.delete_parcel').click(function(){
              _conf("Are you sure to delete this LR entry?","delete_parcel",[$(this).attr('data-id')])
            })
          })
          function delete_parcel($id){
            start_load()
            $.ajax({
              url:'ajax.php?action=delete_parcel',
              method:'POST',
              data:{id:$id},
              success:function(resp){
                if(resp==1){
                  alert_toast("Data successfully deleted",'success')
                  setTimeout(function(){
                    location.reload()
                  },1500)

                }
              }
            })
          }
        </script>
<!-- <button type='button' class='btn btn-success editbtn'><span class='fa fa-edit text-light'></span></button>
            <button type='button' class='btn btn-success editbtn'><span class='fa fa-edit text-light'></span></button>
          <a class='dropdown-item print_data' href='javascript:void(0)' data-id='".$row['lrno']."'>Print</a>
            </td>
            <td>
            <button type='button' class='btn-danger deletebtn'><span class='fa fa-trash text-light'></span></button>-->
