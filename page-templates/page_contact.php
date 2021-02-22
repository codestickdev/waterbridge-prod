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
                <img src="/wp-content/themes/waterbridge/images/icons/persons_contact.png"/>
                <p class="person">Radosław Parzybroda</p>
                <p class="position">Starszy konsultant klienta</p>
            </div>
            <div class="contactHeading__contact">
                <a href="tel:22 564 38 98" class="btn"><span>Zadzwoń 22 564 38 98</span></a>
                <p>lub napisz do nas na adres e-mail <a href="mailto:bok@waterbridge.pl">bok@waterbridge.pl</a></p>
            </div>
        </div>
    </section>
    
    <!-- Map -->
    <?php include get_template_directory() . '/template-parts/_map.php'; ?>

    <!-- Invest form -->
    <?php include get_template_directory() . '/template-parts/_investForm.php'; ?>
</main>

<?php get_footer(); ?>