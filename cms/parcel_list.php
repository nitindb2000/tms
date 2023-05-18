<!DOCTYPE html>
<html>
<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="./index.php?page=new_parcel"><i class="fa fa-plus"></i> Add New LR Entry</a>
			</div>
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-sm table-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">SNo</th>
						<th>Action</th>
						<th>LR No</th>
						<th>Date</th>
						<th>Manual LR</th>
						<th>From</th>
						<th>To</th>
						<th>Freight Type</th>
						<th>Consignor</th>
						<th>Consignee</th>
						<th>Article Type1</th>
						<th>Art1</th>
						<th>Wt1</th>
						<th>Rate1</th>
						<th>Per1</th>
						<th>Amount1</th>
						<th>Article Type2</th>
						<th>Art2</th>
						<th>Wt2</th>
						<th>Rate2</th>
						<th>Per2</th>
						<th>Amount2</th>
						<th>Article Type3</th>
						<th>Art3</th>
						<th>Wt3</th>
						<th>Rate3</th>
						<th>Per3</th>
						<th>Amount3</th>
						<th>Article Type4</th>
						<th>Art4</th>
						<th>Wt4</th>
						<th>Rate4</th>
						<th>Per4</th>
						<th>Amount4</th>
						<th>Freight</th>
						<th>Labour Charges</th>
						<th>St. Charges</th>
						<th>Other Charges</th>
						<th>PF</th>
						<th>Door Del.</th>
						<th>LR Total</th>
						<th>Content</th>
						<th>Actual Wt</th>
						<th>Invoice No</th>
						<th>Value</th>
						<th>E Way Bill No</th>
						<th>Made By</th>
						<th>Remark</th>
						
					</tr>
				</thead>
				<tbody>
				<?php
          $sql = "SELECT * FROM `new_parcel`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $id = $row['lrno'];
            $sno = $sno + 1;
            //$lrNumber = substr($row['from1'],0,3).$row['lrno'];
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>
			<div class='btn-group'>
			<a href='index.php?page=edit_parcel&id=$id' class='mr-3'><i class='fa fa-edit'></i></a>
			<a href='#' class='mr-3'><i class='fa fa-trash delete_parcel' data-id=$id></i></a>
			<a href='fpdf/printpdf.php?id=$id'><i class='fa fa-print'></i></a>
           </div>
			</td>
            <td>". $row['lrno'] . "</td>
            <td>". date("d-m-Y", strtotime($row['date'])) . "</td>
			<td>". $row['manuallr'] . "</td>
            <td>". $row['from1'] . "</td>
			<td>". $row['to1'] . "</td>
            <td>". $row['freighttype'] . "</td>
			<td>". $row['consignor'] . "</td>
            <td>". $row['consignee'] . "</td>
			<td>". $row['articletype1'] . "</td>
            <td>". $row['art1'] . "</td>
			<td>". $row['wt1'] . "</td>
            <td>". $row['rate1'] . "</td>
			<td>". $row['per1'] . "</td>
            <td>". $row['amount1'] . "</td>
			<td>". $row['articletype2'] . "</td>
            <td>". $row['art2'] . "</td>
			<td>". $row['wt2'] . "</td>
            <td>". $row['rate2'] . "</td>
			<td>". $row['per2'] . "</td>
            <td>". $row['amount2'] . "</td>
			<td>". $row['articletype3'] . "</td>
            <td>". $row['art3'] . "</td>
			<td>". $row['wt3'] . "</td>
            <td>". $row['rate3'] . "</td>
			<td>". $row['per3'] . "</td>
            <td>". $row['amount3'] . "</td>
			<td>". $row['articletype4'] . "</td>
            <td>". $row['art4'] . "</td>
			<td>". $row['wt4'] . "</td>
            <td>". $row['rate4'] . "</td>
			<td>". $row['per4'] . "</td>
            <td>". $row['amount4'] . "</td>
			<td>". $row['freight1'] . "</td>
            <td>". $row['labour_charges'] . "</td>
			<td>". $row['st_charges'] . "</td>
            <td>". $row['other_charges'] . "</td>
			<td>". $row['pf'] . "</td>
            <td>". $row['door_del'] . "</td>
			<td>". $row['lr_total'] . "</td>
			<td>". $row['content'] . "</td>
			<td>". $row['actualwt'] . "</td>
            <td>". $row['invoice'] . "</td>
			<td>". $row['value'] . "</td>
            <td>". $row['eway'] . "</td>
			<td>". $row['madeby'] . "</td>
            <td>". $row['remark'] . "</td>
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
