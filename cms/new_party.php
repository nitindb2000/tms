<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  </head>
<body>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      //$sno = $_POST['sno'];
      $party_code = $_POST['party_code'];
      $party_name = $_POST['party_name'];
      $party_city = $_POST['party_city'];
      $party_add = $_POST['party_add'];
      $party_state = $_POST['party_state'];
      $party_pin = $_POST['party_pin'];
      $party_contact = $_POST['party_contact'];
      $party_type = $_POST['party_type'];
      $credit_period = $_POST['credit_period'];

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
        // Submit these to a database
        $sql = "INSERT INTO `new_party` (`id`, `party_code`, `party_name`, `party_city`, `party_add`, `party_state`, `party_pin`, `party_contact`, `party_type`, `credit_period`) VALUES ('', '$party_code', '$party_name', '$party_city', '$party_add', '$party_state', '$party_pin', '$party_contact', '$party_type', '$credit_period')";
       // $sql = "INSERT INTO `new_parcel` (`id`, `lrno`, `date`, `manuallr`, `from1`, `to1`, `freighttype`, `consignor`, `consignee`, `articletype1`, `art1`, `wt1`, `rate1`, `per1`, `amount1`, `articletype2`, `art2`, `wt2`, `rate2`, `per2`, `amount2`, `articletype3`, `art3`, `wt3`, `rate3`, `per3`, `amount3`, `articletype4`, `art4`, `wt4`, `rate4`, `per4`, `amount4`,`content`, `actualwt`, `invoice`, `value`, `eway`, `madeby`, `remark`) VALUES ('', '$lrno', '$date', '$manuallr', '$from1', '$to1','$freighttype','$consignor', '$consignee','$articletype1','$art1','$wt1','$rate1','$per1','$amount1','$articletype2','$art2','$wt2','$rate2','$per2','$amount2','$articletype3','$art3','$wt3','$rate3','$per3','$amount3','$articletype4','$art4','$wt4','$rate4','$per4','$amount4','$content', '$actualwt', '$invoice', '$value', '$eway', '$madeby', '$remark')";

        $result = mysqli_query($conn, $sql);

        if($result){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been submitted successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        }
        else{
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

?>

<div class="card border-secondary mb-3" style="max-width: 66rem;">
<div class="card-body">
<form action="/cms/index.php?page=new_party" method="post">
  <div class="col-md-2">
    <label for="party_code" class="form-label">Code</label>
    <input type="text" name="party_code" class="form-control" id="party_code">
  </div>
    <break>
  <div class="col-md-6">
    <label for="party_name" class="form-label">Name</label>
    <input type="text" name="party_name" class="form-control" id="party_name">
  </div>

  <div class="row g-3">
  <div class="col-md-4">
    <label for="party_city" class="form-label">City</label>
    <input type="text" name="party_city" class="form-control" id="party_city">
  </div>

  <div class="col-md-6">
    <label for="party_add" class="form-label">Address</label>
    <input type="text" name="party_add" class="form-control" id="party_add">
  </div>

   <div class="col-md-4">
    <label for="party_state" class="form-label">State</label>
    <select id="party_state" name="party_state" class="form-select">

      <option value="AN">Andaman and Nicobar Islands</option>
    <option value="AP">Andhra Pradesh</option>
    <option value="AR">Arunachal Pradesh</option>
    <option value="AS">Assam</option>
    <option value="BR">Bihar</option>
    <option value="CH">Chandigarh</option>
    <option value="CT">Chhattisgarh</option>
    <option value="DN">Dadra and Nagar Haveli</option>
    <option value="DD">Daman and Diu</option>
    <option value="DL">Delhi</option>
    <option value="GA">Goa</option>
    <option value="GJ">Gujarat</option>
    <option value="HR">Haryana</option>
    <option value="HP">Himachal Pradesh</option>
    <option value="JK">Jammu and Kashmir</option>
    <option value="JH">Jharkhand</option>
    <option value="KA">Karnataka</option>
    <option value="KL">Kerala</option>
    <option value="LA">Ladakh</option>
    <option value="LD">Lakshadweep</option>
    <option value="MP">Madhya Pradesh</option>
    <option Selected value="MH">Maharashtra</option>
    <option value="MN">Manipur</option>
    <option value="ML">Meghalaya</option>
    <option value="MZ">Mizoram</option>
    <option value="NL">Nagaland</option>
    <option value="OR">Odisha</option>
    <option value="PY">Puducherry</option>
    <option value="PB">Punjab</option>
    <option value="RJ">Rajasthan</option>
    <option value="SK">Sikkim</option>
    <option value="TN">Tamil Nadu</option>
    <option value="TG">Telangana</option>
    <option value="TR">Tripura</option>
    <option value="UP">Uttar Pradesh</option>
    <option value="UT">Uttarakhand</option>
    <option value="WB">West Bengal</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="party_pin" class="form-label">Pin</label>
    <input type="int" name="party_pin" class="form-control" id="party_pin">
  </div>
  <div class="col-md-2">
    <label for="party_contact" class="form-label">Contact No</label>
    <input type="text" name="party_contact" class="form-control" id="party_contact">
  </div>
  <hr class="border-primary">
  <div class="col-md-4">
    <label for="party_type" class="form-label">Party Type</label>
    <select id="party_type" name="party_type" class="form-select">
      <option selected>Consignor</option>
      <option>Consignee</option>
    </select>
  </div>

  <div class="col-md-2">
    <label for="credit_period" class="form-label">Credit Period</label>
    <input type="text" name="credit_period" class="form-control" id="credit_period">
  </div>
  <br>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</form>
  </div>
  </div>

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
