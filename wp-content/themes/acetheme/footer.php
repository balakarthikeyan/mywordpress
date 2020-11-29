    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 footer-row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 footer-col">
                        <?php if ( get_header_image() && false ) : ?>
                            <div class="logo">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
                                    <img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
                                </a>
                            </div>
                        <?php endif; ?>                    
                        <h5 class="no-margin-top">Products</h5>
                        <ul class="footer-nav">
                            <li>
                                <h6>Conversational Engagement</h6>
                            </li>
                            <li>
                                <a target="_blank">Engagement for Amazon Connect</a>
                            </li>
                            <li>
                                <a target="_blank">Engagement for Cisco Enterprise (LCM)</a>
                            </li>
                            <li>
                                <a target="_blank">Engagement for Cisco Express (U-Nexsys)</a>
                            </li>
                            <li>
                                <a target="_blank">Engagement for NICE inContact​</a>
                            </li>
                            <li>
                                <a target="_blank">Engagement for Twilio Flex</a>
                            </li>
                            <li>
                                <a target="_blank">Desktop & Connectors (LYNX)</a>
                            </li>
                            <li>
                                <a target="_blank">Identity Verification</a>
                            </li>
                            <li>
                                <a target="_blank">Callback Manager (iAssist)​</a>
                            </li>
                            <li>
                                <a target="_blank">Survey Manager (iAssist)</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 footer-col">
                        <h5 class="no-margin-top">&nbsp;</h5>
                        <ul class="footer-nav">
                            <li>
                                <h6>Analytics & Control</h6>
                            </li>
                            <li>
                                <a target="_blank">Analytics​</a>
                            </li>
                            <li>
                                <a target="_blank">Next Best Action</a>
                            </li>
                            <li>
                                <a target="_blank">Command Center​</a>
                            </li>
                        </ul>
                        <h5>Solutions</h5>
                        <ul class="footer-nav">
                            <li>
                                <a target="_blank">Banking</a>
                            </li>
                            <li>
                                <a target="_blank">Tele Health</a>
                            </li>
                            <li>
                                <a target="_blank">COVID-19</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 footer-col">
                        <h5 class="no-margin-top">Company</h5>
                        <ul class="footer-nav">
                            <li>
                                <a target="_blank">About us</a>
                            </li>
                            <li>
                                <a target="_blank">Leadership</a>
                            </li>
                            <li>
                                <a target="_blank">Investors</a>
                            </li>
                            <li>
                                <a target="_blank">Careers</a>
                            </li>
                            <li>
                                <a target="_blank">Support</a>
                            </li>
                            <li>
                                <a target="_blank">Resources</a>
                            </li>
                            <li>
                                <a target="_blank">Blog</a>
                            </li>                      
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 footer-row">
                    <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 footer-col col-divider">
                        <h5 class="no-margin-top">Legal</h5>
                        <ul class="footer-nav">
                            <li>
                                <a target="_blank">Privacy Policy</a>
                            </li>
                            <li>
                                <a target="_blank">Subscription Agreement</a>
                            </li>
                            <li>
                                <a target="_blank">End User Licensing Agreement</a>
                            </li>
                            <li>
                                <a target="_blank">Patents</a>
                            </li>
                            <li>
                                <a target="_blank">Licensed Patents</a>
                            </li>                    
                        </ul>
                        <h6>Follow Us</h6>
                        <div class="footer-social">
                            <ul>
                                <li>
                                    <a href="<?php echo get_option('facebook'); ?>" title="<?php bloginfo( 'name' ); ?>" target="_blank" class="social-facebook" rel="nofollow noopener noreferrer"><i class="fa fa-facebook-f"></i></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo get_option('twitter'); ?>" title="<?php bloginfo( 'name' ); ?>" target="_blank" class="social-twitter" rel="nofollow noopener noreferrer"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="<?php echo get_option('linkedin'); ?>" title="<?php bloginfo( 'name' ); ?>" target="_blank" class="social-linkedin" rel="nofollow noopener noreferrer"><i class="fa fa-linkedin-in"></i></a>
                                </li>
                            </ul>
                        </div>
                        <p class="copyright">&copy; 2020 Acqueon Technologies Inc.</p>                
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12 footer-col">
                        <h5 class="no-margin-top">About Acqueon</h5>
                        <p class="section-content">Acqueon's conversational engagement software lets customer-centric brands orchestrate campaigns and proactively engage with consumers using voice, messaging, and email channels. 
                        Acqueon leverages a rich data platform, statistical and predictive models, and intelligent workflows to let enterprises maximize the potential of every customer conversation.
                        Acqueon is trusted by 200 clients across industries to increase sales, improve collections and re-engage with otherwise-defecting customers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="short-footer"></div>
    </footer>
</div>

<a class="btn back-to-top" role="button" data-toggle="tooltip" data-placement="left">
    <span class="fa fa-arrow-up"></span>
</a>

<?php wp_footer(); ?>

</body>
</html>