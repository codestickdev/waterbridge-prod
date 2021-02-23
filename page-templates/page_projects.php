<?php
/*
*   Template name: Aktualne projekty
*/

get_header(); ?>

<main class="waterbridge waterbridge--subpage waterbridge--projects">
    <section class="subpageHeader container subpageHeader--projects">
        <div class="breadcrumb">
            <a href="/"><span>Strona główna</span></a> <a><span><?php the_title(); ?></span></a>
        </div>
        <h1>Aktualne <b>projekty</b></h1>
        <p>Dowiedź się więcje o naszych projektach i dołącz do grona inwestorów.</p>
        <div class="catSelect">
            <button class="catSelect__btn active" select="all">Wszystkie (<span class="all">0</span>)</button>
            <button class="catSelect__btn" select="current">Aktualne (<span class="current">0</span>)</button>
            <button class="catSelect__btn" select="closed">Zakończone (<span class="closed">0</span>)</button>
        </div>
    </section>
    <section class="projectsFilter container">
        <div class="projectsFilter__database">
        <?php
            switch_to_blog(2);
            $args = array(
                'numberposts'   => -1,
                'post_type'     => 'projects',
                'post_status'   => 'publish',
            );
            $the_query = new WP_Query($args);
        ?>
        <?php if ($the_query->have_posts()) : ?>
            <ul class="prices">
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <li data="<?php the_field('tile_info_price'); ?>"></li>
            <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
        </div>
        <div class="projectsFilter__wrap">
            <div class="projectsFilter__filter">
                <p class="projectsFilter__secTitle">Filtruj według:</p>
                <div class="filterRow filterRow--value">
                    <p><span class="value">Wartość inwestycji</span> <img src="/wp-content/themes/waterbridge-prod/images/icons/filter_ico.svg"/></p>
                    <div class="filterDropdown dropdown">
                        <label class="amount amount--from">Koszt inwestycji od: <input type="text" id="valFrom" value="10 PLN" /></label>
                        <label class="amount amount--to">Koszt inwestycji do: <input type="text" id="valTo" value="100 PLN" /></label>
                        <div id="slider-range"></div>
                    </div>
                </div>
                <div class="filterRow filterRow--location">
                    <p><span class="value">Lokalizacja</span> <img src="/wp-content/themes/waterbridge-prod/images/icons/filter_ico.svg"/></p>
                    <div class="filterDropdown dropdown">
                        <p class="title">Dostępne lokalizacje</p>
                        <?php
                            $args = array(
                                'numberposts'   => -1,
                                'post_type'     => 'projects',
                                'post_status'   => 'publish',
                            );
                            $the_query = new WP_Query($args);
                        ?>
                        <?php if ($the_query->have_posts()) : ?>
                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                <div class="dropdown__checkbox not-checked">
                                    <input type="checkbox" name="<?php the_field('tile_address'); ?>"/>
                                    <label for="<?php the_field('tile_address'); ?>"><?php the_field('tile_address'); ?></label>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
            </div>
            <div class="projectsFilter__sort">
                <p class="projectsFilter__secTitle">Sortuj według: <span>Najnowsze</span> <img src="/wp-content/themes/waterbridge-prod/images/icons/filter_ico.svg"/></p>
            </div>
        </div>
    </section>
    <?php
    $args = array(
        'numberposts'    => -1,
        'post_type'        => 'projects',
        'post_status'   => 'publish',
    );
    $the_query = new WP_Query($args);
    ?>
    <?php if ($the_query->have_posts()) : ?>
        <section class="projectList container">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <?php
                    $date_from  = current_time('d.m.Y');
                    $date_to    = get_field('tile_info_date');

                    $date_1     = new DateTime(date('Y-m-d', strtotime($date_from)));
                    $date_2     = new DateTime(date('Y-m-d', strtotime($date_to)));

                    $days       = $date_1->diff($date_2)->days;
                    if($date_1 >= $date_2){
                        $days = 0;
                    }
                    ?>
                    <?php include get_template_directory() . '/template-parts/_tile.php'; ?>
                <?php endwhile; ?>
        </section>
    <?php endif; ?>
    <?php wp_reset_query();
        switch_to_blog(1);
    ?>
    <section class="newsletter">
        <img class="newsletter__zig" src="/wp-content/themes/waterbridge-prod/images/newsletter_zig.svg"/>
        <div class="newsletter__wrap">
            <h2>Nie zanlazłeś intersującej Cię <b>inwestycji</b>?</h2>
            <p>Zapisz się na naszą listę inwestorów i zdobądź pierwszy informację o nowej inwestycji.</p>
            <form class="newsletter__form">
                <input type="email" class="newsletter__mail" placeholder="Twój adres e-mail"/>
                <div class="newsletter__checkbox not-checked">
                    <input type="checkbox" name="checkbox"/>
                    <label for="checkbox">Wyrażam zgodę na przetwarzanie moich danych osobowych w adresu do korespondencji w celu przesyłania mi informacji marketingowych.</label>
                </div>
                <input type="submit" class="newsletter__submit" value="Zapisz mnie"/>
            </form>
        </div>
    </section>
</main>

<?php get_footer(); ?>