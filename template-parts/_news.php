<article class="news">
    <div class="news__wrap">
        <div class="news__thumb">
            <a href="<?php the_permalink(); ?>">
                <img src="<?php the_field('news_thumb') ?>" />
            </a>
        </div>
        <h2>Inwestowanie w nieruchomości<br /><b><?php the_title(); ?></b></h2>
        <p><?php the_field('news_excerpt'); ?></p>
        <a href="<?php the_permalink(); ?>">Czytaj dalej...</a>
    </div>
</article>