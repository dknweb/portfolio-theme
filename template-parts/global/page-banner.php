<?php
$page_badge = get_post_meta(
    get_the_ID(),
    '_portfolio_page_badge',
    true
);

$banner_title = ! empty( $args['title'] )
	? $args['title']
	: get_the_title();
?>

<section class="page-banner" aria-labelledby="page-title">
    <div class="container">
        <div class="page-banner__inner">

            <?php if ( $page_badge ) : ?>
                <span class="badge page-banner__badge animate-fade-up">
                    <?php echo esc_html( $page_badge ); ?>
                </span>
            <?php endif; ?>

            <h1 id="page-title" class="page-banner__title animate-fade-up animate-delay-200">
                <?php echo esc_html( $banner_title ); ?>
            </h1>

            <?php if ( has_excerpt() ) : ?>
                <div class="page-banner__excerpt animate-fade-up animate-delay-400">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>