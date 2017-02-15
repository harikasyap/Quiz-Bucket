<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="<?php echo $site_title; ?> dashboard">

      <title><?php echo (empty($quiz->title))? 'Add new quiz': 'Edit quiz : '.$quiz->title; ?> | <?php echo $site_title; ?> Dashboard</title>

      <link href="<?php echo site_url('dashboard/css/bootstrap.css'); ?>" rel="stylesheet">
      <link href="<?php echo site_url('dashboard/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
      <link href="<?php echo site_url('dashboard/css/jquery-ui.css'); ?>" rel="stylesheet">

      <link href="<?php echo site_url('dashboard/css/style.css'); ?>" rel="stylesheet">
      <link href="<?php echo site_url('dashboard/css/style-responsive.css'); ?>" rel="stylesheet">

      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.6.11/jquery.timepicker.css">
      <script src="<?php echo site_url('dashboard/js/jquery-1.10.2.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/jquery-ui.js'); ?>"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.6.11/jquery.timepicker.js"></script>

      <script>
         $(function() {
            $("#datepicker").datepicker({
               dateFormat: "yy-mm-dd"
            });
            $('.time-picker').timepicker({ 'timeFormat': 'H:i a' });
         });
      </script>
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

               <h3 class="page-side-heading"><i class="fa fa-angle-right"></i> <?php echo (empty($quiz->title))? 'Add new quiz': 'Edit: '.anchor(site_url('admin/quiz/'.$quiz->id), $quiz->title); ?></h3>

               <div class="row">
                  <div class="col-lg-12">
                     
                     <div class="form-panel">

                        <?php echo form_open('', 'class="form-horizontal style-form"'); ?>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Title</label>
                              <div class="col-sm-10">
                              <?php echo form_error('title'); ?>
                                 <?php echo form_input('title', set_value('title', $quiz->title), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Slug</label>
                              <div class="col-sm-10">
                              <?php echo form_error('slug'); ?>
                                 <?php echo form_input('slug', set_value('slug', $quiz->slug), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Description</label>
                              <div class="col-sm-10">
                              <?php echo form_error('description'); ?>
                                 <?php echo form_textarea('description', set_value('description', $quiz->description), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Publish date</label>
                              <div class="col-sm-10">
                              <?php echo form_error('date'); ?>
                                 <?php echo form_input('date', set_value('date', $quiz->date), 'id="datepicker" class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">From</label>
                              <div class="col-sm-10">
                              <?php echo form_error('start_time'); ?>
                                 <?php echo form_input('start_time', set_value('start_time', $quiz->start_time), 'class="time-picker form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">To</label>
                              <div class="col-sm-10">
                              <?php echo form_error('end_time'); ?>
                                 <?php echo form_input('end_time', set_value('end_time', $quiz->end_time), 'class="time-picker form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Prize Money</label>
                              <div class="col-sm-10">
                              <?php echo form_error('prize_money'); ?>
                                 <?php echo form_input('prize_money', set_value('prize_money', $quiz->prize_money), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Cost</label>
                              <div class="col-sm-10">
                              <?php echo form_error('cost'); ?>
                                 <?php echo form_input('cost', set_value('cost', $quiz->cost), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Activate</label>
                              <div class="col-sm-10">
                              <?php echo form_error('active'); ?>
                                 <?php $bol = ($quiz->active == 1)? TRUE : FALSE; ?>
                                 <div class="checkbox">
                                   <label>
                                       <?php echo form_checkbox('active', 1, set_checkbox('active', 1, $bol)); ?> (Check this to show quiz in the website)
                                   </label>
                                 </div>
                              </div>
                           </div>

                           <?php echo form_submit('submit','Submit', 'class="btn btn-success"'); ?>
                        <?php echo form_close(); ?>

                     </div>

                  </div>

               </div>
            </section>

            <footer class="site-footer">
               <div class="text-center">
                  Powered by Quastio &trade;
                  <a href="#top" class="go-top"><i class="fa fa-angle-up"></i></a>
               </div>
            </footer>

         </section>
      </section>

      <script src="<?php echo site_url('dashboard/js/bootstrap.min.js'); ?>"></script>
      <script class="include" type="text/javascript" src="<?php echo site_url('dashboard/js/jquery.dcjqaccordion.2.7.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/jquery.scrollTo.min.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/jquery.nicescroll.js'); ?>" type="text/javascript"></script>

      <script src="<?php echo site_url('dashboard/js/common-scripts.js'); ?>"></script>

   </body>
</html>