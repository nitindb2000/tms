<!DOCTYPE html>
<html>
<?php include'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
  $lrnum = $_GET['id'];
  $sql = "SELECT * FROM `new_parcel` where `lrno` = ".$lrnum;
  $result = mysqli_query($conn, $sql); ?>
<div id="outprint" class="list-group">
  <?php while($row = mysqli_fetch_assoc($result)){ ?>
    <table class="print-parcel-table">
      <tr class="print-parcel-row">
        <!--<div class="clear-fix my-5"></div>-->
        <!--<div class="row">
          <div class="col-auto flex-grow-1 border-bottom border-dark col-auto pr-2"><b><?/*= $row['consignor'] */?></b></div>
          <div class="col-auto flex-grow-1 border-bottom border-dark col-auto pr-2"><b><?/*= $row['consignee'] */?></b></div>
        </div>-->
        <td colspan="4" style="font-weight: bold">
          <?php echo strtoupper($row['consignor']); ?>
        </td>
        <td colspan="2">
          <table>
            <tr>
              <td><?php echo $row['lrno']; ?></td>
            </tr>
            <tr>
              <td><?php echo date("d-m-Y", strtotime($row['date'])); ?></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr class="print-parcel-row">
        <td colspan="4" style="font-weight: bold">
          <?php echo strtoupper($row['consignee']); ?>
        </td>
        <td colspan="2">
          <table>
            <tr>
              <td style="font-weight: bold"><?php echo strtoupper($row['from1']); ?></td>
            </tr>
            <tr>
              <td style="font-weight: bold"><?php echo strtoupper($row['to1']); ?></td>
            </tr>
          </table>
        </td>
      </tr>
     <tr class="print-parcel-row">
       <td><?php echo ($row['art1'] + $row['art2'] + $row['art3'] + $row['art4']); ?></td>
       <td>
         <table>
           <tr>
             <td><?php echo $row['articletype1']; ?></td>
           </tr>
           <tr>
             <td><?php echo $row['articletype2']; ?></td>
           </tr>
           <tr>
             <td><?php echo $row['articletype3']; ?></td>
           </tr>
           <tr>
             <td><?php echo $row['articletype4']; ?></td>
           </tr>
           <tr>
             <td class="freighttype"><?php echo strtoupper($row['freighttype']); ?></td>
           </tr>
         </table>
       </td>
       <td>
         <table>
           <tr>
             <td class="invoice-no-section"><?php echo $row['invoice']; ?></td>
           </tr>
           <tr>
             <td class="invoice-no-section"><?php echo $row['actualwt'].' Kg'; ?></td>
           </tr>
         </table>
       </td>
       <td></td>
       <td>
         <table>
           <tr><td class="invoice-no-section"><?php echo $row['freight1']; ?></td></tr>
           <tr><td class="invoice-no-section"></td></tr>
           <tr><td class="lr-total" style="font-weight: bold"><?php echo $row['lr_total']; ?></td></tr>
         </table>
     </tr>

    </table>
    <div class="made-by"><?php echo strtoupper($row['madeby']) ?></div>
  <?php } ?>
</div>
<?php }
?>
<div class="text-right">
  <button class="btn btn-sm btn-flat btn-success" type="button" id="print"><i class="fa fa-print"></i> Print</button>
  <button class="btn btn-sm btn-flat btn-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
</div>
<script>

  $(function(){
    $('#print').click(function(){
      //var _h = $("head").clone()
      var _p = $("#outprint").clone();
      var el = $("<table>");
      //el.append(_h)
      el.append(_p)
      start_loader()
      var nw = window.open('','_blank','width=1000,height=720,top=100,left=100')

      nw.document.write(el.html())
      nw.document.close()
      setTimeout(() => {
        nw.print()
        setTimeout(() => {
          nw.close()
          end_loader();
        }, 500);
      }, 750);

    })
  })
  function start_loader(){
    $('body').prepend('<div id="preloader"></div>')
  }
  function end_loader(){
    $('#preloader').fadeOut('fast', function() {
      $(this).remove();
    })
  }
</script>
<style>
  .modal-footer{display:none;}
  .print-parcel-row > td {width: 140px;}
  .invoice-no-section {padding: 0px 0 25px 0px;}
  .made-by {
    float: right;
    width: 40%;
    margin: 50px 0 19px 0;
    font-weight: bold;
  }
  td.freighttype {
    padding-top: 15px;
    font-weight: bold;
  }
</style>
