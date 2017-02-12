<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Quiz Bucket dashboard">

      <title><?php echo (empty($question->question))? 'Add new question : '.$quiz->title: 'Edit question : '.$quiz->title ; ?> | Quiz Bucket Dashboard</title>

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
            <a href="<?php echo site_url('admin'); ?>" class="logo"><b>Quiz Bucket</b></a>
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

               <h3 class="page-side-heading"><i class="fa fa-angle-right"></i> Quiz: <?php echo anchor(site_url('admin/quiz/'.$quiz->id), $quiz->title); ?></h3>

               <div class="row">
                  <div class="col-lg-12">
                     
                     <div class="form-panel">

                        <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo (empty($question->question))? 'Add new question': 'Edit question'; ?></h4>
                        
                        <?php echo form_open('', 'class="form-horizontal style-form"'); ?>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No</label>
                              <div class="col-sm-10">
                              <?php echo form_error('no'); ?>
                                 <?php
                                    //If question no field is empty, it means it is an add question. So we need to add one more question no for the select menu
                                    //If question no field is set, it means it is an edit question. So no extra question no is to be added to the select menu
                                    $options = array();

                                    if ($total_questions == 0) {
                                       $options[1] = 1;
                                    } else {
                                       $limit = (empty($question->no))? $total_questions+1 : $total_questions;
                                       for($i = 1; $i <= $limit; $i++) {
                                          $options[$i] = $i;
                                       }
                                    }
                                 ?>
                                 <?php
                                    //If question no field is empty, it means it is a new entry. So its question no must be set default to one more than the total questions
                                    if(empty($question->no)) {       
                                       echo form_dropdown('no', $options, $total_questions + 1, 'class="form-control"');
                                    } else {
                                       echo form_dropdown('no', $options, $question->no, 'class="form-control"');
                                    }
                                 ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Question</label>
                              <div class="col-sm-10">
                              <?php echo form_error('question'); ?>
                                 <?php echo form_textarea('question', set_value('question', $question->question), 'class="form-control"'); ?>
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Answer:</label>
                              <div class="col-sm-10">
                              <?php echo form_error('answer'); ?>
                                 <?php
                                    $var[1] = $var[2] = $var[3] = $var[4] = FALSE;
                                    if($question->question) {
                                       switch ($question->answer) {
                                          case $option1: $var[1] = TRUE; break;
                                          case $option2: $var[2] = TRUE; break;
                                          case $option3: $var[3] = TRUE; break;
                                          case $option4: $var[4] = TRUE; break;
                                       }
                                    }
                                 ?>
                                 <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"><?php echo form_radio('answer', 1, set_radio('answer', 1, $var[1]), 'id="optionsRadios1"'); ?> Option 1</label>
                                    <div class="col-sm-10">
                                    <?php echo form_error('option1'); ?>
                                       <?php echo form_input('option1', set_value('option1', $question->option1), 'class="form-control"'); ?>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"><?php echo form_radio('answer', 2, set_radio('answer', 2, $var[2]), 'id="optionsRadios1"'); ?> Option 2</label>
                                    <div class="col-sm-10">
                                    <?php echo form_error('option2'); ?>
                                       <?php echo form_input('option2', set_value('option2', $question->option2), 'class="form-control"'); ?>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"><?php echo form_radio('answer', 3, set_radio('answer', 3, $var[3]), 'id="optionsRadios1"'); ?> Option 3</label>
                                    <div class="col-sm-10">
                                    <?php echo form_error('option3'); ?>
                                       <?php echo form_input('option3', set_value('option3', $question->option3), 'class="form-control"'); ?>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"><?php echo form_radio('answer', 4, set_radio('answer', 4, $var[4]), 'id="optionsRadios1"'); ?> Option 4</label>
                                    <div class="col-sm-10">
                                    <?php echo form_error('option4'); ?>
                                       <?php echo form_input('option4', set_value('option4', $question->option4), 'class="form-control"'); ?>
                                    </div>
                                 </div>

                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Starred</label>
                              <div class="col-sm-10">
                              <?php echo form_error('is_starred'); ?>                                 
                                 <div class="checkbox">
                                    <?php $bol = ($question->is_starred == 1)? TRUE : FALSE; ?>
                                    <label>
                                       <?php echo form_checkbox('is_starred', 1, set_checkbox('active', 1, $bol)); ?> (starred question)
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <?php
                              if (empty($question->question)) {
                                 echo form_submit('submit','Add question', 'class="btn btn-primary" style="margin-right: 9px;"');
                                 echo '<a href="'.site_url('admin/quiz/'.$quiz->id).'"><button type="button" class="btn btn-success">Finish</button></a>';
                              } else {
                                 echo form_submit('submit','Finish', 'class="btn btn-success"');
                              }
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

      <script src="<?php echo site_url('dashboard/js/jquery.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/bootstrap.min.js'); ?>"></script>
      <script class="include" type="text/javascript" src="<?php echo site_url('dashboard/js/jquery.dcjqaccordion.2.7.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/jquery.scrollTo.min.js'); ?>"></script>
      <script src="<?php echo site_url('dashboard/js/jquery.nicescroll.js'); ?>" type="text/javascript"></script>

      <script src="<?php echo site_url('dashboard/js/common-scripts.js'); ?>"></script>

   </body>
</html>