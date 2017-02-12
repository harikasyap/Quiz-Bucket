<?php $this->load->view('components/page_head'); ?>


        <section id="page-title">

            <div class="container clearfix">
                <h1>Question Bank</h1>
                <span>Check our Question banks for preparations for various exam!</span>
            </div>

        </section>

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">
                    <?php
                        $len = count($tags);
                        if($len == 1) {
                            echo '<div class="col_half">';
                            echo '<div class="list-group">';
                            echo '<a href="'.site_url('question_bank/'.$tags[0]->name).'" class="list-group-item">'.ucwords(str_replace('-', ' ', $tags[0]->name)).'</a>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            $c2 = $len/2;
                            $c1 = $len - $c2;

                            echo '<div class="col_half">';
                            echo '<div class="list-group">';
                            for ($i=0; $i <$c1; $i++) { 
                                echo '<a href="'.site_url('question_bank/'.$tags[$i]->name).'" class="list-group-item">'.ucwords(str_replace('-', ' ', $tags[$i]->name)).'</a>';
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="col_half col_last">';
                            echo '<div class="list-group">';
                            for ($i=$c1; $i <$len; $i++) { 
                                echo '<a href="'.site_url('question_bank/'.$tags[$i]->name).'" class="list-group-item">'.ucwords(str_replace('-', ' ', $tags[$i]->name)).'</a>';
                            }
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>
                </div>

            </div>

        </section>

<?php $this->load->view('components/page_tail'); ?>