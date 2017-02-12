<?php $this->load->view('components/page_head'); ?>

    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="tabs divcenter nobottommargin clearfix" id="tab-login" style="max-width: 500px;">

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
                                    <?php echo form_open('', 'id="login-form" name="login-form" class="nobottommargin"'); ?>

                                    <h3>Login to your Account</h3>

                                    <div class="col_full">
                                        <label for="login-form-email">Email:</label>
                                        <input type="email" id="login-form-email" name="email" value="<?php echo set_value('email', ''); ?>" class="form-control" required="required" />
                                    </div>

                                    <div class="col_full">
                                        <label for="login-form-password">Password:</label>
                                        <?php echo form_password('password', '', 'class="form-control" id="login-form-password" required="required"'); ?>
                                    </div>

                                    <div class="col_full">
                                        <label for="login-form-remeber">Remember me:</label>
                                        <?php echo form_checkbox('remember', 1, set_checkbox('active', 1, ''), 'class="form-control" id="login-form-remeber" name="login-form-remeber"'); ?>
                                    </div>

                                    <div class="col_full nobottommargin">
                                        <button class="button button-3d button-black nomargin" id="login-form-submit" name="login-form-submit" value="login" type="submit">Login</button>
                                        <a href="<?php echo site_url('user/forgot_password'); ?>" class="fright">Forgot Password?</a>
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