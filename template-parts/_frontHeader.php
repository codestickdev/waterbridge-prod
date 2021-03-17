<section class="frontHeader container">
    <div class="frontHeader__content">
        <img src="/wp-content/themes/waterbridge-prod/images/logo.svg" />
        <h1><?php the_field('frontHeader_title'); ?></h1>
        <p><?php the_field('frontHeader_content'); ?></p>
        <?php $link = get_field('frontHeader_btn'); ?>
        <?php if(is_user_logged_in()): ?>
            <a href="<?php echo $link['url']; ?>" class="btn"><span><?php echo $link['title']; ?></span></a>
        <?php else: ?>
            <a class="btn openPopup-login"><span><?php echo $link['title']; ?></span></a>
        <?php endif; ?>
    </div>
</section>