<?php
  $login_user = $this->session->userdata('login_user');
  $lang_post = $this->session->userdata('lang');
		if($lang_post=="persion"){
      $lang['side_department'] = "بخشها";
      $lang['side_all_department'] = "همه بخش ها";
      $lang['side_add_department'] = "اضافه کردن بخش";
      $lang['side_doctor'] = "داکتران";
      $lang['side_all_doctor'] = "همه داکتران";
      $lang['side_add_doctor'] = "اضافه کردن داکتران";
      $lang['side_patient'] = "مریضان";
      $lang['side_all_patient'] = "همه مریضان";
      $lang['side_add_patient'] = "اضافه کردن مریض";
      $lang['side_user'] = "کاربران";
      $lang['side_all_user'] = "همه کاربران";
      $lang['side_add_user'] = "اضافه کردن کاربر";
      $lang['welcome'] = "خوش آمدید ";
    }else{
      $lang['side_department'] = "Department";
      $lang['side_all_department'] = "All Department";
      $lang['side_add_department'] = "Add Department";
      $lang['side_doctor'] = "Doctors";
      $lang['side_all_doctor'] = "All Doctors";
      $lang['side_add_doctor'] = "Add Doctors";
      $lang['side_patient'] = "Patients";
      $lang['side_all_patient'] = "All patients";
      $lang['side_add_patient'] = "Add patients";
      $lang['side_user'] = "Users";
      $lang['side_all_user'] = "All users";
      $lang['side_add_user'] = "Add users";
      $lang['welcome'] = "Welcome";

    }
?>
<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="<?php echo base_url(); ?>" class="site_title"><i class="fa fa-hospital-o"></i> <span>HMS</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile">
      <div class="profile_pic">
        <img src="<?php echo $login_user['picture']; ?>" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span><?=$lang['welcome']?>,</span>
        <h2><?php echo $login_user['full_name']; ?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>&nbsp;</h3>
        <ul class="nav side-menu">
          <!-- <li>
            <a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a>
          </li> -->
          <li>
            <a href="<?php echo base_url(); ?>department"><i class="fa fa-sitemap"></i> <?=$lang['side_department']?></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url(); ?>department"><?=$lang['side_all_department']?></a></li>
              <li><a href="<?php echo base_url(); ?>department/add"><?=$lang['side_add_department']?></a></li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>doctors"><i class="fa fa-user"></i> <?=$lang['side_doctor']?></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url(); ?>doctors"><?=$lang['side_all_doctor']?></a></li>
              <li><a href="<?php echo base_url(); ?>doctors/add"><?=$lang['side_add_doctor']?></a></li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>patient"><i class="fa fa-user-md"></i> <?=$lang['side_patient']?></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url(); ?>patient"><?=$lang['side_all_patient']?></a></li>
              <li><a href="<?php echo base_url(); ?>patient/add"><?=$lang['side_add_patient']?></a></li>
            </ul>
          </li>
         
          <li>
            <a href="<?php echo base_url(); ?>user"><i class="fa fa-plus-square"></i> <?=$lang['side_user']?></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url(); ?>user"><?=$lang['side_all_user']?></a></li>
              <li><a href="<?php echo base_url(); ?>user/add"><?=$lang['side_add_user']?></a></li>
            </ul>
          </li>
          
        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      
      <a href="<?php echo base_url('user/logout'); ?>" data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
        
<!-- top navigation -->
  <div class="top_nav">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <ul class="nav navbar-nav navbar-right">
          <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="<?php echo $login_user['picture']; ?>" alt=""><?php echo $login_user['full_name']; ?>
              <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              <!-- <li><a href="javascript:;"> Profile</a></li>
              <li>
                <a href="javascript:;">
                  <span>Settings</span>
                </a>
              </li><li><a href="javascript:;">Help</a></li> -->
              <li><a href="<?php echo base_url('user/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
            </ul>
          </li>

        </ul>
      </nav>
    </div>
  </div>
  <!-- /top navigation -->
