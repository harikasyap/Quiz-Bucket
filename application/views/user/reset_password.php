<?php $this->load->view('components/page_head'); ?>

    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="tabs divcenter nobottommargin clearfix" id="tab-reset-password" style="max-width: 500px;">

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
                                    <?php echo form_open('', 'id="reset-password-form" name="reset-password-form" class="nobottommargin"'); ?>

                                    <h3>Reset Password</h3>
                                    
                                    <h5>Enter a new password to complete the reset password process</h5>

                                    <div class="col_full">
                                        <label for="reset-password-form-password">New Password:</label>
                                        <?php echo form_password('password', '', 'class="form-control" id="reset-password-form-password" required="required"'); ?>
                                    </div>

                                    <div class="col_full">
                                        <label for="reset-password-form-confirm-password">Confirm New Password:</label>
                                        <?php echo form_password('confirm_password', '', 'class="form-control" id="reset-password-form-confirm-password" required="required"'); ?>
                                    </div>

                                    <?php echo form_hidden($csrf); ?>
                                    <?php echo form_hidden('user_id', $user_id); ?>

                                    <div class="col_full nobottommargin">
                                        <button class="button button-4d button-black nomargin" id="reset-password-form-submit" name="reset-password-form-submit" value="submit" type="submit">Submit</button>
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