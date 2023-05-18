<?php
include "db_connect.php";
?>
<!doctype html>
<html>
<head>
  <link href="style.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
<div >

  <form method='post' action='export_csv/challanwise_receipt_download.php'>

    <!-- Datepicker -->
    <div class="row g-3">
      <div class="col-sm-2">
        <input type="text" name="from_date" class="form-control form-control-sm" id="from_date" placeholder=" From Date" >
      </div>

      <div class="col-sm-2">
        <input type="text" name="to_date" class="form-control form-control-sm" id="to_date" placeholder="To Date">
      </div>

      <button class="btn btn-sm btn-primary mx-1 bg-gradient-primary" type="submit" id='view_report'>Download Report</button>
  </form>


  <!-- Script -->
  <script type='text/javascript' >
    $(document).ready(function(){

      // From datepicker
      $("#from_date").datepicker({
        dateFormat: 'yy-mm-dd',changeYear: true,
        onSelect: function (selected) {
          var dt = new Date(selected);
          dt.setDate(dt.getDate() + 1);
          $("#to_date").datepicker("option", "minDate", dt);
        }
      });

      // To datepicker
      $("#to_date").datepicker({
        dateFormat: 'yy-mm-dd',changeYear: true,
        onSelect: function (selected) {
          var dt = new Date(selected);
          dt.setDate(dt.getDate() - 1);
          $("#from_date").datepicker("option", "maxDate", dt);
        }
      });
    });
  </script>
</body>
</html>

