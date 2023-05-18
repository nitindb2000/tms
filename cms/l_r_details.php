<!DOCTYPE html>
<html>
<?php include'db_connect.php' ?>

<div class="card border-secondary mb-3 my-4" style="max-width: 66rem;">
<div class="card-body">
<div class="col-lg-12">

<div class="table-responsive">
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">SNo</th>
						<th>LR No</th>
						<th>Date</th>
						<th>Manual LR</th>
						<th>To</th>
            <th>Consignor</th>
						<th>Consignee</th>
						<th>Article</th>
            <th>LR Type</th>
						<th>Weight</th>
						<th>Fright</th>
					</tr>
				</thead>
				<tbody>


				<?php
        $voucherno = $_GET['voucherno'];
        $loadingChallan = "SELECT `branches` FROM `loading_challan` where `voucher_no` = $voucherno";
        $loadingChallanResult = mysqli_query($conn, $loadingChallan);
        $lrCount = 0;
        $article = 0;
        $wt = 0;
        $topay = 0;
        $paid = 0;
        $tbb = 0;
        while($loadingChallanResultRow = mysqli_fetch_assoc($loadingChallanResult)){
          $branches = explode(',',$loadingChallanResultRow['branches']);
          $branchess = "'" . implode ( "', '", $branches ) . "'";
          $sql = "SELECT * FROM `new_parcel` where `lrno` IN ($branchess)";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $lrCount++;
            $sno = $sno + 1;
            $art = ($row['art1'] + $row['art2'] + $row['art3'] + $row['art4']);
            $article = $article + $art;
            $weight = ($row['wt1'] + $row['wt2'] + $row['wt3'] + $row['wt4']);
            $wt = $wt + $weight;
            if($row['freighttype'] == "ToPay")
            {
              $topay = $topay+$row['lr_total'];
            }
            if($row['freighttype'] == "Paid")
            {
              $paid = $paid+$row['lr_total'];
            }
            if($row['freighttype'] == "TBB")
            {
              $tbb = $tbb+$row['lr_total'];
            }
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['lrno'] . "</td>
            <td>". date("d-m-Y", strtotime($row['date'])) . "</td>
            <td>". $row['manuallr'] . "</td>
		      	<td>". $row['to1'] . "</td>
            <td>". $row['consignor'] . "</td>
			      <td>". $row['consignee'] . "</td>
            <td>". $art . "</td>
            <td>". $row['freighttype'] . "</td>
            <td>". $weight . "</td>
			      <td>". $row['lr_total'] . "</td>
			     </tr>";
          }
        }

          ?>
        </tbody>
      </table>
    </div>
</div>
</div>
  <div class="row g-3">
    <div class="col-md-2">
      <label for="total_lrs" class="form-label form-control-sm">Total: LR's</label>
      <input type="text" name="total_lrs" value="<?php echo $lrCount; ?>" class="form-control form-control-sm text-danger font-weight-bold" id="total_lrs" readonly>
    </div>
    <div class="col-md-1">
      <label for="article11" class="form-label form-control-sm">Articles</label>
      <input type="text" name="article11" value="<?php echo $article; ?>" class="form-control form-control-sm text-danger font-weight-bold" id="article11" readonly>
    </div>
    <div class="col-1">
      <label for="weight11" class="form-label form-control-sm">Weight</label>
      <input type="text" name="weight11" value="<?php echo $wt; ?>" class="form-control form-control-sm text-danger font-weight-bold" id="weight11" readonly>
    </div>
    <div class="col-1">
      <label for="topay11" class="form-label form-control-sm">To Pay</label>
      <input type="text" name="topay11" value="<?php echo $topay; ?>" class="form-control form-control-sm text-danger font-weight-bold" id="topay11" readonly>
    </div>
    <div class="col-md-1">
      <label for="paid11" class="form-label form-control-sm">Paid</label>
      <input type="text" name="paid11" value="<?php echo $paid; ?>" class="form-control form-control-sm text-danger font-weight-bold" id="paid11" readonly>
    </div>
    <div class="col-md-1">
      <label for="tbb11" class="form-label form-control-sm">TBB</label>
      <input type="text" name="tbb11" value="<?php echo $tbb; ?>" class="form-control form-control-sm text-danger font-weight-bold" id="tbb11" readonly>
    </div>
  </div>
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
