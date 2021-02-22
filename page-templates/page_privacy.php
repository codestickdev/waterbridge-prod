<?php
/*
*   Template name: Polityka Prywatności
*/

get_header(); ?>

<main class="waterbridge waterbridge--subpage waterbridge--privacy">
    <section class="privacyHeading container">
        <div class="breadcrumb">
            <a href="/"><span>Strona główna</span></a> <a><span><?php the_title(); ?></span></a>
        </div>
    </section>
    <section class="privacyContent container">
        <h1>Polityka <b>prywatności</b></h1>
        <div class="privacyContent__content">
            <?php the_field('privacy_policy_content'); ?>
        </div>
        <a href="/" class="btn"><span>Wróć do strony głównej</span></a>
        <div class="clearfixsection"></div>
    </section>
</main>

<?php get_footer(); ?>