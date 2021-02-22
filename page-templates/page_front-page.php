<?php
/*
*   Template name: Strona główna
*/

get_header(); ?>

<main class="waterbridge waterbridge--frontpage">
    <?php include get_template_directory() . '/template-parts/_frontHeader.php'; ?>
    <?php
    switch_to_blog(2);
    $args = array(
        'numberposts'    => 6,
        'post_type'        => 'projects',
    );
    $the_query = new WP_Query($args);
    ?>
    <?php if ($the_query->have_posts()) : ?>
        <section class="projectSlider">
            <div class="projectSlider__wrap container">
                <div class="projectSliderList">
                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                        <?php
                            $date_from  = current_time('d.m.Y');
                            $date_to    = get_field('tile_info_date');

                            $date_1     = new DateTime(date('Y-m-d', strtotime($date_from)));
                            $date_2     = new DateTime(date('Y-m-d', strtotime($date_to)));

                            $days       = $date_1->diff($date_2)->days;
                        ?>
                        <?php include get_template_directory() . '/template-parts/_tile.php'; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php wp_reset_query();
        switch_to_blog(1); 
    ?>

    <!-- Investor Area -->
    <?php include get_template_directory() . '/template-parts/_investorArea.php'; ?>

    <!-- e-book -->
    <?php include get_template_directory() . '/template-parts/_ebook.php'; ?>

    <!-- News -->
    <?php include get_template_directory() . '/template-parts/_frontNews.php'; ?>

    <!-- About -->
    <?php include get_template_directory() . '/template-parts/_frontAbout.php'; ?>

    <!-- Reviews -->
    <?php include get_template_directory() . '/template-parts/_frontReviews.php'; ?>

    <!-- Reviews Logo -->
    <?php include get_template_directory() . '/template-parts/_frontReviewsLogo.php'; ?>

</main>

<?php get_footer(); ?>