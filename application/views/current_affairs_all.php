<?php $this->load->view('components/page_head'); ?>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="postcontent nobottommargin clearfix">

                        <div id="posts">

                            <?php
                                foreach ($current_affairs as $ca) {
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

                        <?php
                            if(empty($newer_link) && !empty($older_link)) {
                                echo '<ul class="pager nomargin">';
                                echo '<li class="previous"><a href="#" class="btn disabled" role="button">&larr; Newer</a></li>';
                                echo '<li class="next"><a href="'.$older_link.'" class="btn" role="button">Older &rarr;</a></li>';
                                echo '</ul>';
                            } elseif (!empty($newer_link) && empty($older_link)) {
                                echo '<ul class="pager nomargin">';
                                echo '<li class="previous"><a href="'.$newer_link.'" class="btn" role="button">&larr; Newer</a></li>';
                                echo '<li class="next"><a href="#" class="btn disabled" role="button">Older &rarr;</a></li>';
                                echo '</ul>';
                            } elseif(!empty($newer_link) && !empty($older_link)) {
                                echo '<ul class="pager nomargin">';
                                echo '<li class="previous"><a href="'.$newer_link.'" class="btn" role="button">&larr; Newer</a></li>';
                                echo '<li class="next"><a href="'.$older_link.'" class="btn" role="button">Older &rarr;</a></li>';
                                echo '</ul>';
                            }
                        ?>

                    </div>

                    <div class="sidebar nobottommargin col_last clearfix">
                        <div class="sidebar-widgets-wrap">
                                
                            <div class="widget widget-twitter-feed clearfix">

                                <h4>All Posts</h4>
                                <ul id="sidebar-twitter-list-1" class="iconlist">
                                    <?php
                                        if($list == 'year') {

                                            foreach ($sidebar as $year => $month) {
                                                if($year == $y) {
                                                    echo '<li><i class="icon-play"></i> '.$year.'</li>';
                                                    echo '<ul class="iconlist">';
                                                    foreach ($month as $m_name => $m_no) {
                                                        echo '<li><i class="icon-play"></i> <a href="'.site_url('current_affairs/sort/'.$year.'-'.$m_no).'">'.$m_name.'<a></li>';
                                                    }
                                                    echo '</ul>';
                                                } else {
                                                    echo '<li><i class="icon-play"></i> <a href="'.site_url('current_affairs/sort/'.$year).'">'.$year.'<a></li>';
                                                }
                                            }

                                        } elseif($list == 'month') {

                                            foreach ($sidebar as $year => $month) {
                                                if($year == $y) {
                                                    echo '<li><i class="icon-play"></i> '.$year.'</li>';
                                                    echo '<ul class="iconlist">';
                                                    foreach ($month as $m_name => $m_no) {
                                                        if($m_no == $m) {
                                                            echo '<li><i class="icon-play"></i> '.$m_name.'</li>';
                                                        } else {
                                                            echo '<li><i class="icon-play"></i> <a href="'.site_url('current_affairs/sort/'.$year.'-'.$m_no).'">'.$m_name.'<a></li>';
                                                        }
                                                    }
                                                    echo '</ul>';

                                                } else {
                                                    echo '<li><i class="icon-play"></i> <a href="'.site_url('current_affairs/sort/'.$year).'">'.$year.'<a></li>';
                                                }
                                            }

                                        } else {
                                            foreach ($sidebar as $year => $month) {
                                                echo '<li><i class="icon-play"></i> <a href="'.site_url('current_affairs/sort/'.$year).'">'.$year.'<a></li>';
                                            }
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