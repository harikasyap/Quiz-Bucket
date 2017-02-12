<?php /*

	<link rel="stylesheet" href="<?php echo site_url('css/jquery-ui.css'); ?>">
    <script src="<?php echo site_url('js/jquery-1.10.2.js'); ?>"></script>
    <script src="<?php echo site_url('js/jquery-ui.js'); ?>"></script>
    <script>
	$(function() {
	    $( "#datepicker" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			minDate: '-68Y',
			maxDate: '-5Y'
	    });
	});
    </script>

*/?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo site_url('css/jquery-ui.css'); ?>">
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

    <title><?php echo $title; ?></title>

    <script src="<?php echo site_url('js/jquery-ui.js'); ?>"></script>
    <script>
    $(function() {
        $( "input[name='dob']" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            minDate: '-68Y',
            maxDate: '-5Y'
        });
    });
    </script>

</head>

<body class="stretched">
    
    <div id="wrapper" class="clearfix">

        <header id="header" class="full-header">

            <div id="header-wrap">

                <div class="container clearfix">

                    <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                    <div id="logo">
                        <a href="<?php echo site_url(); ?>" class="standard-logo" data-dark-logo="<?php echo site_url('img/logo-dark.png'); ?>"><img src="<?php echo site_url('img/logo.png'); ?>" alt="Quiz Bucket Logo"></a>
                        <a href="<?php echo site_url(); ?>" class="retina-logo" data-dark-logo="<?php echo site_url('img/logo-dark@2x.png'); ?>"><img src="<?php echo site_url('img/logo@2x.png'); ?>" alt="Quiz Bucket Logo"></a>
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

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="tabs divcenter nobottommargin clearfix" id="tab-register" style="max-width: 500px;">

                        <div class="tab-container">

                            <div class="tab-content clearfix">
                                <div class="panel panel-default nobottommargin">
                                    <div class="panel-body" style="padding: 40px;">
                                        <?php
                                            if($message) {
                                                echo '<div class="alert alert-warning alert-danger" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <strong>Warning!</strong>'.$message.'</div>';
                                            }
                                        ?>
                                        <?php echo form_open('', 'id="register-form" name="register-form" class="nobottommargin"'); ?>

                                        <h3>Register for an Account</h3>

                                        <div class="col_half">
                                            <label for="register-form-first-name">First Name:</label>
                                            <?php echo form_input('first_name', set_value('first_name', ''), 'class="form-control" id="register-form-first-name" required="required"'); ?>
                                        </div>

                                        <div class="col_half col_last">
                                            <label for="register-form-last-name">Last Name:</label>
                                            <?php echo form_input('last_name', set_value('last_name', ''), 'class="form-control" id="register-form-last-name" required="required"'); ?>
                                        </div>

                                        <div class="col_full">
                                            <label for="register-form-email">Email:</label>
                                            <input type="email" id="register-form-email" name="email" value="<?php echo set_value('email', ''); ?>" class="form-control" required="required" />
                                        </div>

                                        <div class="col_full">
                                            <label for="register-form-password">Password:</label>
                                            <?php echo form_password('password', '', 'class="form-control" id="register-form-password" required="required"'); ?>
                                        </div>

                                        <div class="col_full">
                                            <label for="register-form-confirm-password">Confirm Password:</label>
                                            <?php echo form_password('confirm_password', '', 'class="form-control" id="register-form-confirm-password" required="required"'); ?>
                                        </div>

                                        <div class="col_half">
                                            <label for="register-form-gender">Gender:</label>
                                            <?php
    	                                        $options_gender = array(
    												'' => '',
    												'female' => 'Female',
    												'male' => 'Male',
    												'other' => 'Other'
    											);
    											
    											echo form_dropdown('gender', $options_gender, set_value('gender', ''), 'id="register-form-gender" class="sm-form-control" required="required"');
    										?>
                                        </div>

                                        <div class="col_half col_last">
                                            <label for="register-form-dob">Date of Birth:</label>
                                            <?php echo form_input('dob', set_value('dob', ''), 'class="form-control" id="register-form-dob" required="required" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"'); ?>
                                        </div>

                                        <div class="col_full">
                                            <label for="register-form-edu-qual">Educational Qualification:</label>
                                            <?php
    	                                        $options_qualification = array(
    												'' => '',
    				        						'below_matriculation' => 'Below Matriculation',
    				        						'matriculate' => 'Matriculate',
    				        						'higher_secondary' => 'Higher Secondary',
    				        						'graduate' => 'Graduate',
    				        						'post_graduate' => 'Post Graduate'
    											);
    											
    											echo form_dropdown('edu_qual', $options_qualification, set_value('edu_qual', ''), 'id="register-form-edu-qual" class="sm-form-control" required="required"');
    										?>
                                        </div>

                                        <div class="col_full">
                                            <label for="register-form-address-1">Address Line 1:</label>
                                            <?php echo form_input('address_1', set_value('address_1', ''), 'class="form-control" id="register-form-address-1" required="required"'); ?>
                                        </div>

                                        <div class="col_full">
                                            <label for="register-form-address-2">Address Line 2:</label>
                                            <?php echo form_input('address_2', set_value('address_2', ''), 'class="form-control" id="register-form-address-2" required="required"'); ?>
                                        </div>

                                        <div class="col_half">
                                            <label for="register-form-city">City:</label>
                                            <?php echo form_input('city', set_value('city', ''), 'class="form-control" id="register-form-city" required="required"'); ?>
                                        </div>

                                        <div class="col_half col_last">
                                            <label for="register-form-state">State:</label>
                                            <?php
    	                                        $options_states = array(
    												'' => '',
    												'andaman_and_nicobar' => 'Andaman and Nicobar',
    												'andhra_pradesh' => 'Andhra Pradesh',
    												'arunachal_pradesh' => 'Arunachal Pradesh',
    												'assam' => 'Assam',
    												'bihar' => 'Bihar',
    												'chandigarh' => 'Chandigarh',
    												'chhattisgarh' => 'Chhattisgarh',
    												'dadra_and_nagar_haveli' => 'Dadra and Nagar Haveli',
    												'daman_and_diu' => 'Daman and Diu',
    												'delhi' => 'Delhi',
    												'goa' => 'Goa',
    												'gujarat' => 'Gujarat',
    												'haryana' => 'Haryana',
    												'himachal_pradesh' => 'Himachal Pradesh',
    												'Jammu_and_kashmir' => 'Jammu and Kashmir',
    												'jharkhand' => 'Jharkhand',
    												'karnataka' => 'Karnataka',
    												'kerala' => 'Kerala',
    												'madhya_pradesh' => 'Madhya Pradesh',
    												'maharashtra' => 'Maharashtra',
    												'manipur' => 'Manipur',
    												'meghalaya' => 'Meghalaya',
    												'mizoram' => 'Mizoram',
    												'nagaland' => 'Nagaland',
    												'odisha' => 'Odisha',
    												'puducherry' => 'Puducherry',
    												'punjab' => 'Punjab',
    												'rajasthan' => 'Rajasthan',
    												'sikkim' => 'Sikkim',
    												'tamil_nadu' => 'Tamil Nadu',
    												'telangana' => 'Telangana',
    												'tripura' => 'Tripura',
    												'uttar_pradesh' => 'Uttar Pradesh',
    												'uttarakhand' => 'Uttarakhand',
    												'west_bengal' => 'West Bengal',
    												'lakshadweep' => 'Lakshadweep'
    											);
    											
    											echo form_dropdown('state', $options_states, set_value('state', ''), 'id="register-form-state" class="sm-form-control" required="required"');
    										?>
                                        </div>

                                        <div class="col_full">
                                            <label for="register-form-pincode">Pincode:</label>
                                            <?php echo form_input('pincode', set_value('pincode', ''), 'class="form-control" id="register-form-pincode" required="required" pattern="\d{6}" title="6 digit pin"'); ?>
                                        </div>

                                        <div class="col_full">
                                            <label for="register-form-mobile-no">Mobile number:</label>
                                            <?php echo form_input('phone_no', set_value('phone_no', ''), 'class="form-control" id="register-form-mobile-no" required="required" pattern="\d{10}" title="10 digit mobile number"'); ?>
                                        </div>

                                        <div class="col_full nobottommargin">
                                            <button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="signup" type="submit">Sign Up</button>
                                        </div>

                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

<?php $this->load->view('components/page_tail'); ?>