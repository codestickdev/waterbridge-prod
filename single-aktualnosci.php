<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Waterbridge
 * 
 */

get_header();
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#masthead').addClass('siteHeader--white');
    });
</script>

<div class="waterbridge waterbridge--subpage waterbridge--article">
    <section class="articleHeader" style="background-image: url('<?php the_field('news_header_bg') ?>')">
        <div class="articleHeader__wrap container">
            <div class="breadcrumb">
                <a href="/"><span>Strona główna</span></a> <a href="/artykuly"><span>Artykuły</span></a> <a><span><?php the_title(); ?></span></a>
            </div>
            <div class="articleHeader__content">
                <h1><?php the_field('news_header_title') ?></h1>
                <p class="lead"><?php the_field('news_header_lead') ?></p>
            </div>
        </div>
    </section>
    <section class="articleContent container-min">
        <div class="articleContent__start">
            <h2><?php the_field('news_enter_title') ?></h2>
            <p><?php the_field('news_enter_content') ?></p>
        </div>
        <div class="articleContent__before">
            <?php the_field('news_content_before') ?>
        </div>
        <?php if( have_rows('project_infoSlider') ): ?>
        <section class="projectInfoSliderWrap projectInfoSliderWrap--news">
            <div class="projectInfoSlider container-min">
                <?php while( have_rows('project_infoSlider') ): the_row(); 
                    $title = get_sub_field('project_infoSlider_title');
                    $content = get_sub_field('project_infoSlider_content');
                    $image = get_sub_field('project_infoSlider_image');
                ?>
                <div class="projectInfoSlider__slide projectInfoSlide">
                    <div class="projectInfoSlide__dots" count="<?php echo get_row_index(); ?>">
                        <?php for($i=0; $i < 3; $i++): ?>
                            <span></span>
                        <?php endfor; ?>
                    </div>
                    <div class="projectInfoSlide__count">
                        <?php if(get_row_index() > 9): ?>
                            <span><?php echo get_row_index(); ?></span>
                        <?php else: ?>
                            <span>0<?php echo get_row_index(); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="projectInfoSlide__next">
                        <img src="/wp-content/themes/waterbridge/images/icons/angle_right.svg"/>
                    </div>

                    <div class="projectInfoSlide__content">
                        <div class="wrap">
                            <h2><?php echo $title; ?></h2>
                            <p><?php echo $content; ?></p>
                        </div>
                    </div>
                    <div class="projectInfoSlide__image">
                        <img src="<?php echo $image; ?>"/>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="articleProjects">
                <a href="/aktualne-projekty" target="_blank" class="btn"><span>Zobacz projekty</span></a>
            </div>
        </section>
        <?php endif; ?>
        <div class="articleContent__after">
            <?php the_field('news_content_after') ?>
        </div>
    </section>
    <section class="articleMore container">
        <h2>Zobacz też...</h2>
        <div class="articleMore__articles">
            <?php 
            $args = array(
                'numberposts'	=> -1,
                'post_type'		=> 'aktualnosci',
            );
            $the_query = new WP_Query( $args );
            ?>
            <?php if( $the_query->have_posts() ): ?>
                <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <?php include get_template_directory() . '/template-parts/_news.php' ?>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_query();	?>
        </div>
    </section>
</div>

<?php
get_footer();