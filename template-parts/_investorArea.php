<section class="investorArea container">
    <div class="investorArea__image">
        <img src="/wp-content/themes/waterbridge-prod/images/investorarea_iphone2.png" />
    </div>
    <div class="investorArea__content">
        <div class="wrap">
            <h2><?php the_field('frontInvest_title', 12); ?></h2>
            <p><?php the_field('frontInvest_content', 12); ?></p>
            <?php $link = get_field('frontInvest_btn', 12); ?>
            <?php if(is_user_logged_in()): ?>
                <a href="<?php echo $link['url']; ?>" class="btn"><span><?php echo $link['title']; ?></span></a>
            <?php else: ?>
                <a class="btn openPopup-login"><span><?php echo $link['title']; ?></span></a>
            <?php endif; ?>
        </div>
    </div>
</section>