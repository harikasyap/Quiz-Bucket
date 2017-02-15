<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo site_url('css/bootstrap.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo site_url('css/style.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo site_url('css/dark.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo site_url('css/font-icons.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo site_url('css/animate.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo site_url('css/magnific-popup.css'); ?>" type="text/css" />

    <link rel="stylesheet" href="<?php echo site_url('css/responsive.css'); ?>" type="text/css" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <script type="text/javascript" src="<?php echo site_url('js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('js/plugins.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo site_url('js/jquery.countdown.js');?>"></script>

    <?php if ($quiz->prize_money != 0): ?>
        <script>
            var interval = <?php echo json_encode($interval); ?>;
            var ended = <?php echo json_encode($ended); ?>;

            if(!interval && !ended) {
                $(document).ready(function() {
                    var button = $('#start-button');
                    $(button).prop('disabled', false);
                });
                
                //To refresh the page with activated start button after quiz has ended, if quiz is opened in another window
                //**Change it to redirect to quiz/result/slug to show the result after the quiz has ended
                var quizinterval = <?php echo json_encode($started); ?>;
                var myInterval = setTimeout(function () { window.location.reload(true); }, quizinterval*1000);
            }
        </script>
    <?php endif; ?>

    <title><?php echo $title; ?></title>

</head>

<body class="stretched">
    
    <div id="wrapper" class="clearfix">

        <header id="header" class="full-header">

            <div id="header-wrap">

                <div class="container clearfix">

                    <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                    <div id="logo">
                        <a href="<?php echo site_url(); ?>" class="standard-logo" data-dark-logo="<?php echo site_url('img/logo-dark.png'); ?>"><img src="<?php echo site_url('img/logo.png'); ?>" alt="<?php echo $site_title.' Logo'; ?>"></a>
                        <a href="<?php echo site_url(); ?>" class="retina-logo" data-dark-logo="<?php echo site_url('img/logo-dark@2x.png'); ?>"><img src="<?php echo site_url('img/logo@2x.png'); ?>" alt="<?php echo $site_title.' Logo'; ?>"></a>
                    </div>

                    <nav id="primary-menu">

                        <ul>
                            <?php $navs = array('Home' => '', 'Quiz' => 'quiz', 'Question Bank' => 'question_bank', 'Current Affairs' => 'current_affairs', 'FAQ' => 'faq', 'About Us' => 'about_us'); ?>

                            <?php foreach ($navs as $nav => $url): ?>
                            <li <?php echo ($current_page == $nav)? 'class="current"':''; ?>><a href="<?php echo site_url($url); ?>"><div><?php echo $nav; ?></div></a></li>
                            <?php endforeach; ?> 
                        </ul>

                        <div id="top-cart">
                            <?php
                                if($current_page == 'user') {
                                    echo '<a href="#" id="top-cart-trigger" style="color: #2CAACA"><i class="icon-user"></i></a>';
                                } else {
                                    echo '<a href="#" id="top-cart-trigger"><i class="icon-user"></i></a>';
                                }
                            ?>
                            <div class="top-cart-content">
                                <?php if(isset($user_data)): ?>
                                    <div class="top-cart-title">
                                        <h4>Welcome <span><?php echo $user_data['name']; ?></span></h4>
                                    </div>
                                    <div class="top-cart-items">
                                        <div class="top-cart-item clearfix">
                                            <div class="top-cart-item-desc">
                                                <i class="icon-line-file"></i><a href="<?php echo site_url('user'); ?>">Profile</a>
                                                <span class="top-cart-item-price">View your account status</span>
                                            </div>
                                        </div>
                                        <div class="top-cart-item clearfix">
                                            <div class="top-cart-item-desc">
                                                <i class="icon-line2-settings"></i><a href="<?php echo site_url('user/edit'); ?>">Account Settings</a>
                                                <span class="top-cart-item-price">Make changes to your account</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="top-cart-action clearfix">
                                        <a href="<?php echo site_url('user/logout'); ?>"><button class="button button-3d button-small nomargin fright">Log Out</button></a>
                                    </div>
                                <?php else: ?>
                                    <div class="top-cart-items clearfix">
                                        <div class="top-cart-item clearfix">
                                            <div class="top-cart-item-desc">
                                                <a class="btnLogin" href="<?php echo site_url('user/login'); ?>"><button class="button button-3d button-small nomargin">Login</button></a>
                                                <span class="top-cart-item-content">Dont have an Account?<a href="<?php echo site_url('user/sign_up'); ?>">Sign Up</a></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </nav>

                </div>

            </div>

        </header>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="single-event">

                        <?php if ($quiz->prize_money != 0): ?>
                            <?php if ($interval): ?>
                                <script>
                                var days = <?php echo $interval->format('%a'); ?>;
                                var hours = <?php echo $interval->format('%h'); ?>;
                                var minutes = <?php echo $interval->format('%i'); ?>;
                                var seconds = <?php echo $interval->format('%s'); ?>;
                                var totalseconds = days*24*60*60 + hours*60*60 + minutes*60 + seconds;


                                $(function () {
                                    limit = new Date();
                                    limit.setSeconds(limit.getSeconds() + totalseconds);
                     
                                    $('#event-countdown').countdown( { until: limit, onExpiry: liftOff, format:'dHMS'} );
                                });

                                function liftOff() { 
                                    window.location.reload(true);
                                }
                                </script>
                            <?php endif; ?>
                        <?php endif; ?>

                        <h1><?php echo $quiz->title; ?></h1>

                        <div class="col_three_fourth">
                            <div class="entry-image nobottommargin">
                                <?php if($quiz->prize_money == 0): ?>
                                    <a href="#"><img src="<?php echo site_url('img/quiz-free-banner.jpg'); ?>" alt="<?php echo $quiz->title; ?>"></a>
                                <?php else: ?>
                                    <?php if($quiz->cost == 0): ?>
                                        <a href="#"><img src="<?php echo site_url('img/quiz-sponsored-banner.jpg'); ?>" alt="<?php echo $quiz->title; ?>"></a>
                                    <?php else: ?>
                                        <a href="#"><img src="<?php echo site_url('img/quiz-paid-banner.jpg'); ?>" alt="<?php echo $quiz->title; ?>"></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($quiz->prize_money != 0): ?>
                                    <?php                            
                                    if($interval) {
                                        echo '<div class="entry-overlay">';
                                        echo '<span class="hidden-xs">Starts in: </span><div id="event-countdown" class="countdown"></div>';
                                        echo '</div>';
                                    }
                                    ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col_one_fourth col_last">
                            <div class="panel panel-default events-meta">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Quiz Info:</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="iconlist nobottommargin">
                                        <?php if($quiz->prize_money !=0 ): ?>
                                            <li><i class="icon-calendar3"></i>
                                            <?php
                                                $time = strtotime($quiz->date);
                                                echo ' '.date('jS M, Y', $time);
                                            ?>
                                            </li>
                                        <?php endif; ?>
                                        <li><i class="icon-time"></i>
                                        <?php
                                            if($quiz->prize_money == 0) {
                                                $start_time = new DateTime($quiz->date.' '.$quiz->start_time);
                                                $end_time = new DateTime($quiz->date.' '.$quiz->end_time);
                                                $diff = $start_time->diff($end_time);
                                                $h = $diff->format('%h');
                                                $m = $diff->format('%i');
                                                $s = $diff->format('%s');
                                                echo ($h == 0)? ' '.$m.'m '.$s.'s' : ' '.$h.'h '.$m.'m '.$s.'s' ;
                                            } else {
                                                echo ' '.substr($quiz->start_time, 0, 5).' to '.substr($quiz->end_time, 0, 5);
                                            }
                                        ?>
                                        </li>
                                        <li><i class="icon-money"></i>Cost: <?php echo $quiz->cost; ?></li>
                                        <li><i class="icon-rupee"></i>Prize Money: <strong><?php echo $quiz->prize_money; ?></strong></li>
                                    </ul>
                                </div>
                            </div>
                            <?php if ($quiz->prize_money != 0): ?>
                                <?php
                                if($enrolled) {
                                    if($interval || $started) {
                                        echo form_open('quiz/run/'.$quiz->slug.'/'.$id_enc);
                                        echo form_submit('submit', 'Start', 'id="start-button" disabled="disabled" class="btn btn-success btn-block btn-lg"');
                                        echo form_close();
                                    } else {
                                        echo '<p class="center"><strong>Quiz has already ended.</strong></p>';
                                    }
                                } else {
                                    if($interval) {
                                        echo form_open('enroll/'.$id_enc);
                                        echo form_submit('submit', 'Enroll', 'id="start-button" class="btn btn-success btn-block btn-lg"');
                                        echo form_close();
                                    } else {
                                        echo '<p class="center"><strong>Quiz has already started/ended.</strong></p>';
                                    }
                                }
                                ?>
                            <?php else: ?>
                                <?php
                                echo form_open();
                                if ($this->session->userdata('end_time') === FALSE) {
                                    echo form_submit('submit', 'Start', 'id="start-button" class="btn btn-success btn-block btn-lg"');
                                } else {
                                    echo form_submit('submit', 'Continue', 'id="start-button" class="btn btn-success btn-block btn-lg"');
                                }
                                echo form_hidden('checksum', $id_enc);
                                echo form_close();
                                ?>
                            <?php endif; ?>
                        </div>

                        <div class="clear"></div>

                        <div class="col_three_fourth nobottommargin">

                            <h3>Details</h3>

                            <p class="nobottommargin"><?php echo $quiz->description; ?></p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

<?php $this->load->view('components/page_tail'); ?>