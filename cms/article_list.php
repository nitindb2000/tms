<?php include'db_connect.php' ?>
<div class="col-lg-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <div class="card-tools">
          <div class="table-responsive">
        <a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="./index.php?page=new_article"><i class="fa fa-plus"></i> Add New Article</a>
      </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
      <table class="table tabe-hover table-bordered" id="list">
        <thead>
        <tr>
          <th class="text-center">SrNo</th>
          <th>Article</th>
          <th>Description/Remarks</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
            </div>
            </div>
    </div>
        <?php
        $i = 1;

        $qry = $conn->query("SELECT * FROM new_article order by article asc,description asc");
        while($row= $qry->fetch_assoc()):
          ?>
          <tr>
            <td class="text-center"><?php echo $i++ ?></td>
            <td class=""><b><?php echo $row['article'] ?></b></td>
            <td><b><?php echo ucwords($row['description']) ?></b></td>
            <td class="text-center">
              <div class="btn-group">
                <a href="index.php?page=edit_article&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat ">
                  <i class="fas fa-edit"></i>
                </a>
                <button type="button" class="btn btn-danger btn-flat delete_article" data-id="<?php echo $row['id'] ?>">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<style>
  table td{
    vertical-align: middle !important;
  }
</style>
<script>
  $(document).ready(function(){
    $('#list').dataTable()
    $('.view_article').click(function(){
      uni_modal("branch's Details","view_article.php?id="+$(this).attr('data-id'),"large")
    })
    $('.delete_article').click(function(){
      _conf("Are you sure to delete this branch?","delete_article",[$(this).attr('data-id')])
    })
  })
  function delete_article($id){
    start_load()
    $.ajax({
      url:'ajax.php?action=delete_article',
      method:'POST',
      data:{id:$id},
      success:function(resp){
        if(resp==1){
          alert_toast("Data successfully deleted",'success')
          setTimeout(function(){
            location.reload()
          },1500)

        }
      }
    })
  }
</script>
