<?php
include 'db_connect.php';

$userid = 0;
if(isset($_POST['fromdate']) && isset($_POST['todate'])){
$sql = "select `to1`, count(to1) as count, lrno from new_parcel where `status1`=0 AND `date` BETWEEN '" . $_POST['fromdate'] . "' AND  '" . $_POST['todate'] . "' group by `to1`";
$result = mysqli_query($conn,$sql);
  $response = "<table border='0' width='100%'>";
  $response .= "<tr>";
  $response .= "<td>Selection</td><td>Station</td><td>Pending Bkg</td>";
  $response .= "</tr>";
while( $row = mysqli_fetch_array($result) ){
  $city = $row['to1'];
  $count = $row['count'];

  $response .= "<tr>";
  $response .= "<td><input type='checkbox' name='branches[]' id='".$city."' value='".$city."'></td><td><label for='".$city."'>$city</label></td><td>".$count."</td><td></td>";
  $response .= "</tr>";
}
  $response .= "</table>";

echo $response;
exit;
}
if(isset($_POST['optionId']) && isset($_POST['station']) && $_POST['station'] != ""){
  $optionId = $_POST['optionId'];
  $station = $_POST['station'];
  $sql = "select * from party_rate where `party_name1`='$optionId' AND `station`='$station'";
$result = mysqli_query($conn,$sql);
$data = array();
while( $row = mysqli_fetch_array($result) ){
  $data['party_freighttype'] = $row['party_freighttype'];
}
echo json_encode($data);
}
if(isset($_POST['articletype']) && isset($_POST['station']) && isset($_POST['consignor'])  && isset($_POST['from'])){
  if($_POST['station'] != "" && $_POST['consignor'] != ""){
    $articletype = $_POST['articletype'];
    $station = $_POST['station'];
    $consignor = $_POST['consignor'];
    $from = $_POST['from'];
    $sqll = "select * from party_rate where `party_name1`='$consignor' AND `station`='$station' AND `from4`='$from' AND `party_articletype`='$articletype'";
    $resultt = mysqli_query($conn,$sqll);
    $dataa = array();
    while( $roww = mysqli_fetch_array($resultt) ){
      $dataa['party_rate'] = $roww['party_rate'];
      $dataa['party_per'] = $roww['party_per'];
    }

    echo json_encode($dataa);
  }
}
