<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
$con = mysqli_connect("localhost","root","","cms_db");

if(isset($_post['lrno'])) {
  $lrno = $_GET['lrno'];

  $query = "SELECT * FROM new_parcel WHERE lrno='$lrno' ";
  $query_run = mysqli_query($con, $query);

}
?>

<!--<div class="container">-->
  <div class="row justify-content-center">
    <div class="col-md-7">
         <form action="/cms/index.php?page=track&lrno=$lrno" method="GET">
            <div class="row">
              <div class="col-md-4">
                <input type="hidden" name="page" value="track">
                <input type="text" name="lrno" value="<?php if(isset($_GET['lrno'])){echo $_GET['lrno'];} ?>" class="form-control">
              </div>
              <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </div>
          </form>

          <div class="row">
            <div class="col-md-12">
              <hr>
              <?php
              $con = mysqli_connect("localhost","root","","cms_db");

              if(isset($_GET['lrno']))
              {
                $lrno = $_GET['lrno'];

                $query = "SELECT * FROM new_parcel WHERE lrno='$lrno' ";
                $query_run = mysqli_query($con, $query);

                if(mysqli_num_rows($query_run) > 0)
                {
                  foreach($query_run as $row)
                  {
                    ?>


                      <div class="row g-4">
                        <div class="col-md-2">
                          <label class="form-label form-control-sm"for="cm_lrno">LR No.</label>
                          <input type="text" class="form-control form-control-sm text-danger font-weight-bold" value="<?= $row['lrno']; ?>" readonly>
                        </div>
                        <div class="col-md-3">
                          <label for="cm_lrdate" class="form-label form-control-sm">LR Date</label>
                          <input type="text" class="form-control form-control-sm text-danger font-weight-bold" value="<?= $row['date']; ?>" readonly>
                        </div>

                        <div class="col-md-3">
                          <label for="cm_from" class="form-label form-control-sm">From</label>
                          <input type="text" class="form-control form-control-sm text-danger font-weight-bold"  value="<?= $row['from1']; ?>" readonly>
                        </div>
                        <div class="col-md-3">
                          <label class="form-label form-control-sm"for="cm_to">To</label>
                          <input type="text" class="form-control form-control-sm text-danger font-weight-bold" value="<?= $row['to1']; ?>" readonly>
                        </div>
                      </div>


                      <div class="row g-2">
                        <div class="col-md-4">
                          <label for="cm_consignor" class="form-label form-control-sm">Consignor</label>
                          <input type="text" class="form-control form-control-sm text-danger font-weight-bold" value="<?= $row['consignor']; ?>" readonly>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label form-control-sm"for="cm_consignee">Consignee</label>
                          <input type="text" class="form-control form-control-sm text-danger font-weight-bold" value="<?= $row['consignee']; ?>" readonly>
                        </div>
                      </div>

                      <div class="row g-4">
                        <div class="col-md-2">
                          <label for="cm_art1" class="form-label form-control-sm">Art</label>
                          <input type="text" class="form-control form-control-sm text-danger font-weight-bold" value="<?= $row['art1']; ?>" readonly>
                        </div>
                        <div class="col-md-2">
                          <label class="form-label form-control-sm"for="cm_wt">Wt.</label>
                          <input type="text" class="form-control form-control-sm text-danger font-weight-bold" value="<?= $row['wt1']; ?>" readonly>
                        </div>

                        <div class="col-md-3">
                          <label for="cm_content" class="form-label form-control-sm">Article type</label>
                          <input type="text" class="form-control form-control-sm text-danger font-weight-bold" value="<?= $row['articletype1']; ?>" readonly>
                        </div>

                         <div class="col-md-3">
                          <label for="cm_lr_total" class="form-label form-control-sm">LR Amount</label>
                          <input type="text" class="form-control form-control-sm text-danger font-weight-bold" value="<?= $row['lr_total']; ?>" readonly>
                        </div>
                      </div>
                    <hr>
                         <div class="row g-4">
                          <div class="col-md-4">
                            <label for="cm_lr_total" class="form-label form-control-sm">Delivery Status</label>
                            <?php
                            $status = $row['status1'];
                            $selectQuery = "SELECT unloading_status FROM loading_challan WHERE FIND_IN_SET($lrno,branches) > 0";
                    $queryRun = mysqli_query($con, $selectQuery);

                            $unloadingStatus = '';
                    if(mysqli_num_rows($queryRun) > 0) {
                      foreach ($queryRun as $selectRow) {
                       $unloadingStatus = $selectRow['unloading_status'];
                       break;
                      }
                    }

                            $selectCashMemoQuery = "SELECT delivery_status FROM cash_memo WHERE cm_lr='$lrno'";
                            $queryCashMemoRun = mysqli_query($con, $selectCashMemoQuery);

                            $deliveryStatus = '';
                            if(mysqli_num_rows($queryCashMemoRun) > 0) {
                              foreach ($queryCashMemoRun as $selectCashMemoRow) {
                                $deliveryStatus = $selectCashMemoRow['delivery_status'];
                                break;
                              }
                            }
                            if($deliveryStatus == 1)
                            {
                              $status = "Shipment Delivered"; ?>
                              <input type="text" class="form-control form-control-sm text-succes font-weight-bold" style="color: #4fbd4f; font-size: 15px" value="<?= $status ?>" readonly>
                           <?php } else {
                              if($unloadingStatus == 0)
                              {
                                $status = "Shipment Loaded";
                              } elseif($unloadingStatus == 1){
                                $status = "Shipment Unloaded";
                              } else {
                                $status = "Shipment Not Loaded";
                              } ?>
                              <input type="text" class="form-control form-control-sm text-succes font-weight-bold text-danger" style="font-size: 15px" value="<?= $status ?>" readonly>
                            <?php }


                            ?>

                          </div>
                        </div>



                    <?php
                  }
                }
                else
                {
                  echo "No Record Found";
                }
              }

              ?>

            </div>
          </div>

        </div>
      </div>

    </div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

