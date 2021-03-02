<section class="ebook container<?php if (is_page('artykuly')){echo ' ebook--archive';}?>">
    <a href="#" class="btnAgent">
        <img class="agent" src="/wp-content/themes/waterbridge-prod/images/icons/agent_ico.png"/>
        <span>Potrzebujesz pomocy?</br/>Nasz agent jest on-line</span>
        <img class="tel" src="/wp-content/themes/waterbridge-prod/images/icons/agent_tel_ico.svg"/>
    </a>
    <div class="ebook__content">
        <div class="wrap">
            <h2><?php the_field('frontEbook_title', 12); ?></h2>
            <p><?php the_field('frontEbook_content', 12); ?></p>
            <a href="<?php the_field('frontEbook_btn') ?>" class="btn"><span>Pobierz e-book</span></a>
        </div>
    </div>
    <div class="ebook__image">
        <img src="/wp-content/themes/waterbridge-prod/images/ebook_mockup.png" />
    </div>
</section>