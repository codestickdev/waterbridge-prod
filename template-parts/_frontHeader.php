<section class="frontHeader container">
    <div class="frontHeader__content">
        <img src="/wp-content/themes/waterbridge-prod/images/logo.svg" />
        <h1><?php the_field('frontHeader_title'); ?></h1>
        <p><?php the_field('frontHeader_content'); ?></p>
        <?php $link = get_field('frontHeader_btn'); ?>
        <a href="<?php echo $link['url']; ?>" class="btn"><span><?php echo $link['title']; ?></span></a>
    </div>
</section>