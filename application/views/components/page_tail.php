        <footer id="footer" class="dark">

            <div class="container">

                <div class="footer-widgets-wrap clearfix">

                    <div class="col_half">

                        <div class="widget clearfix">

                            <img src="<?php echo site_url('img/footer-widget-logo.png'); ?>" alt="" class="footer-logo">

                            <p>We believe in <strong>Simple</strong>, <strong>Creative</strong> &amp; <strong>Flexible</strong> Design Standards with a Retina &amp; Responsive Approach. Browse the amazing Features this template offers.</p>

                            <div class="clearfix" style="padding: 10px 0;">
                                <div class="col_half">
                                    <address class="nobottommargin">
                                        <abbr title="Address" style="display: inline-block;margin-bottom: 7px;"><strong>Address:</strong></abbr><br>
                                        Think Technologies,<br>
                                        Kinfra Industrial Park,<br>
                                        Thalassery, Kerala,<br>
                                        India - 670107<br>
                                    </address>
                                </div>
                                <div class="col_half col_last">
                                    <abbr title="Phone Number"><strong>Phone:</strong></abbr> (91) 9995 189 813<br>
                                    <abbr title="Email Address"><strong>Email:</strong></abbr> contact@quizbucket.com<br>
                                    <a href="https://www.facebook.com/quizbucket" class="social-icon si-small si-rounded topmargin-sm si-facebook">
                                        <i class="icon-facebook"></i>
                                        <i class="icon-facebook"></i>
                                    </a>

                                    <a href="#" class="social-icon si-small si-rounded topmargin-sm si-twitter">
                                        <i class="icon-twitter"></i>
                                        <i class="icon-twitter"></i>
                                    </a>

                                    <a href="#" class="social-icon si-small si-rounded topmargin-sm si-gplus">
                                        <i class="icon-gplus"></i>
                                        <i class="icon-gplus"></i>
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col_one_fourth">

                        <div class="widget clearfix">
                            <h4>User Testimonials</h4>

                            <div class="fslider testimonial no-image nobg noborder noshadow nopadding" data-animation="slide" data-arrows="false">
                                <div class="flexslider">
                                    <div class="slider-wrap">
                                        <div class="slide">
                                            <div class="testi-image">
                                                <a href="#"><img src="<?php echo site_url('images/testimonials/3.jpg'); ?>" alt="Customer Testimonails"></a>
                                            </div>
                                            <div class="testi-content">
                                                <p>Similique fugit repellendus expedita excepturi iure perferendis provident quia eaque. Repellendus, vero numquam?</p>
                                                <div class="testi-meta">
                                                    Steve Jobs
                                                    <span>Apple Inc.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide">
                                            <div class="testi-image">
                                                <a href="#"><img src="<?php echo site_url('images/testimonials/2.jpg'); ?>" alt="Customer Testimonails"></a>
                                            </div>
                                            <div class="testi-content">
                                                <p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
                                                <div class="testi-meta">
                                                    Collis Ta'eed
                                                    <span>Envato Inc.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide">
                                            <div class="testi-image">
                                                <a href="#"><img src="<?php echo site_url('images/testimonials/1.jpg'); ?>" alt="Customer Testimonails"></a>
                                            </div>
                                            <div class="testi-content">
                                                <p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>
                                                <div class="testi-meta">
                                                    John Doe
                                                    <span>XYZ Inc.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col_one_fourth col_last">

                        <div class="widget clearfix">
                            <h4>Recent Winners</h4>

                            <div id="post-list-footer">
                                <div class="spost clearfix">
                                    <div class="entry-image hidden-sm">
                                        <a href="#"><img class="img-circle" src="<?php echo site_url('img/small/1.jpg'); ?>" alt=""></a>
                                    </div>
                                    <div class="entry-c">
                                        <div class="entry-title">
                                            <h4><a href="#">Sample User 123</a></h4>
                                        </div>
                                        <ul class="entry-meta">
                                            <li>Sample 123 Quiz</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="spost clearfix">
                                    <div class="entry-image hidden-sm">
                                        <a href="#"><img class="img-circle" src="<?php echo site_url('img/small/1.jpg'); ?>" alt=""></a>
                                    </div>
                                    <div class="entry-c">
                                        <div class="entry-title">
                                            <h4><a href="#">Sample User 456</a></h4>
                                        </div>
                                        <ul class="entry-meta">
                                            <li>Sample 456 Quiz</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="spost clearfix">
                                    <div class="entry-image hidden-sm">
                                        <a href="#"><img class="img-circle" src="<?php echo site_url('img/small/1.jpg'); ?>" alt=""></a>
                                    </div>
                                    <div class="entry-c">
                                        <div class="entry-title">
                                            <h4><a href="#">Sample User 789</a></h4>
                                        </div>
                                        <ul class="entry-meta">
                                            <li>Sample 789 Quiz</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                </div>

            </div>

    </div>

    <div id="gotoTop" class="icon-angle-up"></div>

    <script type="text/javascript" src="<?php echo site_url('js/functions.js'); ?>"></script>

    <?php if ($this->session->flashdata('notify') != FALSE): ?>
    <script>
        $(document).ready(function() {
            var position = <?php echo ($this->session->flashdata('n_position') != FALSE)? json_encode($this->session->flashdata('n_position')) :json_encode('top-right'); ?>,
                type = <?php echo ($this->session->flashdata('n_type') != FALSE)? json_encode($this->session->flashdata('n_type')) : json_encode('info'); ?>,
                message = <?php echo json_encode($this->session->flashdata('n_message')); ?>,
                close = <?php echo ($this->session->flashdata('n_close') != FALSE)? json_encode('true'): json_encode('false'); ?>;

            SEMICOLON.widget.notifications(position, type, message, close);
        });
    </script>
    <?php endif; ?>

</body>
</html>