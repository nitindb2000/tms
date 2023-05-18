<?php if(!isset($conn)){ include 'db_connect.php'; } ?>
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
      $article = $_POST['article'];
      $description = $_POST['description'];

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
        // Sql query to be executed

        $sql = "INSERT INTO `new_article` (`article`, `description`) VALUES ('$article', '$description')";

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
          <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
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
<div class="container mt-3">
    <form action="" method="post">
    <div class="row g-3">
    <div class="col-md-4 form-group">
        <label for="article">Article Type</label>
        <input type="text" name="article" class="form-control" id="article" aria-describedby="emailHelp">
    </div>

    <div class="col-md-4 form-group">
        <label for="description">Description / Remarks</label>
        <input type="text" name="description" class="form-control" id="description" aria-describedby="emailHelp">
    </div>
    <break>

    <button type="submit" class="btn btn-primary">Save</button>

  </form>
</div>
</div>
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

