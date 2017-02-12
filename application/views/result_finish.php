<?php $this->load->view('components/page_head'); ?>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">
                
                <p><span>Total Questions: </span><?php echo $post['total_questions']; ?></p>
                <p><span>Attempted: </span><?php echo $post['attempted']; ?></p>
                <p><span>Total correct: </span><?php echo $post['total_correct']; ?></p>
                <p><span>Score: </span><?php echo $post['score'].' / '.$post['total_questions']; ?></p>
                <?php if($quiz->prize_money != 0): ?>
                <p><span>Rank: </span><?php echo $post['rank']; ?></p>
                <?php endif; ?>
                </div>

            </div>

        </section>

<?php $this->load->view('components/page_tail'); ?>