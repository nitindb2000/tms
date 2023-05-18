<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
$con = mysqli_connect("localhost","root","","test");

if(isset($_post['lrno'])) {
  $lrno = $_GET['lrno'];

  $query = "SELECT * FROM new_parcel WHERE lrno='$lrno' ";
  $query_run = mysqli_query($con, $query);

}
?>

<!--<div class="container">-->
<div class="row justify-content-center">
  <div class="col-md-7">
    <form action="/cms/index.php?page=test&lrno=$lrno" method="GET">
      <div class="row">
        <div class="col-md-4">
          <input type="hidden" name="page" value="test">
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        //$sno = $_POST['sno'];
        $cm_lrdate = $_POST['cm_lrdate'];
        $cm_from = $_POST['cm_from'];
        $cm_to = $_POST['cm_to'];


        $con = mysqli_connect("localhost","root","","cms_db");

        if(isset($_GET['lrno']))
        {
          $lrno = $_GET['lrno'];

          $query = "SELECT * FROM new_parcel WHERE lrno='$lrno' ";
          $sql = "INSERT INTO `formtest` (`cm_lrno`, `cm_lrdate`, `cm_from`, `cm_to`) VALUES ('', '$cm_lrdate', '$cm_from', '$cm_to')";

          $query_run = mysqli_query($con, $query);

          if(mysqli_num_rows($query_run) > 0)
          {
            foreach($query_run as $row)
            {
              ?>

        <form action="/cms/index.php?page=test&lrno=$lrno" method="POST">
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
                  $status = "";
                  echo $row['status1'];
                  if($row['status1'] == 0)
                  {
                    $status = "Shipment Loaded";
                  } elseif($row['status1'] == 1){
                    $status = "Unloaded Shipment";
                  } else {
                    $status = "";
                  }
                  ?>
                  <input type="text" class="form-control form-control-sm text-succes font-weight-bold" value="<?= $status ?>" readonly>
                </div>

                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
        </form>


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

