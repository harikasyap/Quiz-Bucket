<?php $this->load->view('components/page_head'); ?>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div id="side-navigation">

                        <div class="col_one_third nobottommargin">

                            <ul class="sidenav">
                                <li><a href="<?php echo site_url('user'); ?>"><i class="icon-line-head"></i>Profile<i class="icon-line-fast-forward"></i></a></li>
                                <li class="ui-tabs-active"><a href="<?php echo site_url('user/results'); ?>"><i class="icon-line-star"></i>Results<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/edit'); ?>"><i class="icon-line-paper"></i>Edit Information<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/change_password'); ?>"><i class="icon-line-lock"></i>Change Password<i class="icon-line-fast-forward"></i></a></li>
                                <li><a href="<?php echo site_url('user/deactivate'); ?>"><i class="icon-line-ban"></i>De-activate account<i class="icon-line-fast-forward"></i></a></li>
                            </ul>

                        </div>

                        <div class="col_two_third col_last nobottommargin">

                            <div id="snav-content">
                                <h3>Results</h3>

                                <?php if(count($results) != 0): ?>

                                    <?php $count = 1; ?>
                                    
                                    <?php foreach ($results as $r): ?>
                                        <?php if($r->rank != 0): ?>
                                            
                                            <div class="col_one_third <?php if ($count % 3 == 0) { echo 'col_last'; } ?>">
                                                <div class="feature-box fbox-large fbox-plain">
                                                    <div class="fbox-icon">
                                                        <a href="#"><i class="icon-money"></i></a>
                                                    </div>
                                                    <h3><?php echo anchor('quiz/'.$quizzes_paid[$r->quiz_id]->slug, $quizzes_paid[$r->quiz_id]->title); ?></h3>
                                                    <p>Total questions: <?php echo $r->total_questions; ?></p>
                                                    <p>Attempted: <?php echo $r->attempted; ?></p>
                                                    <p>Total correct: <?php echo $r->total_correct; ?></p>
                                                    <p>Score: <?php echo $r->score.' / '.$r->total_questions; ?></p>
                                                    <p>Rank: <?php echo $r->rank; ?></p>
                                                </div>
                                            </div>

                                        <?php else: ?>

                                            <div class="col_one_third <?php if ($count % 3 == 0) { echo 'col_last'; } ?>">
                                                <div class="feature-box fbox-large fbox-plain">
                                                    <div class="fbox-icon">
                                                        <a href="#"><i class="icon-star"></i></a>
                                                    </div>
                                                    <h3><?php echo anchor('quiz/free/'.$quizzes_free[$r->quiz_id]->slug, $quizzes_free[$r->quiz_id]->title); ?></h3>
                                                    <p>Total questions: <?php echo $r->total_questions; ?></p>
                                                    <p>Attempted: <?php echo $r->attempted; ?></p>
                                                    <p>Total correct: <?php echo $r->total_correct; ?></p>
                                                    <p>Score: <?php echo $r->score.' / '.$r->total_questions; ?></p>
                                                </div>
                                            </div>

                                        <?php endif; ?>
                                        <?php $count += 1; ?>
                                    <?php endforeach; ?>

                                <?php else: ?>
                                    No results to display.
                                <?php endif; ?>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

<?php $this->load->view('components/page_tail'); ?>