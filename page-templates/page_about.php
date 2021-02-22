<?php
/*
*   Template name: O WaterBridge
*/

get_header(); ?>

<main class="waterbridge waterbridge--subpage waterbridge--about">
    <section class="aboutHeader container">
        <div class="breadcrumb">
            <a href="/"><span>Strona główna</span></a> <a><span><?php the_title(); ?></span></a>
        </div>
        <div class="aboutHeader__wrap">
            <div class="aboutHeader__image">
                <img src="/wp-content/themes/waterbridge/images/about/heading_mockups.png"/>
            </div>
            <div class="aboutHeader__content">
                <div class="wrap">
                    <h1>O <b>WaterBridge</b></h1>
                    <p>Ceny mieszkań cały czas idą w górę, a chętnych na ich zakup wcale nie brakuje.
                        Wręcz przeciwnie. Inwestycje w nieruchomości stały się najpopularniejszym sposobem lokowania pieniędzy w Polsce...</p>
                    <a href="#" class="btn"><span>Poznaj zespół</span></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Logo -->
    <?php include get_template_directory() . '/template-parts/_frontReviewsLogo.php'; ?>

    <?php if( have_rows('about_team_list') ): ?>
    <section class="aboutTeam container">
        <div class="aboutTeam__content">
            <h2><?php the_field('about_team_title'); ?></h2>
            <p><?php the_field('about_team_content'); ?></p>
        </div>
        <div class="aboutTeam__team">
            <?php while( have_rows('about_team_list') ): the_row(); 
                $image = get_sub_field('about_team_list_image');
                $name = get_sub_field('about_team_list_name');
                $position = get_sub_field('about_team_list_position');
            ?>
            <div class="aboutTeam__person">
                <img src="<?php echo $image; ?>"/>
                <p class="name"><?php echo $name; ?></p>
                <p class="position"><?php echo $position; ?></p>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Reviews -->
    <?php include get_template_directory() . '/template-parts/_frontReviews.php'; ?>

    <!-- Map -->
    <?php include get_template_directory() . '/template-parts/_map.php'; ?>

    <!-- Invest form -->
    <?php include get_template_directory() . '/template-parts/_investForm.php'; ?>
</main>

<?php get_footer(); ?>