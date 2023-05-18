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
      var rate1 = document.getElementById("inputrate1").value;
      var opts = document.getElementById('rate1').childNodes;

      if(rate1 == "") {
        for (var i = 0; i < opts.length; i++) {
          if (opts[i].value === rate1) {
            // An item was selected from the list!
            // yourCallbackHere()
            rate1 = opts[i].value;
            break;
          }
        }
      }

      var art1 = document.getElementById('art1').value;
      var wt1 = document.getElementById('wt1').value;
      //var rate1 = document.getElementById('rate1').value;
      var per1 = document.getElementById('per1').value;
      if (per1 == 'Art') {
        var result1 = parseInt(art1) * parseFloat(rate1);
      } else if (per1 == 'Kg') {
        var result1 = parseInt(wt1) * parseFloat(rate1);
      } else {
        var result1 = parseInt(rate1);
      }
      if (!isNaN(result1)) {
        document.getElementById('amount1').value = result1;
      }


      var rate2 = document.getElementById("inputrate2").value;
      var opts2 = document.getElementById('rate2').childNodes;

      if(rate2 == "") {
        for (var i = 0; i < opts2.length; i++) {
          if (opts2[i].value === rate2) {
            rate2 = opts2[i].value;
            break;
          }
        }
      }

      var art2 = document.getElementById('art2').value;
      var wt2 = document.getElementById('wt2').value;
      //var rate2 = document.getElementById('rate2').value;
      var per2 = document.getElementById('per2').value;
      if (per2 == 'Art') {
        var result2 = parseInt(art2) * parseFloat(rate2);
      } else if (per2 == 'Kg') {
        var result2 = parseInt(wt2) * parseFloat(rate2);
      } else {
        var result2 = parseInt(rate2);
      }
      if (!isNaN(result2)) {
        document.getElementById('amount2').value = result2;
      }

      var rate3 = document.getElementById("inputrate3").value;
      var opts3 = document.getElementById('rate3').childNodes;

      if(rate3 == "") {
        for (var i = 0; i < opts3.length; i++) {
          if (opts3[i].value === rate3) {
            rate3 = opts3[i].value;
            break;
          }
        }
      }

      var art3 = document.getElementById('art3').value;
      var wt3 = document.getElementById('wt3').value;
      //var rate3 = document.getElementById('rate3').value;
      var per3 = document.getElementById('per3').value;
      if (per3 == 'Art') {
        var result3 = parseInt(art3) * parseFloat(rate3);
      } else if (per3 == 'Kg') {
        var result3 = parseInt(wt3) * parseFloat(rate3);
      } else {
        var result3 = parseInt(rate3);
      }
      if (!isNaN(result3)) {
        document.getElementById('amount3').value = result3;
      }

      var rate4 = document.getElementById("inputrate4").value;
      var opts4 = document.getElementById('rate4').childNodes;

      if(rate4 == "") {
        for (var i = 0; i < opts4.length; i++) {
          if (opts4[i].value === rate4) {
            rate4 = opts4[i].value;
            break;
          }
        }
      }
      var art4 = document.getElementById('art4').value;
      var wt4 = document.getElementById('wt4').value;
      //var rate4 = document.getElementById('rate4').value;
      var per4 = document.getElementById('per4').value;
      if(per4 == 'Art')
      {
        var result4 = parseInt(art4) * parseFloat(rate4);
      } else if(per4 == 'Kg') {
        var result4 = parseInt(wt4) * parseFloat(rate4);
      } else {
        var result4 = parseInt(rate4);
      }

      if (!isNaN(result4)) {
        document.getElementById('amount4').value = result4;
      }
      var amount1 = Number(document.getElementById('amount1').value);
      var amount2 = Number(document.getElementById('amount2').value);
      var amount3 = Number(document.getElementById('amount3').value);
      var amount4 = Number(document.getElementById('amount4').value);


      var result5 = (amount1 + amount2 + amount3 + amount4);

      if (!isNaN(result5) && result5 != 0) {
        document.getElementById('freight1').value = result5;
      }
      var freight1 = Number(document.getElementById('freight1').value);
      var labour_charges = Number(document.getElementById('labour_charges').value);
      var st_charges = Number(document.getElementById('st_charges').value);
      var other_charges = Number(document.getElementById('other_charges').value);
      var pf = Number(document.getElementById('pf').value);
      var door_del = Number(document.getElementById('door_del').value);


      var lrtotal = (freight1 + labour_charges + st_charges + other_charges + pf + door_del);

      if (!isNaN(lrtotal) && lrtotal != 0) {
        document.getElementById('lr_total').value = lrtotal;
      }

    }


  </script>
</head>
<body>

<?php
$currentuser=$_SESSION['login_id'];
$servername = "localhost";
  $username = "root";
  $password = "";
  $database = "cms_db";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Die if connection was not successful
if (!$conn){
  die("Sorry we failed to connect: ". mysqli_connect_error());
}
else {
  $user = mysqli_query($conn,"SELECT branches.city FROM branches LEFT JOIN users ON branches.id = users.branch_id WHERE users.id =" . $currentuser);

  while ($userCity = $user->fetch_assoc()) {
    $city = $userCity['city'];
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  //$sno = $_POST['sno'];
  $lrno = $_POST['lrno'];
  $date = $_POST['date'];
  $manuallr = $_POST['manuallr'];
  $from1 = $_POST['from1'];
  $to1 = $_POST['to1'];
  $freighttype = $_POST['freighttype'];
  $consignor = $_POST['consignor'];
  $consignee = $_POST['consignee'];
  $articletype1 = $_POST['articletype1'];
  $art1 = $_POST['art1'];
  $wt1 = $_POST['wt1'];
  $rate1 = $_POST['rate1'];
  $per1 = $_POST['per1'];
  $amount1 = $_POST['amount1'];
  $articletype2 = $_POST['articletype2'];
  $art2 = $_POST['art2'];
  $wt2 = $_POST['wt2'];
  $rate2 = $_POST['rate2'];
  $per2 = $_POST['per2'];
  $amount2 = $_POST['amount2'];
  $articletype3 = $_POST['articletype3'];
  $art3 = $_POST['art3'];
  $wt3 = $_POST['wt3'];
  $rate3 = $_POST['rate3'];
  $per3 = $_POST['per3'];
  $amount3 = $_POST['amount3'];
  $articletype4 = $_POST['articletype4'];
  $art4 = $_POST['art4'];
  $wt4 = $_POST['wt4'];
  $rate4 = $_POST['rate4'];
  $per4 = $_POST['per4'];
  $amount4 = $_POST['amount4'];
  $freight1 = $_POST['freight1'];
  $labour_charges = $_POST['labour_charges'];
  $st_charges = $_POST['st_charges'];
  $other_charges = $_POST['other_charges'];
  $pf = $_POST['pf'];
  $door_del = $_POST['door_del'];
  $lr_total = $_POST['lr_total'];
  $content = $_POST['content'];
  $actualwt = $_POST['actualwt'];
  $invoice = $_POST['invoice'];
  $value = $_POST['value'];
  $eway = $_POST['eway'];
  $madeby = $_POST['madeby'];
  $remark = $_POST['remark'];

  // Connecting to the Database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "cms_db";

  // Create a connection
  $conn = mysqli_connect($servername, $username, $password, $database);
  // Die if connection was not successful
  if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
  }
  else{
    if($_POST['manuallr'] != 0 && strlen($_POST['manuallr']) != 6){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Manual LR number should be 6 digit Number!
          </div>';
     } else {
      // Submit these to a database
      $selectQueryy = "SELECT * FROM new_parcel WHERE lrno='$lrno' ";
      $select_query_runn = mysqli_query($conn, $selectQueryy);

      if(mysqli_num_rows($select_query_runn) > 0) {
        foreach ($select_query_runn as $selectRoww) {
          $updatequery = "UPDATE new_parcel SET date='$date',manuallr='$manuallr',from1='$from1',to1='$to1',freighttype='$freighttype',consignor='$consignor',consignee='$consignee',articletype1='$articletype1',art1='$art1',wt1='$wt1',rate1='$rate1',per1='$per1',amount1='$amount1',articletype2='$articletype2',art2='$art2',wt2='$wt2',rate2='$rate2',per2='$per2',amount2='$amount2',articletype3='$articletype3',art3='$art3',wt3='$wt3',rate3='$rate3',per3='$per3',amount3='$amount3',articletype4='$articletype4',art4='$art4',wt4='$wt4',rate4='$rate4',per4='$per4',amount4='$amount4',freight1='$freight1',labour_charges='$labour_charges',st_charges='$st_charges',other_charges='$other_charges',pf='$pf',door_del='$door_del',lr_total='$lr_total',content='$content',actualwt='$actualwt',invoice='$invoice',value='$value',eway='$eway',madeby='$madeby',remark='$remark' WHERE lrno='$lrno'";
          $update_query_runn = mysqli_query($conn, $updatequery);
          if ($update_query_runn) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been updated successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
          } else {
            // echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Your entry was not updated successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
          }
        }
        } else {
        $sql = "INSERT INTO `new_parcel` (`date`, `manuallr`, `from1`, `to1`, `freighttype`, `consignor`, `consignee`, `articletype1`, `art1`, `wt1`, `rate1`, `per1`, `amount1`, `articletype2`, `art2`, `wt2`, `rate2`, `per2`, `amount2`, `articletype3`, `art3`, `wt3`, `rate3`, `per3`, `amount3`, `articletype4`, `art4`, `wt4`, `rate4`, `per4`, `amount4`,  `freight1`, `labour_charges`, `st_charges`, `other_charges`, `pf`, `door_del`, `lr_total`,`content`, `actualwt`, `invoice`, `value`, `eway`, `madeby`, `remark`) VALUES ('$date', '$manuallr', '$from1', '$to1','$freighttype','$consignor', '$consignee','$articletype1','$art1','$wt1','$rate1','$per1','$amount1','$articletype2','$art2','$wt2','$rate2','$per2','$amount2','$articletype3','$art3','$wt3','$rate3','$per3','$amount3','$articletype4','$art4','$wt4','$rate4','$per4','$amount4', '$freight1', '$labour_charges', '$st_charges', '$other_charges', '$pf', '$door_del', '$lr_total','$content', '$actualwt', '$invoice', '$value', '$eway', '$madeby', '$remark')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
          $last_id = mysqli_insert_id($conn);
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been submitted successfully! <a href="fpdf/printpdf.php?id=' . $last_id . '" target="_blank">Print</a>
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
  }

}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['page'] == 'edit_parcel'){
    $lnNum = $_GET['id'];
$selectQuery = "SELECT * FROM new_parcel WHERE lrno='$lnNum' ";
$select_query_run = mysqli_query($conn, $selectQuery);

if(mysqli_num_rows($select_query_run) > 0) {
  foreach ($select_query_run as $selectRow) {
    $lrnoval = $selectRow['lrno'];
    $dateval = $selectRow['date'];
    $manuallrval = $selectRow['manuallr'];
    $from1val = $selectRow['from1'];
    $to1val = $selectRow['to1'];
    $freighttypeval = $selectRow['freighttype'];
    $consignorval = $selectRow['consignor'];
    $consigneeval = $selectRow['consignee'];
    $articletype1val = $selectRow['articletype1'];
    $art1val = $selectRow['art1'];
    $wt1val = $selectRow['wt1'];
    $rate1val = $selectRow['rate1'];
    $per1val = $selectRow['per1'];
    $amount1val = $selectRow['amount1'];
    $articletype2val = $selectRow['articletype2'];
    $art2val = $selectRow['art2'];
    $wt2val = $selectRow['wt2'];
    $rate2val = $selectRow['rate2'];
    $per2val = $selectRow['per2'];
    $amount2val = $selectRow['amount2'];
    $articletype3val = $selectRow['articletype3'];
    $art3val = $selectRow['art3'];
    $wt3val = $selectRow['wt3'];
    $rate3val = $selectRow['rate3'];
    $per3val = $selectRow['per3'];
    $amount3val = $selectRow['amount3'];
    $articletype4val = $selectRow['articletype4'];
    $art4val = $selectRow['art4'];
    $wt4val = $selectRow['wt4'];
    $rate4val = $selectRow['rate4'];
    $per4val = $selectRow['per4'];
    $amount4val = $selectRow['amount4'];
    $freight1val = $selectRow['freight1'];
    $labour_chargesval = $selectRow['labour_charges'];
    $st_chargesval = $selectRow['st_charges'];
    $other_chargesval = $selectRow['other_charges'];
    $pfval = $selectRow['pf'];
    $door_delval = $selectRow['door_del'];
    $lr_totalval = $selectRow['lr_total'];
    $contentval = $selectRow['content'];
    $actualwtval = $selectRow['actualwt'];
    $invoiceval = $selectRow['invoice'];
    $valueval = $selectRow['value'];
    $ewayval = $selectRow['eway'];
    $madebyval = $selectRow['madeby'];
    $remarkval = $selectRow['remark'];




    ?>
    <script>
      $(document).ready(function(){
        var lrnoval = "<?php echo $lrnoval; ?>";
        var dateval = "<?php echo $dateval; ?>";
        var manuallrval = "<?php echo $manuallrval; ?>";
        var from1val = "<?php echo $from1val; ?>";
        var to1val = "<?php echo $to1val; ?>";
        var freighttypeval = "<?php echo $freighttypeval; ?>";
        var consignorval = "<?php echo $consignorval; ?>";
        var consigneeval = "<?php echo $consigneeval; ?>";
        var articletype1val = "<?php echo $articletype1val; ?>";
        var art1val = "<?php echo $art1val; ?>";
        var wt1val = "<?php echo $wt1val; ?>";
        var rate1val = "<?php echo $rate1val; ?>";
        var per1val = "<?php echo $per1val; ?>";
        var amount1val = "<?php echo $amount1val; ?>";
        var articletype2val = "<?php echo $articletype2val; ?>";
        var art2val = "<?php echo $art2val; ?>";
        var wt2val = "<?php echo $wt2val; ?>";
        var rate2val = "<?php echo $rate2val; ?>";
        var per2val = "<?php echo $per2val; ?>";
        var amount2val = "<?php echo $amount2val; ?>";
        var articletype3val = "<?php echo $articletype3val; ?>";
        var art3val = "<?php echo $art3val; ?>";
        var wt3val = "<?php echo $wt3val; ?>";
        var rate3val = "<?php echo $rate3val; ?>";
        var per3val = "<?php echo $per3val; ?>";
        var amount3val = "<?php echo $amount3val; ?>";
        var articletype4val = "<?php echo $articletype4val; ?>";
        var art4val = "<?php echo $art4val; ?>";
        var wt4val = "<?php echo $wt4val; ?>";
        var rate4val = "<?php echo $rate4val; ?>";
        var per4val = "<?php echo $per4val; ?>";
        var amount4val = "<?php echo $amount4val; ?>";
        var freight1val = "<?php echo $freight1val; ?>";
        var labour_chargesval = "<?php echo $labour_chargesval; ?>";
        var st_chargesval = "<?php echo $st_chargesval; ?>";
        var other_chargesval = "<?php echo $other_chargesval; ?>";
        var pfval = "<?php echo $pfval; ?>";
        var door_delval = "<?php echo $door_delval; ?>";
        var lr_totalval = "<?php echo $lr_totalval; ?>";
        var contentval = "<?php echo $contentval; ?>";
        var actualwtval = "<?php echo $actualwtval; ?>";
        var invoiceval = "<?php echo $invoiceval; ?>";
        var valueval = "<?php echo $valueval; ?>";
        var ewayval = "<?php echo $ewayval; ?>";
        var madebyval = "<?php echo $madebyval; ?>";
        var remarkval = "<?php echo $remarkval; ?>";




        $("#lrno").val(lrnoval);
        $("#date").val(dateval);
        $("#manuallr").val(manuallrval);
        $("#from").val(from1val);
        $("#station").val(to1val);
        $("#freighttype").val(freighttypeval);
        $("#consignor").val(consignorval);
        $("#consignee").val(consigneeval);
        $("#articletype").val(articletype1val);
        $("#art1").val(art1val);
        $("#wt1").val(wt1val);
        $("#inputrate1").val(rate1val);
        $("#per1").val(per1val);
        $("#amount1").val(amount1val);
        $("#articletypetwo").val(articletype2val);
        $("#art2").val(art2val);
        $("#wt2").val(wt2val);
        $("#inputrate2").val(rate2val);
        $("#per2").val(per2val);
        $("#amount2").val(amount2val);
        $("#articletypethree").val(articletype3val);
        $("#art3").val(art3val);
        $("#wt3").val(wt3val);
        $("#inputrate3").val(rate3val);
        $("#per3").val(per3val);
        $("#amount3").val(amount3val);
        $("#articletypefour").val(articletype4val);
        $("#art4").val(art4val);
        $("#wt4").val(wt4val);
        $("#inputrate4").val(rate4val);
        $("#per4").val(per4val);
        $("#amount4").val(amount4val);
        $("#freight1").val(freight1val);
        $("#labour_charges").val(labour_chargesval);
        $("#st_charges").val(st_chargesval);
        $("#other_charges").val(other_chargesval);
        $("#pf").val(pfval);
        $("#door_del").val(door_delval);
        $("#lr_total").val(lr_totalval);
        $("#content1").val(contentval);
        $("#actualwt").val(actualwtval);
        $("#invoice").val(invoiceval);
        $("#value").val(valueval);
        $("#eway").val(ewayval);
        $("#madeby").val(madebyval);
        $("#remark").val(remarkval);



      });
    </script>
  <?php }
}
}
date_default_timezone_set("Asia/Kolkata");
?>

<form action="/cms/index.php?page=new_parcel" method="post" onsubmit="return confirm('Are you sure you want to submit this LR Entry?');">
  <div class="row g-3">
    <div class="col-sm-2">
      <input type="text" name="lrno" class="form-control form-control-sm" id="lrno" placeholder="LR No." aria-label="LR No." readonly>
    </div>
    <div class="col-sm-2">
      <input type="date" name="date" class="form-control form-control-sm" id="date" placeholder="Date" aria-label="Date" value="<?php echo date('Y-m-d');?>">
    </div>
    <div class="col-sm-2">
      <input type="text" name="manuallr" class="form-control form-control-sm" id="manuallr" placeholder="Manual LR No." aria-label="Manual LR No.">
    </div>
  </div>

  <div class="row g-3 my-1">
    <div class="col-sm-3">
      <input list="from1" name="from1" id="from" type="text" class="form-control form-control-sm" placeholder="From" aria-label="From" value="<?php echo $city; ?>" required readonly>
      <datalist id="from1">
        <?php
        $branches = $conn->query("SELECT *,concat(city) as city FROM branches");
        while($row = $branches->fetch_assoc()):
          ?>
          <option value="<?php echo $row['city'] ?>"><?php echo $row['city']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-3">
      <input list="to1" name="to1" id="station" type="to1" class="form-control form-control-sm" placeholder="To" aria-label="To" oninput="this.value = this.value.toUpperCase()" required>
      <datalist id="to1">
        <?php
        $branches = $conn->query("SELECT *,concat(city) as city FROM branches");
        while($row = $branches->fetch_assoc()):
          ?>
          <option value="<?php echo $row['city'] ?>"><?php echo $row['city']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>


    <div class="col-sm-3">
      <label class="visually-hidden" for="freighttype">Freight Type</label>
      <select class="form-select form-select-sm" id="freighttype" name="freighttype">
        <option value="">Select Freight Type</option>
        <option selected value="ToPay">ToPay</option>
        <option value="Paid">Paid</option>
        <option value="TBB">TBB</option>
        <option value="FOC">FOC</option>
      </select>
    </div>
  </div>


  <div class="row g-3 my-1">
    <div class="col-sm-3">
      <input list="consignor1" id="consignor"name="consignor" type="text" class="form-control form-control-sm" placeholder="Consignor" aria-label="Consignor" oninput="this.value = this.value.toUpperCase()">
      <datalist id="consignor1">
        <?php
        $new_party = $conn->query("SELECT *,concat(party_name) as party_name FROM new_party");
        while($row = $new_party->fetch_assoc()):
          ?>
          <option value="<?php echo $row['party_name'] ?>"><?php echo $row['party_name']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-3">
      <input list="consignee1" id="consignee"name="consignee" type="text" class="form-control form-control-sm" placeholder="Consignee" aria-label="Consignee" oninput="this.value = this.value.toUpperCase()">
      <datalist id="consignee1">
        <?php
        $new_party = $conn->query("SELECT *,concat(party_name) as party_name FROM new_party");
        while($row = $new_party->fetch_assoc()):
          ?>
          <option value="<?php echo $row['party_name'] ?>"><?php echo $row['party_name']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>
  </div>

  <hr class="border-primary">
  <!-- Article type -1 Start -->

  <div class="row g-3">
    <div class="col-sm-2">
      <input list="articletype1" name="articletype1" id="articletype" type="text" class="form-control form-control-sm" placeholder="Article Type" aria-label="articletype1" oninput="this.value = this.value.toUpperCase()">
      <datalist id="articletype1">
        <?php
        $new_article = $conn->query("SELECT *,concat(article) as article FROM new_article");
        while($row = $new_article->fetch_assoc()):
          ?>
          <option value="<?php echo $row['article'] ?>"><?php echo $row['article']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-1">
      <input type="text" name="art1" class="form-control form-control-sm" id="art1" placeholder="Art" aria-label="art1" onkeyup="sum()">
    </div>
    <div class="col-sm-1">
      <input type="text" name="wt1" class="form-control form-control-sm" id="wt1" placeholder="Wt" aria-label="wt1" onkeyup="sum()">
    </div>

    <div class="col-sm-2">
      <input list="rate1" name="rate1" type="text" class="form-control form-control-sm" placeholder="Rate" aria-label="Rate" oninput='sum()' id='inputrate1' list='rate1'>
      <datalist id='rate1'>
        <?php
        $party_rate = $conn->query("SELECT *,concat(party_rate) as party_rate FROM party_rate");
        while($row = $party_rate->fetch_assoc()):
          ?>
          <option value="<?php echo $row['party_rate'] ?>"><?php echo $row['party_rate']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-2">
      <label class="visually-hidden" for="per1">Per</label>
      <select class="form-select form-select-sm" id="per1" name="per1" onchange="sum()">
        <option value="">Select</option>
        <option value="Kg">Kg</option>
        <option selected value="Art">Art</option>
        <option value="Fixed">Fixed</option>
      </select>
    </div>
    <div class="col-sm-2">
      <input type="text" name="amount1" class="form-control form-control-sm" id="amount1" placeholder="Amount" aria-label="amount1" readonly>
    </div>
  </div>

  <!-- Article type -1 End -->

  <!-- Article type -2 Start -->
  <div class="row g-3 my-1">
    <div class="col-sm-2">
      <input list="articletype2" name="articletype2" id="articletypetwo" type="text" class="form-control form-control-sm" placeholder="Article Type" aria-label="Article Type" oninput="this.value = this.value.toUpperCase()">
      <datalist id="articletype2">
        <?php
        $new_article = $conn->query("SELECT *,concat(article) as article FROM new_article");
        while($row = $new_article->fetch_assoc()):
          ?>
          <option value="<?php echo $row['article'] ?>"><?php echo $row['article']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-1">
      <input type="text" name="art2" class="form-control form-control-sm" id="art2" placeholder="Art" aria-label="Art" onkeyup="sum()">
    </div>
    <div class="col-sm-1">
      <input type="text" name="wt2" class="form-control form-control-sm" id="wt2" placeholder="Wt" aria-label="Wt" onkeyup="sum()">
    </div>

    <div class="col-sm-2">
      <input list="rate2" name="rate2" type="text" class="form-control form-control-sm" placeholder="Rate" aria-label="Rate" oninput='sum()' id='inputrate2' list='rate2'>
      <datalist id='rate2'>
        <?php
        $party_rate = $conn->query("SELECT *,concat(party_rate) as party_rate FROM party_rate");
        while($row = $party_rate->fetch_assoc()):
          ?>
          <option value="<?php echo $row['party_rate'] ?>"><?php echo $row['party_rate']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-2">
      <label class="visually-hidden" for="per2">Per</label>
      <select class="form-select form-select-sm" id="per2" name="per2" onchange="sum()">
        <option value="">Select</option>
        <option value="Kg">Kg</option>
        <option selected value="Art">Art</option>
        <option value="Fixed">Fixed</option>
      </select>
    </div>
    <div class="col-sm-2">
      <input type="text" name="amount2" class="form-control form-control-sm" id="amount2" placeholder="Amount" aria-label="Amount" readonly>
    </div>
  </div>
  <!-- Article type -2 End -->

  <!-- Article type -3 Start -->
  <div class="row g-3 my-1">
    <div class="col-sm-2">
      <input list="articletype3" name="articletype3" id="articletypethree" type="text" class="form-control form-control-sm" placeholder="Article Type" aria-label="Article Type" oninput="this.value = this.value.toUpperCase()">
      <datalist id="articletype3">
        <?php
        $new_article = $conn->query("SELECT *,concat(article) as article FROM new_article");
        while($row = $new_article->fetch_assoc()):
          ?>
          <option value="<?php echo $row['article'] ?>"><?php echo $row['article']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-1">
      <input type="text" name="art3" class="form-control form-control-sm" id="art3" placeholder="Art" aria-label="Art" onkeyup="sum()">
    </div>
    <div class="col-sm-1">
      <input type="text" name="wt3" class="form-control form-control-sm" id="wt3" placeholder="Wt" aria-label="Wt" onkeyup="sum()">
    </div>

    <div class="col-sm-2">
      <input list="rate3" name="rate3" type="text" class="form-control form-control-sm" placeholder="Rate" aria-label="Rate" oninput='sum()' id='inputrate3' list='rate3'>
      <datalist id='rate3'>
        <?php
        $party_rate = $conn->query("SELECT *,concat(party_rate) as party_rate FROM party_rate");
        while($row = $party_rate->fetch_assoc()):
          ?>
          <option value="<?php echo $row['party_rate'] ?>"><?php echo $row['party_rate']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-2">
      <label class="visually-hidden" for="per3">Per</label>
      <select class="form-select form-select-sm" id="per3" name="per3" onchange="sum()">
        <option value="">Select</option>
        <option value="Kg">Kg</option>
        <option selected value="Art">Art</option>
        <option value="Fixed">Fixed</option>
      </select>
    </div>
    <div class="col-sm-2">
      <input type="text" name="amount3" class="form-control form-control-sm" id="amount3" placeholder="Amount" aria-label="Amount" readonly>
    </div>
  </div>
  <!-- Article type -3 End -->

  <!-- Article type -4 Start -->

  <div class="row g-3 my-1">
    <div class="col-sm-2">
      <input list="articletype4" name="articletype4" id="articletypefour" type="text" class="form-control form-control-sm" placeholder="Article Type" aria-label="Article Type" oninput="this.value = this.value.toUpperCase()">
      <datalist id="articletype4">
        <?php
        $new_article = $conn->query("SELECT *,concat(article) as article FROM new_article");
        while($row = $new_article->fetch_assoc()):
          ?>
          <option value="<?php echo $row['article'] ?>"><?php echo $row['article']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-1">
      <input type="text" name="art4" class="form-control form-control-sm" id="art4" placeholder="Art" aria-label="Art" onkeyup="sum()">
    </div>
    <div class="col-sm-1">
      <input type="text" name="wt4" class="form-control form-control-sm" id="wt4" placeholder="Wt" aria-label="Wt" onkeyup="sum()">
    </div>

    <div class="col-sm-2">
      <input list="rate4" name="rate4" type="text" class="form-control form-control-sm" placeholder="Rate" aria-label="Rate" oninput='sum()' id='inputrate4' list='rate4'>
      <datalist id='rate4'>
        <?php
        $party_rate = $conn->query("SELECT *,concat(party_rate) as party_rate FROM party_rate");
        while($row = $party_rate->fetch_assoc()):
          ?>
          <option value="<?php echo $row['party_rate'] ?>"><?php echo $row['party_rate']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-2">
      <label class="visually-hidden" for="per4">Per</label>
      <select class="form-select form-select-sm" id="per4" name="per4" onchange="sum()">
        <option value="">Select</option>
        <option value="Kg">Kg</option>
        <option selected value="Art">Art</option>
        <option value="Fixed">Fixed</option>
      </select>
    </div>
    <div class="col-sm-2">
      <input type="text" name="amount4" class="form-control form-control-sm" id="amount4" placeholder="Amount" aria-label="Amount" readonly>
    </div>
  </div>
  <!-- Article type -4 End -->

  <hr class="border-primary">

  <div class="row g-3">
    <div class="col-sm-1">
      <input type="text" name="freight1" class="form-control form-control-sm" id="freight1" placeholder="Freight" aria-label="freight1" onkeyup="sum()" readonly>
    </div>
    <div class="col-sm-2">
      <input type="text" name="labour_charges" class="form-control form-control-sm" id="labour_charges" placeholder="Labour Charges" aria-label="labour_charges" onkeyup="sum()">
    </div>
    <div class="col-sm-2">
      <input type="text" name="st_charges" class="form-control form-control-sm" id="st_charges" placeholder="St. Charges" aria-label="st_charges" onkeyup="sum()">
    </div>
    <div class="col-sm-2">
      <input type="text" name="other_charges" class="form-control form-control-sm" id="other_charges" placeholder="Other Charges" aria-label="other_charges" onkeyup="sum()">
    </div>
    <div class="col-sm-1">
      <input type="text" name="pf" class="form-control form-control-sm" id="pf" placeholder="PF" aria-label="pf" onkeyup="sum()">
    </div>
    <div class="col-sm-2">
      <input type="text" name="door_del" class="form-control form-control-sm" id="door_del" placeholder="Door Del. Charges" aria-label="door_del" onkeyup="sum()">
    </div>
    <div class="col-sm-2">
      <input type="text" name="lr_total" class="form-control form-control-sm" id="lr_total" placeholder="LR Total" aria-label="lr_total" readonly>
    </div>
  </div>

  <hr class="border-primary">

  <div class="row g-3">
    <div class="col-sm-2">
      <input list="content" name="content" id="content1" type="text" class="form-control form-control-sm" placeholder="Content" aria-label="content" oninput="this.value = this.value.toUpperCase()">
      <datalist id="content">
        <?php
        $new_content = $conn->query("SELECT *,concat(content1) as content1 FROM new_content");
        while($row = $new_content->fetch_assoc()):
          ?>
          <option value="<?php echo $row['content1'] ?>"><?php echo $row['content1']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-2">
      <input type="text" name="actualwt" class="form-control form-control-sm" id="actualwt" placeholder="Actual Wt." aria-label="actualwt">
    </div>
    <div class="col-sm-2">
      <input type="text" name="invoice" class="form-control form-control-sm" id="invoice" placeholder="Invoice No. /PM." aria-label="invoice">
    </div>
    <div class="col-sm-1">
      <input type="text" name="value" class="form-control form-control-sm" id="value" placeholder="Value" aria-label="value">
    </div>
    <div class="col-sm-1">
      <input type="text" name="eway" class="form-control form-control-sm" id="eway" placeholder="E Way Bill No." aria-label="eway">
    </div>
    <div class="col-sm-2">
      <input type="text" name="madeby" class="form-control form-control-sm" id="madeby" placeholder="Made By" aria-label="madeby" value="<?php echo $_SESSION['login_name'] ?>" readonly>
    </div>
    <div class="col-sm-2">
      <input type="text" name="remark" class="form-control form-control-sm" id="remark" placeholder="Remark" aria-label="remark">
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
</form>

<script>
$("#consignor").on('input', function () {
    var val = this.value;
    if($('#consignor1 option').filter(function(){
        //return this.value.toUpperCase() === val.toUpperCase();
        return this.value;
    }).length) {
        //send ajax request
        var optionId = this.value;
      var station = document.getElementById('station').value;
        $.ajax({
        url: 'ajaxfile.php',
        type: 'post',
        data: {
          optionId: optionId,
          station: station
          },
          dataType: 'json',
        success: function(response){
          if(response.party_freighttype) {
            var frightType = response.party_freighttype;
            $("#freighttype option[value=" + frightType + "]").attr('selected', 'selected');
          }
        }
      });
    }
});
$("#articletype").on('input', function () {
  var val = this.value;
  if($('#articletype1 option').filter(function(){
    //return this.value.toUpperCase() === val.toUpperCase();
    return this.value;
  }).length) {
    //send ajax request
    var articletype = this.value;
    var station = document.getElementById('station').value;
    var consignor = document.getElementById('consignor').value;
    var from = document.getElementById('from').value;
    $.ajax({
      url: 'ajaxfile.php',
      type: 'post',
      data: {
        articletype: articletype,
        station: station,
        consignor: consignor,
        from: from
      },
      dataType: 'json',
      success: function(response){
        if(response != '') {
          var partyper = response.party_per;
          var partyrate = response.party_rate;
          $("#per1 option[value=" + partyper + "]").attr('selected', 'selected');
          document.getElementById('inputrate1').value = partyrate;
        }
      }
    });
  }
});
$("#articletypetwo").on('input', function () {
  var val = this.value;
  if($('#articletype2 option').filter(function(){
    //return this.value.toUpperCase() === val.toUpperCase();
    return this.value;
  }).length) {
    //send ajax request
    var articletype = this.value;
    var station = document.getElementById('station').value;
    var consignor = document.getElementById('consignor').value;
    $.ajax({
      url: 'ajaxfile.php',
      type: 'post',
      data: {
        articletype: articletype,
        station: station,
        consignor: consignor
      },
      dataType: 'json',
      success: function(response){
        if(response != '') {
          var partyper = response.party_per;
          var partyrate = response.party_rate;
          $("#per2 option[value=" + partyper + "]").attr('selected', 'selected');
          document.getElementById('inputrate2').value = partyrate;
        }
      }
    });
  }
});
$("#articletypethree").on('input', function () {
  var val = this.value;
  if($('#articletype3 option').filter(function(){
    //return this.value.toUpperCase() === val.toUpperCase();
    return this.value;
  }).length) {
    //send ajax request
    var articletype = this.value;
    var station = document.getElementById('station').value;
    var consignor = document.getElementById('consignor').value;
    $.ajax({
      url: 'ajaxfile.php',
      type: 'post',
      data: {
        articletype: articletype,
        station: station,
        consignor: consignor
      },
      dataType: 'json',
      success: function(response){
        if(response != '') {
          var partyper = response.party_per;
          var partyrate = response.party_rate;
          $("#per3 option[value=" + partyper + "]").attr('selected', 'selected');
          document.getElementById('inputrate3').value = partyrate;
        }
      }
    });
  }
});
$("#articletypefour").on('input', function () {
  var val = this.value;
  if($('#articletype4 option').filter(function(){
    //return this.value.toUpperCase() === val.toUpperCase();
    return this.value;
  }).length) {
    //send ajax request
    var articletype = this.value;
    var station = document.getElementById('station').value;
    var consignor = document.getElementById('consignor').value;
    $.ajax({
      url: 'ajaxfile.php',
      type: 'post',
      data: {
        articletype: articletype,
        station: station,
        consignor: consignor
      },
      dataType: 'json',
      success: function(response){
        if(response != '') {
          var partyper = response.party_per;
          var partyrate = response.party_rate;
          $("#per4 option[value=" + partyper + "]").attr('selected', 'selected');
          document.getElementById('inputrate4').value = partyrate;
        }
      }
    });
  }
});
</script>
<!--<script src="https://text.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script>
  $(document).ready(function () {
    var i = 1;
     $('#add').click(function () {
      i++;
      $('#dynamic_field').append('<div class="form-row" id="row' + i + '"> <div class="col-md-2"><label for="articletype" class="form-label form-control-sm">Article Type</label><input type="text" name="articletype" class="form-control" id="articletype"></div><div class="col-md-1"><label for="art" class="form-label form-control-sm">Art</label><input type="text" name="art" class="form-control" id="art"></div><div class="col-md-1"><label for="wt" class="form-label form-control-sm">Wt</label><input type="text" name="wt" class="form-control" id="wt"></div><div class="col-md-2"><label for="rate" class="form-label form-control-sm">Rate</label><input type="text" name="rate" class="form-control" id="rate"></div><div class="col-md-1"><label for="per" name="per" class="form-label form-control-sm">Per</label><select id="per" class="form-select"><option selected>Art</option><option>TBB</option><option>FOC</option></select></div><div class="col-md-2"><label for="amount" class="form-label form-control-sm">Amount</label><input type="text" name="amount" class="form-control" id="amount"></div><div class="col"> <td><button type="button" name="add" class="btn btn-danger btn_remove" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
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

