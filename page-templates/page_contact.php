<?php
/*
*   Template name: Kontakt
*/

get_header(); ?>

<main class="waterbridge waterbridge--subpage waterbridge--contact">
    <section class="contactHeading container">
        <div class="breadcrumb">
            <a href="/"><span>Strona główna</span></a> <a><span><?php the_title(); ?></span></a>
        </div>
        <div class="contactHeading__content">
            <h1>Dział obsługi <b>klienta</b></h1>
            <div class="contactHeading__persons">
                <img src="<?php the_field('pageContact_image'); ?>"/>
                <p class="person"><?php the_field('pageContact_person'); ?></p>
                <p class="position"><?php the_field('pageContact_person_position'); ?></p>
            </div>
            <div class="contactHeading__contact">
                <a href="tel:<?php the_field('pageContact_phone'); ?>" class="btn"><span>Zadzwoń <?php the_field('pageContact_phone'); ?></span></a>
                <p>lub napisz do nas na adres e-mail <a href="mailto:<?php the_field('pageContact_mail'); ?>"><?php the_field('pageContact_mail'); ?></a></p>
            </div>
        </div>
    </section>
    
    <!-- Map -->
    <?php include get_template_directory() . '/template-parts/_map.php'; ?>

    <!-- Invest form -->
    <?php include get_template_directory() . '/template-parts/_investForm.php'; ?>
</main>

<?php get_footer(); ?>