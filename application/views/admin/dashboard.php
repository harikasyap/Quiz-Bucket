<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="<?php echo $site_title; ?> dashboard">

      <title>Dashboard | <?php echo $site_title; ?></title>

      <link href="<?php echo site_url('dashboard/css/bootstrap.css'); ?>" rel="stylesheet">
      <link href="<?php echo site_url('dashboard/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="<?php echo site_url('dashboard/css/zabuto_calendar.css'); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo site_url('dashboard/js/gritter/css/jquery.gritter.css'); ?>" />

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
            <a href="<?php echo site_url('admin'); ?>" class="logo"><b><?php echo strtoupper($site_title); ?></b></a>
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
                     <a class="active" href="<?php echo site_url('admin'); ?>">
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

               <div class="row">
                  <div class="col-lg-9 main-chart">

                     <div class="row mt">
                        <div class="col-md-4 col-sm-4 mb">
                           <div class="darkblue-panel pn">
                              <div class="darkblue-header">
                                 <h5>Quiz</h5>
                              </div>
                              <a href="<?php echo site_url('admin/quiz'); ?>"><h1 class="mt"><i class="fa fa-question fa-3x"></i></h1></a>
                              <p>Manage all quizzes</p>
                           </div>
                        </div>

                        <div class="col-md-4 col-sm-4 mb">
                           <div class="darkblue-panel pn">
                              <div class="darkblue-header">
                                 <h5>Add Quiz</h5>
                              </div>
                              <a href="<?php echo site_url('admin/quiz/edit'); ?>"><h1 class="mt"><i class="fa fa-plus fa-3x"></i></h1></a>
                              <p>Add a new quiz</p>
                           </div>
                        </div>

                        <div class="col-md-4 col-sm-4 mb">
                           <div class="darkblue-panel pn">
                              <div class="darkblue-header">
                                 <h5>Results</h5>
                              </div>
                              <a href="<?php echo site_url('admin/results'); ?>"><h1 class="mt"><i class="fa fa-check fa-3x"></i></h1></a>
                              <p>View results of all past quizzes</p>
                           </div>
                        </div>
                     </div>

                     <div class="row mt">
                        <div class="col-md-4 col-sm-4 mb">
                           <div class="darkblue-panel pn">
                              <div class="darkblue-header">
                                 <h5>Question Bank</h5>
                              </div>
                              <a href="<?php echo site_url('admin/question_bank'); ?>"><h1 class="mt"><i class="fa fa-archive fa-3x"></i></h1></a>
                              <p>Manage question bank</p>
                           </div>
                        </div>

                        <div class="col-md-4 col-sm-4 mb">
                           <div class="darkblue-panel pn">
                              <div class="darkblue-header">
                                 <h5>Users</h5>
                              </div>
                              <a href="<?php echo site_url('admin/users'); ?>"><h1 class="mt"><i class="fa fa-users fa-3x"></i></h1></a>
                              <p>View all registered users</p>
                           </div>
                        </div>

                        <div class="col-md-4 col-sm-4 mb">
                           <div class="darkblue-panel pn">
                              <div class="darkblue-header">
                                 <h5>Current Affairs</h5>
                              </div>
                              <a href="<?php echo site_url('admin/current_affairs'); ?>"><h1 class="mt"><i class="fa fa-info-circle fa-3x"></i></h1></a>
                              <p>Manage current affairs</p>
                           </div>
                        </div>
                     </div>

                  </div>

                  <div class="col-lg-3 ds">
                     <h3>Upcoming Quiz</h3>
                     
                     <?php
                        if(empty($recent_quiz)) {
                           echo '<div class="desc">';
                           echo '<p class="text-center">No upcoming quizzes to display</p>';
                           echo '</div>';
                        } else {
                           foreach ($recent_quiz as $q) {
                              echo '<div class="desc">';
                              echo '<div class="thumb">';
                              echo '<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>';
                              echo '</div>';
                              echo '<div class="details">';
                              echo '<a href="'.site_url('admin/quiz/'.$q->id).'">'.$q->title.'</a><br/>';
                              echo '<p><muted>'.$q->date.'</muted><br/></p>';
                              echo '</div>';
                              echo '</div>';
                           }
                        }
                     ?>

                     <div id="calendar" class="mb">
                        <div class="panel green-panel no-margin">
                           <div class="panel-body">
                              <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                 <div class="arrow"></div>
                                 <h3 class="popover-title" style="disadding: none;"></h3>
                                 <div id="date-popover-content" class="popover-content"></div>
                              </div>
                              <div id="my-calendar"></div>
                           </div>
                        </div>
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

      <script src="<?php echo site_url('dashboard/js/jquery.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/jquery-1.8.3.min.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/bootstrap.min.js'); ?>"></script>
      <script class="include" type="text/javascript" src="<?php echo site_url('dashboard/js/jquery.dcjqaccordion.2.7.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/jquery.scrollTo.min.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/jquery.nicescroll.js'); ?>" type="text/javascript"></script>

      <script src="<?php echo site_url('dashboard/js/common-scripts.js'); ?>"></script>

      <script type="text/javascript" src="<?php echo site_url('dashboard/js/gritter/js/jquery.gritter.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo site_url('dashboard/js/gritter-conf.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/zabuto_calendar.js'); ?>"></script> 

      <?php if ($session['first'] == 'true'): ?>
         <script type="text/javascript">
            $(document).ready(function () {
               var unique_id = $.gritter.add({
                  title: 'Welcome back!',
                  text: 'Hey there, welcome aboard to the control panel of <?php echo $site_title; ?>. <br> Let\'s get started!',
                  image: '<?php echo site_url("dashboard/img/logo.jpg"); ?>',
                  sticky: false,
                  time: 7200
               });

               return false;
            });
         </script>
      <?php endif; ?>

      <script type="application/javascript">
         $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
               action: function () {
                 return myDateFunction(this.id, false);
               },
               action_nav: function () {
                 return myNavFunction(this.id);
               },
               today: true,
               ajax: {
                 url: "show_data.php?action=1",
                 modal: true
               }
            });
         });
           
         function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
         }
      </script>
   </body>
</html>