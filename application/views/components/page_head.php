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
    <link rel="shortcut icon" href="<?php echo site_url('img/favicon.ico'); ?>" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <script type="text/javascript" src="<?php echo site_url('js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('js/plugins.js'); ?>"></script>

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
                                if($current_page == 'User') {
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