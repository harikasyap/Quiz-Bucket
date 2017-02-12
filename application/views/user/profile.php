<?php $this->load->view('components/page_head'); ?>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div id="side-navigation">

                        <div class="col_one_third nobottommargin">

                            <ul class="sidenav">
                                <li class="ui-tabs-active"><a href="<?php echo site_url('user'); ?>"><i class="icon-line-head"></i>Profile<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/results'); ?>"><i class="icon-line-star"></i>Results<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/edit'); ?>"><i class="icon-line-paper"></i>Edit Information<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/change_password'); ?>"><i class="icon-line-lock"></i>Change Password<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/deactivate'); ?>"><i class="icon-line-ban"></i>De-activate account<i class="icon-line-fast-forward"></i></a></li>
                            </ul>

                        </div>

                        <div class="col_two_third col_last nobottommargin">

                            <div id="snav-content">
                                <h3><?php echo 'Welcome '.$user->first_name.' '.$user->last_name.'!';?></h3>

                                <div class="row">

                                    <div class="col-md-6 col-sm-6 bottommargin">
                                        <div class="promo promo-light promo-mini promo-center">
                                            <h3>Total Quizzes played</h3>
                                            <h1><i class="icon-th-list"></i><?php echo $total_quiz; ?></h1>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 bottommargin">
                                        <div class="promo promo-light promo-mini promo-center">
                                            <h3>Total Earnings</h3>
                                            <h1><i class="icon-rupee"></i><?php echo $total_earnings; ?></h1>
                                        </div>
                                    </div>

                                </div>

                                <div class="row clear-bottommargin">

                                    <div class="col-md-6 col-sm-6 bottommargin">
                                        <div class="promo promo-light promo-mini promo-center">
                                            <h3>Member since</h3>
                                            <h1><i class="icon-calendar3"></i><?php echo $member_since; ?></h1>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <div class="promo promo-light promo-mini promo-center">
                                            <h3>Total Quizzes brought</h3>
                                            <h1><i class="icon-money"></i><?php echo $total_quizzes_brought; ?></h1>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

<?php $this->load->view('components/page_tail'); ?>