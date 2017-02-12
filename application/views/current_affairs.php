<?php $this->load->view('components/page_head'); ?>


        <section id="page-title">

            <div class="container clearfix">
                <h1>Current Affairs</h1>
                <span>Check out the top news around the globe!</span>
            </div>

        </section>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="postcontent nobottommargin clearfix">

                        <div id="posts">

                            <?php
                                foreach ($ca_recent as $ca) {
                                    echo '<div class="entry clearfix">';
                                    echo '<div class="entry-title">';
                                    echo '<h2><a href="'.site_url('current_affairs/'.$ca->id).'">'.$ca->title.'</a></h2>';
                                    echo '</div>';
                                    echo '<ul class="entry-meta clearfix">';
                                    $time = strtotime($ca->date);
                                    echo '<li><i class="icon-calendar3"></i> '.date('jS M, Y', $time).'</li>';
                                    echo '</ul>';
                                    echo '<div class="entry-content">';
                                    if(strlen($ca->description) > 342) {
                                        echo '<p>'.substr($ca->description, 0, 339).'...</p>';
                                        echo '<a href="'.site_url('current_affairs/'.$ca->id).'" class="more-link">Read More</a>';
                                    } else {
                                        echo '<p>'.$ca->description.'</p>';
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                }
                            ?>

                        </div>
                        <?php if($more): ?>
                            <ul class="pager nomargin">
                                <li class="next"><a href="<?php echo site_url('current_affairs/p/2'); ?>" class="btn" role="button">Older &rarr;</a></li>
                            </ul>
                        <?php endif; ?>

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

        </section>

<?php $this->load->view('components/page_tail'); ?>