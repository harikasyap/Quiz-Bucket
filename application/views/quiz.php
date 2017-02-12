<?php $this->load->view('components/page_head'); ?>


        <section id="page-title">

            <div class="container clearfix">
                <h1>Quiz</h1>
                <span>Check out all our quizzes!!</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo site_url('quiz/free'); ?>">Free</a></li>
                    <li><a href="<?php echo site_url('quiz/archive'); ?>">Archive</a></li>
                </ol>
            </div>

        </section>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                <?php if(count($quiz) != 0): ?>

                    <ul id="portfolio-filter" class="clearfix">

                        <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>
                        <li><a href="#" data-filter=".pf-paid">Paid</a></li>
                        <li><a href="#" data-filter=".pf-free">Free</a></li>
                        <li><a href="#" data-filter=".pf-archive">Archive</a></li>

                    </ul>

                    <div class="clear"></div>

                    <div id="portfolio" class="clearfix">
	
                    	<?php foreach ($quiz as $qz): ?>

							<?php if ($qz->prize_money == 0): ?>
								<!--Free quiz-->

								<article class="portfolio-item pf-free">
		                            <div class="portfolio-image">
		                                <a href="<?php echo site_url('quiz/free/'.$qz->slug); ?>">
		                                    <img src="<?php echo site_url('img/quiz-free.jpg'); ?>" alt="<?php echo $qz->title; ?>">
		                                </a>
		                                <div class="portfolio-overlay">
		                                    <a class="quiz-link" href="<?php echo site_url('quiz/free/'.$qz->slug); ?>"><i class="icon-stopwatch"></i></a>
		                                </div>
		                            </div>
		                            <div class="portfolio-desc">
		                                <h3><?php echo anchor('quiz/free/'.$qz->slug, $qz->title); ?></a></h3>
		                                <span><?php $time = strtotime($qz->time_stamp); echo ' '.date('jS M, Y', $time);?></span>
		                            </div>
		                        </article>

							<?php elseif ( ($qz->date >= date('Y-m-d')) && ($qz->prize_money != 0) ): ?>
								<?php if($qz->cost == 0): ?>
								<!--Paid quiz-->

									<article class="portfolio-item pf-paid">
			                            <div class="portfolio-image">
			                                <a href="<?php echo site_url('quiz/'.$qz->slug); ?>">
			                                    <img src="<?php echo site_url('img/quiz-sponsored.jpg'); ?>" alt="<?php echo $qz->title; ?>">
			                                </a>
			                                <div class="portfolio-overlay">
			                                    <a class="quiz-link" href="<?php echo site_url('quiz/'.$qz->slug); ?>"><i class="icon-stopwatch"></i></a>
			                                </div>
			                            </div>
			                            <div class="portfolio-desc">
			                                <h3><?php echo anchor('quiz/'.$qz->slug, $qz->title); ?></a></h3>
			                                <span><?php $time = strtotime($qz->date); echo ' '.date('jS M, Y', $time);?></span>
			                            </div>
			                        </article>

								<?php else: ?>
								<!--Sponsored quiz-->

									<article class="portfolio-item pf-paid">
			                            <div class="portfolio-image">
			                                <a href="<?php echo site_url('quiz/'.$qz->slug); ?>">
			                                    <img src="<?php echo site_url('img/quiz-paid.jpg'); ?>" alt="<?php echo $qz->title; ?>">
			                                </a>
			                                <div class="portfolio-overlay">
			                                    <a class="quiz-link" href="<?php echo site_url('quiz/'.$qz->slug); ?>"><i class="icon-stopwatch"></i></a>
			                                </div>
			                            </div>
			                            <div class="portfolio-desc">
			                                <h3><?php echo anchor('quiz/'.$qz->slug, $qz->title); ?></a></h3>
			                                <span><?php $time = strtotime($qz->date); echo ' '.date('jS M, Y', $time);?></span>
			                            </div>
			                        </article>
								<?php endif; ?>

							<?php else: ?>
								<!--Archived quiz-->

								<?php if($qz->cost == 0): ?>
									<article class="portfolio-item pf-archive">
			                            <div class="portfolio-image">
			                                <a href="<?php echo site_url('quiz/'.$qz->slug); ?>">
			                                    <img src="<?php echo site_url('img/quiz-sponsored.jpg'); ?>" alt="<?php echo $qz->title; ?>">
			                                </a>
			                                <div class="portfolio-overlay">
			                                    <a class="quiz-link" href="<?php echo site_url('quiz/'.$qz->slug); ?>"><i class="icon-archive"></i></a>
			                                </div>
			                            </div>
			                            <div class="portfolio-desc">
			                                <h3><?php echo anchor('quiz/'.$qz->slug, $qz->title); ?></a></h3>
			                                <span><?php $time = strtotime($qz->date); echo ' '.date('jS M, Y', $time);?></span>
			                            </div>
			                        </article>
								<?php else: ?>
									<article class="portfolio-item pf-archive">
			                            <div class="portfolio-image">
			                                <a href="<?php echo site_url('quiz/'.$qz->slug); ?>">
			                                    <img src="<?php echo site_url('img/quiz-paid.jpg'); ?>" alt="<?php echo $qz->title; ?>">
			                                </a>
			                                <div class="portfolio-overlay">
			                                    <a class="quiz-link" href="<?php echo site_url('quiz/'.$qz->slug); ?>"><i class="icon-archive"></i></a>
			                                </div>
			                            </div>
			                            <div class="portfolio-desc">
			                                <h3><?php echo anchor('quiz/'.$qz->slug, $qz->title); ?></a></h3>
			                                <span><?php $time = strtotime($qz->date); echo ' '.date('jS M, Y', $time);?></span>
			                            </div>
			                        </article>
								<?php endif; ?>

							<?php endif; ?>

						<?php endforeach; ?>

                    </div>

                    <script type="text/javascript">

                        jQuery(window).load(function(){

                            var $container = $('#portfolio');

                            $container.isotope({ transitionDuration: '0.65s' });

                            $('#portfolio-filter a').click(function(){
                                $('#portfolio-filter li').removeClass('activeFilter');
                                $(this).parent('li').addClass('activeFilter');
                                var selector = $(this).attr('data-filter');
                                $container.isotope({ filter: selector });
                                return false;
                            });

                            $(window).resize(function() {
                                $container.isotope('layout');
                            });

                        });

                    </script>
				
				<?php endif; ?>
                </div>

            </div>

        </section>

<?php $this->load->view('components/page_tail'); ?>
