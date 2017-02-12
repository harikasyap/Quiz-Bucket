<?php $this->load->view('components/page_head'); ?>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="postcontent nobottommargin clearfix">

                    <h3><?php echo ucwords(str_replace('-', ' ', $tag->name)); ?></h3>
                        
                        <?php
                            if(!empty($t_questions)) {
                                foreach ($t_questions as $q) {
                                    echo '<div class="toggle">';
                                    echo '<div class="togglet"><i class="toggle-closed icon-question-sign"></i><i class="toggle-open icon-ok"></i>'.$q->question.'</div>';
                                    echo '<div style="display: none;" class="togglec"> <em>'.$q->answer.'</em></div>';
                                    echo '</div>';
                                    echo '<div class="line-seprt"></div>';
                                }
                                if($pagination == TRUE) {
                                    echo $this->pagination->create_links();
                                }
                            } else {
                                echo '<p>No Questions to display!</p>';
                            }
                        ?>

                    </div>

                </div>

            </div>

        </section>

<?php $this->load->view('components/page_tail'); ?>