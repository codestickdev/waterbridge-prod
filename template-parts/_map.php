<section class="contactMap<?php if (is_page('o-waterbridge')){echo ' contactMap--about';}?>">
    <div class="contactMap__map"><?php echo do_shortcode('[google_map_easy id="1"]') ?></div>
    <div class="contactMap__heading">
        <h2>Nasze biuro</h2>
    </div>
    <div class="contactMap__office">
        <img src="<?php the_field('map_officeimage', 135) ?>" />
        <div class="content">
            <p>
                <b>Waterbridge Sp. z o. o.</b><br />
                <?php the_field('map_address', 135) ?><br /><br />
                Recepcja czynna: <?php the_field('map_openHours', 135) ?>
            </p>
        </div>
        <a href="<?php the_field('map_maplink', 135) ?>" target="_blank" class="btn"><span>Wyznacz trasę</span></a>
    </div>
    <div class="contactMap__agent container">
        <a href="#" class="btnAgent">
            <img class="agent" src="/wp-content/themes/waterbridge-prod/images/icons/agent_ico.png" />
            <span>Potrzebujesz pomocy?</br />Nasz agent jest on-line</span>
            <img class="tel" src="/wp-content/themes/waterbridge-prod/images/icons/agent_tel_ico.svg" />
        </a>
    </div>
</section>