<?php $this->load->view('components/page_head'); ?>


        <section id="page-title">

            <div class="container clearfix">
                <h1>Quiz</h1>
                <span>Check out our past quizzes!</span>
                <ol class="breadcrumb">
                    <li><a href="<?php echo site_url('quiz'); ?>">Quiz</a></li>
                    <li class="active">Archive</li>
                </ol>
            </div>

        </section>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                <?php if(count($quiz) != 0): ?>

                    <div class="clear"></div>

                    <div id="portfolio" class="clearfix">
	
                    	<?php foreach ($quiz as $qz): ?>

							<article class="portfolio-item">
	                            <div class="portfolio-image">
	                                <a href="<?php echo site_url('quiz/'.$qz->slug); ?>">
                                        <?php if($qz->cost == 0): ?>
                                            <img src="<?php echo site_url('img/quiz-sponsored.jpg'); ?>" alt="<?php echo $qz->title; ?>">
                                        <?php else: ?>
                                            <img src="<?php echo site_url('img/quiz-paid.jpg'); ?>" alt="<?php echo $qz->title; ?>">
                                        <?php endif; ?>
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

						<?php endforeach; ?>

                    </div>
				
				<?php endif; ?>
                </div>

            </div>

        </section>

<?php $this->load->view('components/page_tail'); ?>
