<?php if( have_rows('frontReviewsLogo_list') ): ?>
<section class="frontReviewsLogo container<?php if (is_page('o-waterbridge')){echo ' frontReviewsLogo--about';}?>">
    <?php if (is_page('o-waterbridge')):?>
        <h2>Współpracujemy z...</h2>
    <?php else: ?>
        <div class="frontReviewsLogo__flag">
            Opinie inwestorów
        </div>
    <?php endif; ?>
    <div class="frontReviewsLogo__slidersWrap">
        <div class="frontReviewsLogo__logoSlider">
            <?php while( have_rows('frontReviewsLogo_list') ): the_row(); 
                $logo = get_sub_field('frontReviewsLogo_list_logo');
            ?>
            <div class="frontReviewsLogo__logoSlide">
                <img src="<?php echo $logo; ?>"/>
            </div>
            <?php endwhile; ?>
        </div>
        
        <div class="frontReviewsLogo__contentSlider contentSlider">
            <?php while( have_rows('frontReviewsLogo_list') ): the_row(); 
                $content = get_sub_field('frontReviewsLogo_list_content');
                $author = get_sub_field('frontReviewsLogo_list_author');
                $source = get_sub_field('frontReviewsLogo_list_source');
            ?>
            <div class="frontReviewsLogo__contentSlide">
                <p>"<?php echo $content; ?>"</p>
                <p class="author"><?php echo $author; ?></p>
                <p class="source"><?php echo $source; ?></p>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>