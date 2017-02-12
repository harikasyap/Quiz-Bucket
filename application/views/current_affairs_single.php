<?php $this->load->view('components/page_head'); ?>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="single-post nobottommargin">

                        <div class="postcontent nobottommargin clearfix">

                            <div class="entry clearfix">

                                <div class="entry-title">
                                    <h2><?php echo $c_affair->title; ?></h2>
                                </div>

                                <ul class="entry-meta clearfix">
                                    <?php $time = strtotime($c_affair->date); ?>
                                    <li><i class="icon-calendar3"></i> <?php echo date('jS F, Y', $time); ?></li>
                                </ul>

                                <div class="entry-content notopmargin">

                                    <p><?php echo $c_affair->description; ?></p>

                                    <div class="clear"></div>

                                    <!-- <div class="si-share noborder clearfix">
                                        <span>Share this Post:</span>
                                        <div>
                                            <a href="#" class="social-icon si-borderless si-facebook">
                                                <i class="icon-facebook"></i>
                                                <i class="icon-facebook"></i>
                                            </a>
                                            <a href="#" class="social-icon si-borderless si-twitter">
                                                <i class="icon-twitter"></i>
                                                <i class="icon-twitter"></i>
                                            </a>
                                            <a href="#" class="social-icon si-borderless si-gplus">
                                                <i class="icon-gplus"></i>
                                                <i class="icon-gplus"></i>
                                            </a>
                                        </div>
                                    </div> -->

                                </div>
                            </div>

                            <div class="post-navigation clearfix">

                                <?php 
                                    if(!empty($ca_previous) && empty($ca_next)) {
                                        echo '<div class="col_half nobottommargin">';
                                        echo '<a href="'.site_url('current_affairs/'.$ca_previous->id).'">&lArr; '.$ca_previous->title.'</a>';
                                        echo '</div>';
                                    } elseif (empty($ca_previous) && !empty($ca_next)) {
                                        echo '<div class="col_half col_last tright nobottommargin" style="float: right;">';
                                        echo '<a href="'.site_url('current_affairs/'.$ca_next->id).'">'.$ca_next->title.' &rArr;</a>';
                                        echo '</div>';
                                    } elseif(!empty($ca_previous) && !empty($ca_next)) {
                                        echo '<div class="col_half nobottommargin">';
                                        echo '<a href="'.site_url('current_affairs/'.$ca_previous->id).'">&lArr; '.$ca_previous->title.'</a>';
                                        echo '</div>';
                                        
                                        echo '<div class="col_half col_last tright nobottommargin">';
                                        echo '<a href="'.site_url('current_affairs/'.$ca_next->id).'">'.$ca_next->title.' &rArr;</a>';
                                        echo '</div>';
                                    }
                                ?>

                            </div>

                            <div class="line"></div>

                        </div>

                        <div class="sidebar nobottommargin col_last clearfix">
                            <div class="sidebar-widgets-wrap">

                                <div class="widget widget-twitter-feed clearfix">

                                    <h4>All Posts</h4>
                                    <ul id="sidebar-twitter-list-1" class="iconlist">
                                        <?php
                                            foreach ($sidebar as $year => $month) {
                                                echo '<li><i class="icon-play"></i> <a href="'.site_url('current_affairs/sort/'.$year).'">'.$year.'<a></li>';
                                            }
                                        ?>
                                    </ul>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

<?php $this->load->view('components/page_tail'); ?>