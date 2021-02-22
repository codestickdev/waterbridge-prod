<?php
/*
*   Template name: Artykuły
*/

get_header(); ?>

<main class="waterbridge waterbridge--subpage waterbridge--archive">
    <section class="archiveHeading container">
        <div class="breadcrumb">
            <a href="/"><span>Strona główna</span></a> <a><span><?php the_title(); ?></span></a>
        </div>
        <div class="archiveHeading__content">
            <h1>Artykuły <b>dla inwestorów</b></h1>
            <p>Dowiedź się więcej o inwestowaniu w nieruchomości i dołącz do grona inwestorów. </p>
        </div>
    </section>
    <section class="archiveArticles container">
        <?php 
        $args = array(
            'numberposts'	=> -1,
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

    <!-- e-book -->
    <?php include get_template_directory() . '/template-parts/_ebook.php'; ?>
    
</main>

<?php get_footer(); ?>