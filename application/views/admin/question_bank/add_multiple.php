<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="<?php echo $site_title; ?> dashboard">

      <title>Add new Question set | <?php echo $site_title; ?> Dashboard</title>

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

               <h3 class="page-side-heading"><i class="fa fa-angle-right"></i> Add new question set</h3>

               <div class="row">
                  <div class="col-lg-12">
                     
                     <div class="form-panel">

                        <?php echo form_open('', 'class="form-horizontal style-form"'); ?>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Question 1</label>
                              <div class="col-sm-10">
                              <?php echo form_error('question1'); ?>
                                 <?php echo form_textarea('question1', set_value('question1', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group" style="border-bottom: 3px solid #EFF2F7;">
                              <label class="col-sm-2 col-sm-2 control-label">Answer</label>
                              <div class="col-sm-10">
                              <?php echo form_error('answer1'); ?>
                                 <?php echo form_input('answer1', set_value('answer1', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Question 2</label>
                              <div class="col-sm-10">
                              <?php echo form_error('question2'); ?>
                                 <?php echo form_textarea('question2', set_value('question2', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group" style="border-bottom: 3px solid #EFF2F7;">
                              <label class="col-sm-2 col-sm-2 control-label">Answer</label>
                              <div class="col-sm-10">
                              <?php echo form_error('answer2'); ?>
                                 <?php echo form_input('answer2', set_value('answer2', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Question 3</label>
                              <div class="col-sm-10">
                              <?php echo form_error('question3'); ?>
                                 <?php echo form_textarea('question3', set_value('question3', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group" style="border-bottom: 3px solid #EFF2F7;">
                              <label class="col-sm-2 col-sm-2 control-label">Answer</label>
                              <div class="col-sm-10">
                              <?php echo form_error('answer3'); ?>
                                 <?php echo form_input('answer3', set_value('answer3', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Question 4</label>
                              <div class="col-sm-10">
                              <?php echo form_error('question4'); ?>
                                 <?php echo form_textarea('question4', set_value('question4', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group" style="border-bottom: 3px solid #EFF2F7;">
                              <label class="col-sm-2 col-sm-2 control-label">Answer</label>
                              <div class="col-sm-10">
                              <?php echo form_error('answer4'); ?>
                                 <?php echo form_input('answer4', set_value('answer4', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Question 5</label>
                              <div class="col-sm-10">
                              <?php echo form_error('question5'); ?>
                                 <?php echo form_textarea('question5', set_value('question5', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group" style="border-bottom: 3px solid #EFF2F7;">
                              <label class="col-sm-2 col-sm-2 control-label">Answer</label>
                              <div class="col-sm-10">
                              <?php echo form_error('answer5'); ?>
                                 <?php echo form_input('answer5', set_value('answer5', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Question 6</label>
                              <div class="col-sm-10">
                              <?php echo form_error('question6'); ?>
                                 <?php echo form_textarea('question6', set_value('question6', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group" style="border-bottom: 3px solid #EFF2F7;">
                              <label class="col-sm-2 col-sm-2 control-label">Answer</label>
                              <div class="col-sm-10">
                              <?php echo form_error('answer6'); ?>
                                 <?php echo form_input('answer6', set_value('answer6', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Question 7</label>
                              <div class="col-sm-10">
                              <?php echo form_error('question7'); ?>
                                 <?php echo form_textarea('question7', set_value('question7', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group" style="border-bottom: 3px solid #EFF2F7;">
                              <label class="col-sm-2 col-sm-2 control-label">Answer</label>
                              <div class="col-sm-10">
                              <?php echo form_error('answer7'); ?>
                                 <?php echo form_input('answer7', set_value('answer7', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Question 8</label>
                              <div class="col-sm-10">
                              <?php echo form_error('question8'); ?>
                                 <?php echo form_textarea('question8', set_value('question8', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group" style="border-bottom: 3px solid #EFF2F7;">
                              <label class="col-sm-2 col-sm-2 control-label">Answer</label>
                              <div class="col-sm-10">
                              <?php echo form_error('answer8'); ?>
                                 <?php echo form_input('answer8', set_value('answer8', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Question 9</label>
                              <div class="col-sm-10">
                              <?php echo form_error('question9'); ?>
                                 <?php echo form_textarea('question9', set_value('question9', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group" style="border-bottom: 3px solid #EFF2F7;">
                              <label class="col-sm-2 col-sm-2 control-label">Answer</label>
                              <div class="col-sm-10">
                              <?php echo form_error('answer9'); ?>
                                 <?php echo form_input('answer9', set_value('answer9', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Question 10</label>
                              <div class="col-sm-10">
                              <?php echo form_error('question10'); ?>
                                 <?php echo form_textarea('question10', set_value('question10', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group" style="border-bottom: 3px solid #EFF2F7;">
                              <label class="col-sm-2 col-sm-2 control-label">Answer</label>
                              <div class="col-sm-10">
                              <?php echo form_error('answer10'); ?>
                                 <?php echo form_input('answer10', set_value('answer10', ''), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tags</label>
                              <div class="col-sm-10">
                              <?php echo form_error('tag1'); ?>
                                 <div class="checkbox">

                                 <?php
                                    $count = 0;
                                    foreach ($tag_list as $t) {
                                       $count += 1;
                                       echo '<label style="margin-right: 13px;">';
                                       echo form_checkbox('tag'.$count, $t->id, set_checkbox('tag'.$count, $t->id, ''));
                                       echo '('.$t->name.')';
                                       echo '</label>';
                                    }
                                 ?>

                                 </div>
                              </div>
                           </div>

                           <?php
                              echo form_submit('submit','Add question', 'class="btn btn-primary" style="margin-right: 9px;"');
                              echo '<a href="'.site_url('admin/question_bank/questions').'"><button type="button" class="btn btn-success">Finish</button></a>';
                           ?>
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