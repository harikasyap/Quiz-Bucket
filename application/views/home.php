<?php $this->load->view('components/page_head'); ?>

        <!--Main Heading -->
        <section id="page-title" class="page-title-parallax page-title-dark" style="background-image: url('img/home-banner.jpg'); padding: 120px 0;" data-stellar-background-ratio="0.3">

            <div class="container clearfix">
                <h1>Play Online Quiz</h1>
                <span>Polish your intellectual skills and win cash prizes!!</span>
            </div>

        </section>

        <!-- Content -->
        <section id="content">

            <div class="content-wrap-home">

                <div class="container clearfix">

                    <div class="fancy-title title-center title-dotted-border topmargin">
                        <h3>Upcoming Quiz</h3>
                    </div>
                    <?php if(empty($quiz)): ?>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                                <div class="promo promo-border promo-mini center">
                                    <h3>No Upcoming Quizzes.<br>Try our free quizzes!</h3>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div id="oc-events" class="owl-carousel events-carousel">

                        <?php
                            $count = 0;
                            foreach ($quiz as $qz) {
                                if($count % 2 == 0) {
                                    echo '<div class="oc-item">';
                                }
    
                                $count += 1;

                                echo '<div class="ievent clearfix">';
                                echo '<div class="entry-image">';
                                echo '<a href="'.site_url('quiz/'.$qz->slug).'">';
                                if($qz->cost == 0) {
                                    echo '<img src="'.site_url('img/quiz-sponsored').'" alt="'.$qz->title.'">';
                                } else {
                                    echo '<img src="'.site_url('img/quiz-paid').'" alt="'.$qz->title.'">';                                    
                                }
                                $time = strtotime($qz->date);
                                echo '<div class="entry-date">'.date('j', $time).'<span>'.date('M', $time).'</span></div>';
                                echo '</a>';
                                echo '</div>';
                                echo '<div class="entry-c">';
                                echo '<div class="entry-title">';
                                echo '<h2><a href="'.site_url('quiz/'.$qz->slug).'">'.$qz->title.'</a></h2>';
                                echo '</div>';
                                echo '<ul class="entry-meta clearfix">';
                                if($qz->cost == 0) {
                                    echo '<li><span class="label label-primary">Sponsored</span></li>';
                                } else {
                                    echo '<li><span class="label label-warning">Paid</span></li>';
                                }
                                echo '<li><a href="#"><i class="icon-time"></i> '.substr($qz->start_time, 0, 5).' - '.substr($qz->end_time, 0, 5).'</a></li>';
                                echo '<li><a href="#"><i class="icon-rupee"></i> '.$qz->prize_money.'</a></li>';
                                echo '</ul>';
                                echo '</div>';
                                echo '</div>';

                                if($count % 2 == 0) {
                                    echo '</div>';
                                }
                            }
                            if($count % 2 != 0) {
                                echo '</div>';
                            }
                        ?>

                        </div>

                        <script type="text/javascript">

                            jQuery(document).ready(function($) {

                                var ocEvents = $("#oc-events");

                                ocEvents.owlCarousel({
                                    margin: 20,
                                    nav: true,
                                    navText: ['<i class="icon-angle-left"></i>','<i class="icon-angle-right"></i>'],
                                    autoplay: false,
                                    autoplayHoverPause: true,
                                    dots: false,
                                    responsive:{
                                        0:{ items:1 },
                                        1000:{ items:2 }
                                    }
                                });

                            });

                        </script>
                    <?php endif; ?>
                </div>
            
            </div>

            <div class="content-wrap" style="padding-top: 45px;">

                <div class="container clearfix">

                    <div class="clear"></div>

                    <div class="col_half">

                        <div class="fancy-title title-center title-dotted-border">
                            <h3>Question Bank</h3>
                        </div>

                        <ul class="list-group">
                            <?php
                                foreach ($tags as $t) {
                                    echo '<li class="list-group-item">';
                                    echo '<span class="badge"><a href="'.site_url('question_bank/'.$t->name).'">View</a></span>';
                                    echo ucwords(str_replace('-', ' ', $t->name));
                                    echo '</li>';
                                }
                            ?>
                        </ul>

                    </div>

                    <div class="col_half col_last">

                        <div class="fancy-title title-center title-dotted-border">
                            <h3>Current Affairs</h3>
                        </div>


                        <div id="post-list-footer">
                            
                            <?php 
                                foreach ($current_affairs as $cf) {
                                    echo '<div class="spost clearfix">';
                                    echo '<div class="entry-c">';
                                    echo '<div class="entry-title">';
                                    echo '<h4><a href="'.site_url('current_affairs/'.$cf->id).'">'.$cf->title.'</a></h4>';
                                    echo '</div>';
                                    echo '<ul class="entry-meta">';
                                    $time = strtotime($cf->date);
                                    echo '<li>'.date('jS M, Y', $time).'</li>';
                                    echo '</ul>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            ?>

                        </div>

                    </div>

                </div>

            </div>

        </section>

<?php $this->load->view('components/page_tail'); ?>