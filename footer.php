        <!-- footer -->

        <footer class="footer" role="contentinfo">
                <div class="footer-wrapper">

                        <div class="logo">
                                <?php echo file_get_contents(get_template_directory_uri() . "/logopath.svg") ?>
                        </div>

                        <div class="adress">

                                <p>Adress</p>
                                <p>Adress</p>
                        </div>

                        <div class="phone">
                                <a href="tel:9999999"><span>T</span>+99999999999</a>
                                <a href="tel:9999999"><span>M</span>+99999999999</a>
                        </div>
                        <div class="mail">
                                <a href="mailto:email@gmail.com"><span>E</span>email@gmail.com</a>
                                <a href="www.website.com"><span>W</span>www.website.com</a>
                        </div>

                        <div class="sub-pages">
                                <a href="impressum">Impressum</a>
                                <a href="datenschutz">Datenschutz</a>
                        </div>
                </div>
        </footer>

        <!-- /footer -->
        <?php wp_footer(); ?>


        </body>

        </html>