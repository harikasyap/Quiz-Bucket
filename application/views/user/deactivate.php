<?php $this->load->view('components/page_head'); ?>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div id="side-navigation">

                        <div class="col_one_third nobottommargin">

                            <ul class="sidenav">
                                <li><a href="<?php echo site_url('user'); ?>"><i class="icon-line-head"></i>Profile<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/results'); ?>"><i class="icon-line-star"></i>Results<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/edit'); ?>"><i class="icon-line-paper"></i>Edit Information<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/change_password'); ?>"><i class="icon-line-lock"></i>Change Password<i class="icon-line-fast-forward"></i></a></li>
                                <li class="ui-tabs-active"><a href="<?php echo site_url('user/deactivate'); ?>"><i class="icon-line-ban"></i>De-activate account<i class="icon-line-fast-forward"></i></a></li>
                            </ul>

                        </div>

                        <div class="col_two_third col_last nobottommargin">

                            <div id="snav-content">

                                <div class="tabs divcenter nobottommargin clearfix" id="tab-deactivate-ac" style="max-width: 500px;">

                                    <div class="tab-content clearfix">
                                        <div class="panel panel-default nobottommargin center">
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
                                                <?php echo form_open('', 'id="deactivate-ac-form" name="deactivate-ac-form" class="nobottommargin"'); ?>

                                                <h3>Deactivate your account</h3>
                                                
                                                <h5>Click the button to deactivate your <?php echo $site_title; ?> account. Use with caution as you may need to contact admin to activate your account later.</h5>

                                                <?php echo form_hidden($csrf); ?>
                                                <?php echo form_hidden('user_id', $user_id); ?>

                                                <div class="col_full nobottommargin">
                                                    <button class="button button-4d button-black nomargin" id="deactivate-ac-form-submit" name="deactivate-ac-form-submit" value="deactivate" type="submit">DEACTIVATE</button>
                                                </div>

                                                <?php echo form_close(); ?>
                                            </div>
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