<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="<?php echo $site_title; ?> dashboard">

      <title><?php echo $quiz->title; ?> | <?php echo $site_title; ?> Dashboard</title>

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

               <h2 class="page-side-heading">
                  <?php echo anchor(site_url('admin/quiz/'.$quiz->id), $quiz->title); ?>
                  <?php
                     echo ($quiz->active == 1)? '<span class="label label-info quiz-status-notf">Active</span>' : '<span class="label label-warning quiz-status-notf">Deactive</span>';
                     echo '<a href="'.site_url('admin/quiz/change_active/'.$quiz->id).'" style="padding-right: 5px;"><button class="btn btn-success btn-xs fa fa-check tooltips" data-placement="bottom" data-original-title="Activate/Deactivate"></button></a>';
                     echo '<a href="'.site_url('admin/quiz/edit/'.$quiz->id).'" style="padding-right: 5px;"><button class="btn btn-primary btn-xs fa fa-pencil tooltips" data-placement="bottom" data-original-title="Edit"></button></a>';
                     echo '<a href="'.site_url('admin/quiz/delete/'.$quiz->id).'"><button class="btn btn-danger btn-xs fa fa-trash-o tooltips" data-placement="bottom" data-original-title="Delete"></button></a>';
                  ?>
               </h2>

               <div class="row">
                     <div class="form-panel">
                        <div class="row mt">
                           <div class="col-lg-12">
                              <div class="col-md-4 col-sm-4">
                                 <h4>Description:</h4>
                                 <p><?php echo $quiz->description; ?></p>
                              </div>

                              <div class="col-md-4 col-sm-4">
                                 <p><span>Slug: </span><?php echo $quiz->slug; ?></p>
                                 <p><span>Pubdate: </span><?php echo $quiz->date; ?></p>
                                 <?php
                                    if($quiz->prize_money == 0) {
                                       $start_time = new DateTime($quiz->date.' '.$quiz->start_time);
                                       $end_time = new DateTime($quiz->date.' '.$quiz->end_time);
                                       $diff = $start_time->diff($end_time);
                                       $h = $diff->format('%h');
                                       $m = $diff->format('%i');
                                       $s = $diff->format('%s');

                                       echo '<p><span>Time duration: </span>'.$h.'h '.$m.'m '.$s.'</p>';
                                    } else {
                                       echo '<p><span>Time: </span>'.$quiz->start_time.' to '.$quiz->end_time.'</p>';
                                    }
                                 ?>
                              </div>

                              <div class="col-md-4 col-sm-4">
                                 <p><span>Prize Money: </span><?php echo $quiz->prize_money; ?></p>
                                 <p><span>Cost: </span><?php echo $quiz->cost; ?></p>
                                 <?php
                                    if($quiz->prize_money != 0) {
                                       echo '<p><span>Enrolled users: </span>'.$quiz_enrolled.'</p>';
                                    }
                                 ?>
                              </div>
                           </div>
                        </div>
                     </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">

                     <?php
                     if (empty($question)) {
                        echo '<div class="row mt">';
                        echo '<div class="col-md-4 col-sm-4 mb">';
                        echo '<a href="'.site_url('admin/question/edit/'.$quiz->id).'">';
                        echo '<div class="white-panel-add pn">';
                        echo '<i class="fa fa-plus fa-5x"></i>';
                        echo '<p>Add questions</p>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                        echo '</div>';
                     } else {

                        $count = 0;

                        foreach ($question as $q) {
                           if($count % 3 == 0) {
                              echo '<div class="row mt">';
                           }
                           
                           $count += 1;
                           
                           echo '<div class="col-md-4 col-sm-4 mb">';
                           echo '<div class="white-panel-ques pn">';
                           echo '<div class="white-header">';
                           echo '<h5>';
                           echo $count.'. '.$q->question;
                           if($q->is_starred == 1) {
                              echo '  <span class="badge bg-warning tooltips" data-placement="right" data-original-title="Starred question"><i class="fa fa-star"></i></span>';
                           }
                           echo '<div class="btn-set">';
                           echo '<a href="'.site_url('admin/question/change_is_starred/'.$q->id).'" style="padding-right: 5px;"><button class="btn btn-success btn-xs fa fa-star tooltips" data-placement="left" data-original-title="Starred/Non starred"></button></a>';
                           echo '<a href="'.site_url('admin/question/edit/'.$quiz->id.'/'.$q->id).'" style="padding-right: 5px;"><button class="btn btn-primary btn-xs fa fa-pencil tooltips" data-placement="bottom" data-original-title="Edit"></button></a>';
                           echo '<a href="'.site_url('admin/question/delete/'.$q->id).'"><button class="btn btn-danger btn-xs fa fa-trash-o tooltips" data-placement="right" data-original-title="Delete"></button></a>';
                           echo '</div>';
                           echo '</h5>';
                           echo '</div>';
                           echo '<p>1. '.$q->option1.'</p>';
                           echo '<p>2. '.$q->option2.'</p>';
                           echo '<p>3. '.$q->option3.'</p>';
                           echo '<p>4. '.$q->option4.'</p>';

                           switch ($q->answer) {
                              case $option1[$q->id]: echo '<p class="answer">Answer: <b>'.$q->option1.'</b></p>'; break;
                              case $option2[$q->id]: echo '<p class="answer">Answer: <b>'.$q->option2.'</b></p>'; break;
                              case $option3[$q->id]: echo '<p class="answer">Answer: <b>'.$q->option3.'</b></p>'; break;
                              case $option4[$q->id]: echo '<p class="answer">Answer: <b>'.$q->option4.'</b></p>'; break;
                           }
                           echo '</div>';
                           echo '</div>';

                           if($count % 3 == 0) {
                              echo '</div>';
                           }
                        }

                        if($count % 3 == 0) {
                           echo '<div class="row mt">';
                        }
                        echo '<div class="col-md-4 col-sm-4 mb">';
                        echo '<a href="'.site_url('admin/question/edit/'.$quiz->id).'">';
                        echo '<div class="white-panel-add pn">';
                        echo '<i class="fa fa-plus fa-5x"></i>';
                        echo '<p>Add questions</p>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                        echo '</div>';
                     }
                     ?>

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
      <script src="<?php echo site_url('dashboard/js/bootstrap.min.js'); ?>"></script>
      <script class="include" type="text/javascript" src="<?php echo site_url('dashboard/js/jquery.dcjqaccordion.2.7.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/jquery.scrollTo.min.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/jquery.nicescroll.js'); ?>" type="text/javascript"></script>

      <script src="<?php echo site_url('dashboard/js/common-scripts.js'); ?>"></script>

   </body>
</html>