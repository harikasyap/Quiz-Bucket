<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="<?php echo $site_title; ?> dashboard">

      <title>Users | <?php echo $site_title; ?> Dashboard</title>

      <link href="<?php echo site_url('dashboard/css/bootstrap.css'); ?>" rel="stylesheet">
      <link href="<?php echo site_url('dashboard/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />

      <link href="<?php echo site_url('dashboard/css/style.css'); ?>" rel="stylesheet">
      <link href="<?php echo site_url('dashboard/css/style-responsive.css'); ?>" rel="stylesheet">

      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>

   <body>

      <section id="container" >         

         <header class="header black-bg" id="top">
            <div class="sidebar-toggle-box">
               <div class="fa fa-bars"></div>
            </div>
            <a href="<?php echo site_url('admin'); ?>" class="logo"><b><?php echo $site_title; ?></b></a>
            <div class="top-menu">
               <ul class="nav pull-right top-menu">
                  <li><?php echo anchor('user/logout', 'Logout', 'class="logout"'); ?></li>
               </ul>
            </div>
           </header>
         
         <aside>
            <div id="sidebar"  class="nav-collapse ">
               <ul class="sidebar-menu" id="nav-accordion">
                 <p class="centered"><a href="<?php echo site_url('admin'); ?>"><img src="<?php echo site_url('dashboard/img/logo.jpg'); ?>" class="img-circle" width="60"></a></p>
                 <h5 class="centered"><?php echo ucwords($session['username']); ?></h5>

                  <li class="mt">
                     <a href="<?php echo site_url('admin'); ?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                     </a>
                  </li>
                  <li class="sub-menu">
                     <a href="javascript:;" >
                        <i class="fa fa-question"></i>
                        <span>Quiz</span>
                     </a>
                     <ul class="sub">
                        <li><a href="<?php echo site_url('admin/quiz/paid'); ?>">Paid Quiz</a></li>
                        <li><a href="<?php echo site_url('admin/quiz/free'); ?>">Free Quiz</a></li>
                        <li><a href="<?php echo site_url('admin/quiz/archive'); ?>">Archive</a></li>
                     </ul>
                  </li>
                  <li class="sub-menu">
                     <a href="<?php echo site_url('admin/results'); ?>">
                        <i class="fa fa-check"></i>
                        <span>Results</span>
                     </a>
                  </li>
                  <li class="sub-menu">
                     <a href="javascript:;" >
                        <i class="fa fa-archive"></i>
                        <span>Question Bank</span>
                     </a>
                     <ul class="sub">
                        <li><a href="<?php echo site_url('admin/question_bank/questions'); ?>">Questions</a></li>
                        <li><a href="<?php echo site_url('admin/question_bank/tags'); ?>">Tags</a></li>
                     </ul>
                  </li>
                  <li class="sub-menu">
                     <a href="<?php echo site_url('admin/current_affairs'); ?>">
                        <i class="fa fa-check"></i>
                        <span>Current Affairs</span>
                     </a>
                  </li>
                  <li class="sub-menu">
                     <a href="<?php echo site_url('admin/users'); ?>">
                        <i class="fa fa-users"></i>
                        <span>Users</span>
                     </a>
                  </li>
               </ul>
            </div>
         </aside>

         <section id="main-content">
            <section class="wrapper">

               <h3 class="page-side-heading">
                  <i class="fa fa-angle-right"></i> <a href="<?php echo site_url('admin/users'); ?>">Users</a> <i class="fa fa-angle-right"></i> <a href="<?php echo site_url('admin/users/'.$user->user_id); ?>"><?php echo $user->first_name.' '.$user->last_name; ?></a><?php echo ($user_details->active == 1)? '<td><span class="label label-info user-status-notf">Active</span></td>' : '<td><span class="label label-warning user-status-notf">Deactive</span></td>'; ?>
                  <a href="<?php echo ($user_details->active == 1)? site_url('user/deactivate/'.$user_details->id): site_url('user/activate'); ?>"><button class="btn btn-success btn-xs fa fa-check tooltips" data-placement="right" data-original-title="Activate/Deactivate"></button></a>
               </h3>

               <?php
                  echo '<div class="row mt">';
                  echo '<div class="form-panel">';
                  echo '<div class="row">';
                  echo '<div class="col-lg-12">';

                  echo '<p><span>Email: </span>'.$user_details->email.'</p>';
                  echo '<p><span>Mobile No: </span>'.$user->phone_no.'</p>';
                  switch ($user->gender) {
                     case 'male': echo '<p><span>Gender: </span>Male</p>'; break;
                     case 'female': echo '<p><span>Gender: </span>Female</p>'; break;
                     case 'other': echo '<p><span>Gender: </span>Other</p>'; break;
                  }
                  echo '<p><span>DOB: </span>'.$user->dob.'</p>';
                  switch ($user->edu_qual) {
                     case 'below_matriculation': echo '<p><span>Qualification: </span>Below Matriculation</p>'; break;
                     case 'matriculate': echo '<p><span>Qualification: </span>Matriculate</p>'; break;
                     case 'higher_secondary': echo '<p><span>Qualification: </span>Higher Secondary</p>'; break;
                     case 'graduate': echo '<p><span>Qualification: </span>Graduate</p>'; break;
                     case 'post_graduate': echo '<p><span>Qualification: </span>Post Graduate</p>'; break;
                  }
                  switch ($user->state) {
                     case 'andaman_and_nicobar' : $state = 'Andaman and Nicobar'; break;
                     case 'andhra_pradesh' : $state = 'Andhra Pradesh'; break;
                     case 'arunachal_pradesh' : $state = 'Arunachal Pradesh'; break;
                     case 'assam' : $state = 'Assam'; break;
                     case 'bihar' : $state = 'Bihar'; break;
                     case 'chandigarh' : $state = 'Chandigarh'; break;
                     case 'chhattisgarh' : $state = 'Chhattisgarh'; break;
                     case 'dadra_and_nagar_haveli' : $state = 'Dadra and Nagar Haveli'; break;
                     case 'daman_and_diu' : $state = 'Daman and Diu'; break;
                     case 'delhi' : $state = 'Delhi'; break;
                     case 'goa' : $state = 'Goa'; break;
                     case 'gujarat' : $state = 'Gujarat'; break;
                     case 'haryana' : $state = 'Haryana'; break;
                     case 'himachal_pradesh' : $state = 'Himachal Pradesh'; break;
                     case 'Jammu_and_kashmir' : $state = 'Jammu and Kashmir'; break;
                     case 'jharkhand' : $state = 'Jharkhand'; break;
                     case 'karnataka' : $state = 'Karnataka'; break;
                     case 'kerala' : $state = 'Kerala'; break;
                     case 'madhya_pradesh' : $state = 'Madhya Pradesh'; break;
                     case 'maharashtra' : $state = 'Maharashtra'; break;
                     case 'manipur' : $state = 'Manipur'; break;
                     case 'meghalaya' : $state = 'Meghalaya'; break;
                     case 'mizoram' : $state = 'Mizoram'; break;
                     case 'nagaland' : $state = 'Nagaland'; break;
                     case 'odisha' : $state = 'Odisha'; break;
                     case 'puducherry' : $state = 'Puducherry'; break;
                     case 'rajasthan' : $state = 'Rajasthan'; break;
                     case 'sikkim' : $state = 'Sikkim'; break;
                     case 'tamil_nadu' : $state = 'Tamil Nadu'; break;
                     case 'telangana' : $state = 'Telangana'; break;
                     case 'tripura' : $state = 'Tripura'; break;
                     case 'uttar_pradesh' : $state = 'Uttar Pradesh'; break;
                     case 'uttarakhand' : $state = 'Uttarakhand'; break;
                     case 'west_bengal' : $state = 'West Bengal'; break;
                     case 'lakshadweep' : $state = 'Lakshadweep'; break;
                  }

                  echo '<p><span>Address: </span>'.$user->address.', '.$user->city.', '.$state.', '.$user->pincode.'</p>';

                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
               ?>

            </section>

            <footer class="site-footer">
               <div class="text-center">
                  Powered by Quastio &trade;
                  <a href="#top" class="go-top"><i class="fa fa-angle-up"></i></a>
               </div>
            </footer>

         </section>
      </section>

      <script src="<?php echo site_url('dashboard/js/jquery.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/bootstrap.min.js'); ?>"></script>
      <script class="include" type="text/javascript" src="<?php echo site_url('dashboard/js/jquery.dcjqaccordion.2.7.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/jquery.scrollTo.min.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/jquery.nicescroll.js'); ?>" type="text/javascript"></script>

      <script src="<?php echo site_url('dashboard/js/common-scripts.js'); ?>"></script>

   </body>
</html>