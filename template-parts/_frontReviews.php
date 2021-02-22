<section class="frontReviews container<?php if (is_page('o-waterbridge')){echo ' frontReviews--about';}?>">
    <div class="frontReviews__flag">Mówią o nas</div>
    <div class="frontReviews__image">
        <img src="/wp-content/themes/waterbridge-prod/images/reviews_iphone.png"/>
    </div>
    <div class="frontReviews__content">
        <?php if (is_page('o-waterbridge')):?>
            <h2>Mówią <b>o nas</b></h2>
        <?php endif; ?>
        <div class="wrap">
        <?php if( have_rows('frontReviews_list', 12) ): ?>
            <div class="reviewsSlider">
            <?php while( have_rows('frontReviews_list', 12) ): the_row(); 
                $logo = get_sub_field('frontReviews_list_logo', 12);
                $quote = get_sub_field('frontReviews_list_quote', 12);
                $source = get_sub_field('frontReviews_list_source', 12);
                ?>
                <div class="reviewsSlider__slide">
                    <div class="wrap">
                        <div class="thumb">
                            <img src="<?php echo $logo; ?>"/>
                        </div>
                        <p class="quote">"<?php echo $quote; ?>"</p>
                        <p class="source"><?php echo $source; ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php if( have_rows('frontReviews_list', 12) ): ?>
            <div class="reviewsDotsSlider">
            <?php while( have_rows('frontReviews_list', 12) ): the_row(); 
                $logo = get_sub_field('frontReviews_list_logo', 12);
                ?>
                <div class="reviewsDotsSlider__slide">
                    <img src="<?php echo $logo ?>"/>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
        </div>
    </div>
</section>