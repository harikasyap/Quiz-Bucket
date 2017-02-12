<?php $this->load->view('components/page_head'); ?>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div id="side-navigation">

                        <div class="col_one_third nobottommargin">

                            <ul class="sidenav">
                                <li><a href="<?php echo site_url('user'); ?>"><i class="icon-line-head"></i>Profile<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/results'); ?>"><i class="icon-line-star"></i>Results<i class="icon-line-fast-forward"></i></a></li>
                                <li class="ui-tabs-active"><a href="<?php echo site_url('user/edit'); ?>"><i class="icon-line-paper"></i>Edit Information<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/change_password'); ?>"><i class="icon-line-lock"></i>Change Password<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/deactivate'); ?>"><i class="icon-line-ban"></i>De-activate account<i class="icon-line-fast-forward"></i></a></li>
                            </ul>

                        </div>

                        <div class="col_two_third col_last nobottommargin">

                            <div id="snav-content">

                                <div class="tabs divcenter nobottommargin clearfix" id="tab-change-info" style="max-width: 500px;">

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
                                                <?php echo form_open('', 'id="change-info-form" name="change-info-form" class="nobottommargin"'); ?>

                                                <h3>Edit Personal Information</h3>
                                                
                                                <h5>Update your personal informations</h5>

                                                <div class="col_full">
                                                    <label for="change-info-edu-qual">Educational Qualification:</label>
                                                    <?php
                                                        $options_qualification = array(
                                                            '' => '',
                                                            'below_matriculation' => 'Below Matriculation',
                                                            'matriculate' => 'Matriculate',
                                                            'higher_secondary' => 'Higher Secondary',
                                                            'graduate' => 'Graduate',
                                                            'post_graduate' => 'Post Graduate'
                                                        );
                                                        
                                                        echo form_dropdown('edu_qual', $options_qualification, set_value('edu_qual', $u->edu_qual), 'id="change-info-edu-qual" class="sm-form-control" required="required"');
                                                    ?>
                                                </div>

                                                <div class="col_full">
                                                    <label for="change-info-address">Address:</label>
                                                    <?php echo form_input('address', set_value('address', $u->address), 'class="form-control" id="change-info-address" required="required"'); ?>
                                                </div>

                                                <div class="col_half">
                                                    <label for="change-info-city">City:</label>
                                                    <?php echo form_input('city', set_value('city', $u->city), 'class="form-control" id="change-info-city" required="required"'); ?>
                                                </div>

                                                <div class="col_half col_last">
                                                    <label for="change-info-state">State:</label>
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
                                                        
                                                        echo form_dropdown('state', $options_states, set_value('state', $u->state), 'id="change-info-state" class="sm-form-control" required="required"');
                                                    ?>
                                                </div>

                                                <div class="col_full">
                                                    <label for="change-info-pincode">Pincode:</label>
                                                    <?php echo form_input('pincode', set_value('pincode', $u->pincode), 'class="form-control" id="change-info-pincode" required="required" pattern="\d{6}" title="6 digit pin"'); ?>
                                                </div>

                                                <div class="col_full">
                                                    <label for="change-info-mobile-no">Mobile number:</label>
                                                    <?php echo form_input('phone_no', set_value('phone_no', $u->phone_no), 'class="form-control" id="change-info-mobile-no" required="required" pattern="\d{10}" title="10 digit mobile number"'); ?>
                                                </div>

                                                <?php echo form_hidden($csrf); ?>
                                                <?php echo form_hidden('user_id', $user_id); ?>

                                                <div class="col_full nobottommargin">
                                                    <button class="button button-4d button-black nomargin" id="change-info-form-submit" name="change-info-form-submit" value="submit" type="submit">Submit</button>
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