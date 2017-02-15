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
    <link rel="stylesheet" href="<?php echo site_url('css/quizinterface.css'); ?>" type="text/css" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <script type="text/javascript" src="<?php echo site_url('js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('js/plugins.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo site_url('js/jquery.countdown.js');?>"></script>
    <script src="<?php echo site_url('js/jquery.twbsPagination.js'); ?>"></script>
    
    <?php if($questions): ?>
    <script>
        var time = <?php echo strtotime($end_time) - strtotime(date('Y-m-d H:i:s')); ?>;

        $(function () {
            limit = new Date(); 
            limit.setSeconds(limit.getSeconds() + time);

            $('#event-countdown').countdown( { until: limit, onExpiry: liftOff, format:'dHMS' } );
        });

        function liftOff() {
            var string = JSON.stringify(selected);                  
            $.ajax({
                url: <?php echo json_encode(site_url('quiz/result_save')); ?>,     
                type: 'POST',
                data: {answers:string},
                dataType: 'json',
                success: function() {
                    localStorage.removeItem('selected');
                    $('#quizForm').submit();
                }
            });
        }
    </script>

    <script>
    $(document).ready(function() {

        $("#submitButton").click(function() {
            var string = JSON.stringify(selected);
            $.ajax({
                url: <?php echo json_encode(site_url('quiz/result_save')); ?>,
                type: 'POST',
                data: {answers:string},
                dataType: 'json',
                success: function() {
                    localStorage.removeItem('selected');
                    $('#quizForm').submit();
                }
            });
        });

        var questions = <?php echo json_encode($questions) ?>;
        var options = <?php echo json_encode($options) ?>;


        if(localStorage.getItem('selected')) {
            var selected = JSON.parse(localStorage.getItem('selected'));
            var quiz_id = <?php echo json_encode($id_enc) ?>;
            if(quiz_id !== selected['quiz_id']) {
                var selected = <?php echo json_encode($selected) ?>;
                localStorage.setItem('selected', JSON.stringify(selected));
            } else {
                var s = selected[0];
                if(s !== '-1') {
                    var tag = "#option"+s;
                    $(tag).prop('checked',true);
                }
            }
        } else {
            var selected = <?php echo json_encode($selected) ?>;
            localStorage.setItem('selected', JSON.stringify(selected));
        }

        var pageNo = 1;
        $('#question').text(questions[0]);
        $("#label1").text(options[0][0]);
        $("#label2").text(options[0][1]);
        $("#label3").text(options[0][2]);
        $("#label4").text(options[0][3]);
        $("#questionNoBox").text('Question '+ pageNo);

        $("input[name='radiobtn']").change(function() {
            var item = $('input[name="radiobtn"]:checked', '#options').val();
            selected[pageNo-1] = item;
            localStorage.setItem('selected',JSON.stringify(selected));
        });

        $('#questionNo').twbsPagination({
            totalPages: questions.length,
            visiblePages: questions.length,
            onPageClick: function (event, page) {
                $('input[name="radiobtn"]').attr('checked', false);
                if(selected[page-1] !== '-1') {
                    var s = selected[page-1];
                    var tag = "#option"+s;
                    $(tag).prop('checked',true);
                }

                pageNo = page;

                $('#question').text(questions[page-1]);
                $("#label1").text(options[page-1][0]);
                $("#label2").text(options[page-1][1]);
                $("#label3").text(options[page-1][2]);
                $("#label4").text(options[page-1][3]);
                $("#questionNoBox").text('Question '+ pageNo);
            }
        });

        var container = $('#pageNoBox > .page' );
        for(var i = 0; i < container.length; i += 4) {
            container.slice(i, i+4).wrapAll('<div class="row"></div>');
        }
    });
    </script>
    <?php endif; ?>

    <?php if($quiz->prize_money != 0): ?>

    <script>
        $(document).ready(function() {
            var button = $('#submitButton');
            $(button).prop('disabled', false);
        });
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

                    <div class="col-md-12 bottommargin-sm">
                        <div class="col-md-9">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="table-responsive exam-panel">
                                            <table class="table">
                                                <!-- Question -->
                                                <thead>
                                                    <tr>
                                                        <td>
                                                            <h4><div class="pull-left mrg-left"><strong id="questionNoBox">Question 1</strong></div></h4>
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong><div class="mrg-left" id="question"></div></strong>
                                                        </td>
                                                    </tr>
                                                </thead>

                                                <!-- Options -->
                                                <tbody class="radio-btn" id="options">
                                                    <tr>
                                                        <td>
                                                        <div class="radio">
                                                            <label>
                                                                <input name="radiobtn" id="option1" value="1" type="radio"><div id="label1"></div>
                                                            </label>
                                                        </div>

                                                        <div class="radio">
                                                            <label>
                                                                <input name="radiobtn" id="option2" value="2" type="radio"><div id="label2"></div>
                                                            </label>
                                                        </div>

                                                        <div class="radio">
                                                            <label>
                                                                <input name="radiobtn" id="option3" value="3" type="radio"><div id="label3"></div>
                                                            </label>
                                                        </div>

                                                        <div class="radio">
                                                            <label>
                                                                <input name="radiobtn" id="option4" value="4" type="radio"><div id="label4"></div>
                                                            </label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <!-- Prev Finish Next btns -->
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-2" id="previousBtn"></div>

                                                <div class="col-md-4 col-md-offset-2">
                                                    <button id="submitButton" class="btn btn-danger btn-sm btn-block" name="btnSubmit"><span class="glyphicon glyphicon-lock"></span>&nbsp;Finish</button>
                                                </div>                                          

                                                <div class="col-md-2 col-md-offset-2" id="nextBtn"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Side panel -->
                        <div class="col-md-3">
                            <div id="timer">
                                <div class="countdown" id="event-countdown">
                                </div>
                            </div>

                            <div class="panel-group" id="accordion">                        
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#questionNo">Question No</a></h4>
                                    </div>
                                    <div id="questionNo" class="panel-collapse collapse in"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        echo form_open('quiz/result/'.$quiz->slug.'/'.$id_enc, 'id="quizForm"');
                        echo form_hidden('checksum', $checksum);
                        echo form_close();
                    ?>
                </div>

            </div>

        </section>

<?php $this->load->view('components/page_tail'); ?>