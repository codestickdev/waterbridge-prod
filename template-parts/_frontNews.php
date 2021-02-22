<section class="frontNews__wrap">
    <section class="frontNews container">
    <?php 
    $args = array(
        'numberposts'	=> 2,
        'post_type'		=> 'aktualnosci',
    );
    $the_query = new WP_Query( $args );
    ?>
    <?php if( $the_query->have_posts() ): ?>
        <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <?php include get_template_directory() . '/template-parts/_news.php' ?>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_query();	?>
    </section>
</section>