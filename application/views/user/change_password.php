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
                                <li class="ui-tabs-active"><a href="<?php echo site_url('user/change_password'); ?>"><i class="icon-line-lock"></i>Change Password<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/deactivate'); ?>"><i class="icon-line-ban"></i>De-activate account<i class="icon-line-fast-forward"></i></a></li>
                            </ul>

                        </div>

                        <div class="col_two_third col_last nobottommargin">

                            <div id="snav-content">

                                <div class="tabs divcenter nobottommargin clearfix" id="tab-change-password" style="max-width: 500px;">

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
                                                <?php echo form_open('', 'id="change-password-form" name="change-password-form" class="nobottommargin"'); ?>

                                                <h3>Change Password</h3>
                                                
                                                <h5>Enter a new password to change your old password</h5>

                                                <div class="col_full">
                                                    <label for="change-password-form-old-password">Old Password:</label>
                                                    <?php echo form_password('old_password', '', 'class="form-control" id="change-password-form-password" required="required"'); ?>
                                                </div>

                                                <div class="col_full">
                                                    <label for="change-password-form-new-password">New Password:</label>
                                                    <?php echo form_password('new_password', '', 'class="form-control" id="change-password-form-new-password" required="required"'); ?>
                                                </div>

                                                <div class="col_full">
                                                    <label for="change-password-form-confirm-new-password">Confirm New Password:</label>
                                                    <?php echo form_password('confirm_new_password', '', 'class="form-control" id="change-password-form-confirm-new-password" required="required"'); ?>
                                                </div>

                                                <?php echo form_hidden($csrf); ?>
                                                <?php echo form_hidden('user_id', $user_id); ?>

                                                <div class="col_full nobottommargin">
                                                    <button class="button button-4d button-black nomargin" id="change-password-form-submit" name="change-password-form-submit" value="submit" type="submit">Submit</button>
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