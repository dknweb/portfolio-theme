<?php
/**
 * Theme Footer
 *
 * @package PortfolioTheme
 */
?> 

<footer id="contact" class="site-footer">

    <div class="site-footer-top">
        <div class="container">

            <div class="site-footer-top__inner">

                <?php get_template_part( 'template-parts/footer/about' ); ?>

                <?php get_template_part( 'template-parts/footer/navigation' ); ?>

            </div>

        </div>
    </div>

    <?php get_template_part( 'template-parts/footer/bottom' ); ?>

</footer>


<?php wp_footer(); ?>
</body>
</html>
