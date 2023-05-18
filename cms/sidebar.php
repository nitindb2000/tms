  <aside class="main-sidebar sidebar-dark-orange elevation-4">
    <div class="dropdown">
   	<a href="./" class="brand-link">
        <?php if($_SESSION['login_type'] == 1): ?>
        <h5 class="text-center p-0 m-0"><b><?php echo $_SESSION['login_name'] ?></b></h5>
        <?php else: ?>
        <h5 class="text-center p-0 m-0"><b><?php echo $_SESSION['login_name'] ?></b></h5>
        <?php endif; ?>

    </a>

    </div>
    <div class="sidebar pb-4 mb-4">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="./" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_branch">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Branch
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_branch" class="nav-link nav-new_branch tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=branch_list" class="nav-link nav-branch_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_staff">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Branch Staff
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_staff" class="nav-link nav-new_staff tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=staff_list" class="nav-link nav-staff_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_parcel">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Booking Transport
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_parcel" class="nav-link nav-new_parcel tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New LR Entry</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=parcel_list" class="nav-link nav-parcel_list nav-sall tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>View LR Entry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=loading_challan" class="nav-link nav-loading_challan tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Loading Challan</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=l_r_details" class="nav-link nav-l_r_details tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>LR Details</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link nav-delivery_transport">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
              Delivery Transport
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="./index.php?page=unloading_challan" class="nav-link nav-unloading_challan tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>UnLoading Challan</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=view_unloading_details" class="nav-link nav-view_unloading_details tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>View Unloading Details</p>
                </a>
              </li>
              </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link nav-new_article">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
              Masters
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

             <li class="nav-item">
                <a href="./index.php?page=cash_memo" class="nav-link nav-cash_memo tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Cash Memo</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=cashmemo_list" class="nav-link nav-cashmemo_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>View Cash Memo</p>
                </a>
              </li>

             <li class="nav-item">
                <a href="./index.php?page=cash_memo_receipt" class="nav-link nav-cash_memo_receipt tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Cash Memo Receipt</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=new_party" class="nav-link nav-new_party tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New Party</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=party_list" class="nav-link nav-party_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>View All Party</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=new_content" class="nav-link nav-new_content tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New Content</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=content_list" class="nav-link nav-content_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>View Content</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="./index.php?page=party_rate" class="nav-link nav-party_rate tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Party Rate</p>
                </a>
              </li>

              <!--<li class="nav-item">-->
              <!--  <a href="./index.php?page=party_rate_list" class="nav-link nav-party_rate_list tree-item">-->
              <!--    <i class="fas fa-angle-right nav-icon"></i>-->
              <!--    <p>View Party Rate</p>-->
              <!--  </a>-->
              <!--</li>-->

              <li class="nav-item">
                <a href="./index.php?page=new_article" class="nav-link nav-new_article tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New Article</p>
                </a>
              </li>

             <li class="nav-item">
                <a href="./index.php?page=article_list" class="nav-link nav-article_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>View All Article</p>
                </a>
              </li>

            </ul>
            </li>

              <li class="nav-item dropdown">
            <a href="./index.php?page=track" class="nav-link nav-track">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Track Parcel
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link nav-reports">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                  <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Booking Reports
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="./index.php?page=stock_balance_bkg" class="nav-link nav-stock_balance_bkg tree-item">
                      <i class="fas fa-angle-right nav-icon"></i>
                      <p>Stock Balance BKG</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="./index.php?page=challanwise_receipt" class="nav-link nav-challanwise_receipt tree-item">
                      <i class="fas fa-angle-right nav-icon"></i>
                      <p>Challan wise Receipt</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="./index.php?page=outstanding" class="nav-link nav-outstanding tree-item">
                      <i class="fas fa-angle-right nav-icon"></i>
                      <p>Outstanding Booking</p>
                    </a>
                  </li>

<!--              </li>-->
            </ul>
              </ul>

            <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Delivery Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="./index.php?page=stock_balance" class="nav-link nav-stock_balance tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Delivery Stock Balance</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=challanwise_receipt" class="nav-link nav-challanwise_receipt tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Delivery Statements</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=outstanding" class="nav-link nav-outstanding tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Outstanding Reports</p>
                </a>
              </li>

<!--              </li>-->
            </ul>
        </ul>

         </li>

<!--           <li class="nav-item dropdown">-->
<!--            <a href="./index.php?page=reports" class="nav-link nav-reports">-->
<!--              <i class="nav-icon fas fa-file"></i>-->
<!--              <p>-->
<!--                Reports-->
<!--              </p>-->
<!--            </a>-->
<!--          </li>-->
        </ul>
      </nav>
    </div>
  </aside>
  <script>
  	$(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='')
        page = page+'_'+s;
  		if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}

  	})
  </script>
