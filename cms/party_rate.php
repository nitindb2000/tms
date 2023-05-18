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
      $party_name1 = $_POST['party_name1'];
      $party_freighttype = $_POST['party_freighttype'];
      $from4 = $_POST['from4'];
      $station = $_POST['station'];
      $party_articletype = $_POST['party_articletype'];
      $party_rate = $_POST['party_rate'];
      $party_per = $_POST['party_per'];


            // Connecting to the Database
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
      else{
        // Submit these to a database

        $sql = "INSERT INTO `party_rate` (`id`, `party_name1`, `party_freighttype`, `from4`,`station`, `party_articletype`, `party_rate`, `party_per`) VALUES ('','$party_name1', '$party_freighttype', '$from4', '$station', '$party_articletype', '$party_rate', '$party_per')";
       // $sql = "INSERT INTO `new_party` (`id`, `party_code`, `party_name`, `party_city`, `party_add`, `party_state`, `party_pin`, `party_contact`, `party_type`, `credit_period`) VALUES ('', '$party_code', '$party_name', '$party_city', '$party_add', '$party_state', '$party_pin', '$party_contact', '$party_type', '$credit_period')";

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
<form action="/cms/index.php?page=party_rate" method="post" onsubmit="return confirm('Are you want to save this Party Rate?');">
<div class="row g-3 my-1">
<div class="col-sm-3">
      <input list="party_name1" name="party_name1" type="party_name1" class="form-control form-control-sm" placeholder="Party" aria-label="Party">
      <datalist id="party_name1">
        <?php
        $branches = $conn->query("SELECT *,concat(party_name) as party_name FROM new_party");
        while($row = $branches->fetch_assoc()):
          ?>
          <option value="<?php echo $row['party_name'] ?>"><?php echo $row['party_name']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-2">
      <label class="visually-hidden" for="party_freighttype">Per</label>
      <select class="form-select form-select-sm" id="party_freighttype" name="party_freighttype">
      <option selected value="ToPay">ToPay</option>
      <option value="Paid">Paid</option>
      <option value="TBB">TBB</option>
      <option value="FOC">FOC</option>
      </select>
    </div>


<?php
$currentuser=$_SESSION['login_id'];
$user = $conn->query("SELECT branches.city FROM branches LEFT JOIN users ON branches.id = users.branch_id WHERE users.id =" . $currentuser);
while ($userCity = $user->fetch_assoc()) {
  $city = $userCity['city'];
}
?>
    <div class="col-sm-3">
      <input list="from4" name="from4" type="text" class="form-control form-control-sm" placeholder="From" aria-label="From" value="<?php echo $city; ?>" required readonly>
      <datalist id="from4">
        <?php
        $branches = $conn->query("SELECT *,concat(city) as city FROM branches");
        while($row = $branches->fetch_assoc()):
          ?>
          <option value="<?php echo $row['city'] ?>"><?php echo $row['city']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>
  </div>

  <div class="row g-3 my-1">
<div class="col-sm-3">
      <input list="station" name="station" type="station" class="form-control form-control-sm" placeholder="Station" aria-label="Station">
      <datalist id="station">
      <?php
        $branches = $conn->query("SELECT *,concat(city) as city FROM branches");
        while($row = $branches->fetch_assoc()):
          ?>
          <option value="<?php echo $row['city'] ?>"><?php echo $row['city']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

  <div class="col-sm-3">
      <input list="party_articletype" name="party_articletype" type="party_articletype" class="form-control form-control-sm" placeholder="Article Type" aria-label="Article Type">
      <datalist id="party_articletype">
        <?php
        $branches = $conn->query("SELECT *,concat(article) as article FROM new_article");
        while($row = $branches->fetch_assoc()):
          ?>
          <option value="<?php echo $row['article'] ?>"><?php echo $row['article']?></option>
        <?php endwhile; ?>
      </datalist>
    </div>

    <div class="col-sm-2">
      <input type="text" name="party_rate" class="form-control form-control-sm" id="party_rate" placeholder="Rate" aria-label="Rate">
    </div>

    <div class="col-sm-2">
      <label class="visually-hidden" for="party_per">Per</label>
      <select class="form-select form-select-sm" id="party_per" name="party_per">
        <option value="Kg">Kg</option>
        <option selected value="Art">Art</option>
        <option value="Fixed">Fixed</option>
      </select>
    </div>
  </div>
  <br>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</form>

<!-- Party Rate Table -->
<hr class="border-primary">
<div class="card border-secondary mb-3 my-4" style="max-width: 66rem;">
<div class="col-lg-12">
		<div class="card-body">
    <div class="table-responsive">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">SNo</th>
						<th>Party</th>
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
          $sql = "SELECT * FROM `party_rate` WHERE `from4`='".$city."'";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){

            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['party_name1'] . "</td>
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
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>

