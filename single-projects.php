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

<main class="waterbridge waterbridge--project">
    <section class="projectHeading" style="background-image: url('<?php the_field('project_heading_image'); ?>')">
        <div class="projectHeading__overlay"></div>
        <div class="projectHeading__wrap container">
            <div class="breadcrumb">
                <a href="/"><span>Strona główna</span></a> <a href="/aktualne-projekty"><span>Aktualne projekty</span></a> <a><span><?php the_title(); ?></span></a>
            </div>
            <div class="projectHeading__content">
                <h1><?php the_field('project_heading_name'); ?></h1>
                <p><?php the_field('tile_address'); ?></p>
                <a class="btn btn--video"><span>Zobacz video</span></a>
            </div>
        </div>
    </section>
    <section class="projectSimpleStatus container">
        <div class="projectStatusArrow projectStatusArrow--toBottom projectStatusArrow--maxLeft"><img src="/wp-content/themes/waterbridge-prod/images/icons/statusBar_arrow.svg"/></div>
        <div class="projectSimpleStatus__bar">
            <div class="projectSimpleStatus__status"></div>
        </div>
        <div class="projectStatusTile projectStatusTile--maxLeft projectStatusTile--toBottom">
            <div class="projectStatusTile__database">
                <?php
                $post_id = get_the_ID();
                $total = 0;
                $blogusers = get_users('blog_id=2');
                foreach ($blogusers as $user) :
                    $user_id = 'user_' . esc_html($user->ID);
                ?>
                    <?php if (have_rows('user_investment', $user_id)) : ?>
                        <?php while (have_rows('user_investment', $user_id)) : the_row();
                            $investments = get_sub_field('user_investment_name');
                            $investmentID = $investments['selected_posts'][0];
                            $value = get_sub_field('user_investment_value');
                            $requestAccept = get_sub_field('user_investment_accept');
                        ?>
                            <?php if ($requestAccept == 'true'): ?>
                                <?php if ($investmentID == $post_id) : ?>
                                    <span class="value" style="display: none;"><?php echo $value; ?></span>
                                    <span class="investor" style="display: none;">1</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="projectStatusTile__info">
                <p><span class="targetPercent">0</span>% zrealizowanego celu</p>
                <p class="status"><span class="total">0</span> / <span class="target"><?php the_field('tile_info_price'); ?></span> PLN</p>
            </div>
            <div class="projectStatusTile__investors">
                <img src="/wp-content/themes/waterbridge-prod/images/icons/investments_ico.svg"/>
                <p class="investors_count"><span class="investors">0</span> inwestorów</p>
            </div>
        </div>
    </section>
    <?php if( have_rows('project_gallery') ): ?>
    <section class="projectGallery container-min">
        <ul class="projectGallery__list">
        <?php while( have_rows('project_gallery') ): the_row(); 
            $image = get_sub_field('project_gallery_image');
            ?>
            <li class="projectGallery__image">
                <div class="overlay">
                    <img src="/wp-content/themes/waterbridge-prod/images/icons/zoom.svg"/>
                </div>
                <img class="slideimage" src="<?php echo $image; ?>"/>
            </li>
        <?php endwhile; ?>
        </ul>
    </section>
    <?php endif; ?>
    <section class="projectDescription">
        <div class="projectDescription__wrap container-min">
            <div class="projectDescription__content">
                <h2><?php the_field('project_desc_title'); ?></h2>
                <p><?php the_field('project_desc_content'); ?></p>
            </div>
            <div class="projectDescription__basic">
            <?php if( have_rows('project_desc_basic') ): ?>
                <div class="wrap">
                <?php while( have_rows('project_desc_basic') ): the_row(); 
                    $icon = get_sub_field('project_desc_basic_icon');
                    $text = get_sub_field('project_desc_basic_content');
                    ?>
                    <div class="box">
                        <div class="box__icon">
                            <img src="<?php echo $icon; ?>"/>
                        </div>
                        <div class="box__content">
                            <p><?php echo $text; ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </section>
    <section class="projectPresentation">
        <div class="projectPresentation__wrap">
            <h2>Prezentacja <b>projektu</b></h2>
            <p>Wszystkie informacje o inwestycji możesz z naleźć w przygotowaniej przez nas prezentacji.</p>
            <a href="#" class="btn btn--download"><span>Pobierz prezentację i dane projektu</span></a>
        </div>
    </section>
    <?php if( have_rows('project_infoSlider') ): ?>
    <section class="projectInfoSliderWrap">
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
                    <img src="/wp-content/themes/waterbridge-prod/images/icons/angle_right.svg"/>
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
    </section>
    <?php endif; ?>
    <section class="projectStatus">
        <div class="container">
            <div class="projectStatus__heading">
                <h2>Zainwestuj w <b>Rewir</b></h2>
                <p>Sprawdż w jakim etapie jest projekt i dołącz na najleszym momencie do inwestycji.</p>
            </div>
            <div class="projectStatus__tile projectStatus__tile--mobile" style="display: none;">
                <div class="projectStatusTile projectStatusTile--maxLeft projectStatusTile--toTop">
                    <div class="projectStatusTile__database">
                        <?php
                        $post_id = get_the_ID();
                        $total = 0;
                        $blogusers = get_users('blog_id=2');
                        foreach ($blogusers as $user) :
                            $user_id = 'user_' . esc_html($user->ID);
                        ?>
                            <?php if (have_rows('user_investment', $user_id)) : ?>
                                <?php while (have_rows('user_investment', $user_id)) : the_row();
                                    $investments = get_sub_field('user_investment_name');
                                    $investmentID = $investments['selected_posts'][0];
                                    $value = get_sub_field('user_investment_value');
                                    $requestAccept = get_sub_field('user_investment_accept');
                                ?>
                                    <?php if ($requestAccept == 'true'): ?>
                                        <?php if ($investmentID == $post_id) : ?>
                                            <span class="value" style="display: none;"><?php echo $value; ?></span>
                                            <span class="investor" style="display: none;">1</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="projectStatusTile__info">
                        <p><span class="targetPercent">0</span>% zrealizowanego celu</p>
                        <p class="status"><span class="total">0</span> / <span class="target"><?php the_field('tile_info_price'); ?></span> PLN</p>
                    </div>
                    <div class="projectStatusTile__investors">
                        <img src="/wp-content/themes/waterbridge-prod/images/icons/investments_ico.svg"/>
                        <p class="investors_count"><span class="investors">0</span> inwestorów</p>
                    </div>
                </div>
            </div>
            <?php if( have_rows('project_steps') ): ?>
            <div class="projectStatusSteps">
                <?php while( have_rows('project_steps') ): the_row(); 
                    $name = get_sub_field('project_steps_name');
                    $width = get_sub_field('project_steps_toend');
                    $date = get_sub_field('project_steps_date');
                    $count = count(get_field('project_steps'));
                ?>
                    <div class="projectStatusSteps__step" style="width: calc(100% / <?php echo $count; ?>)" end="<?php echo $width; ?>">
                        <div class="projectStatusSteps__content">
                            <h3>Etap <?php echo get_row_index(); ?>.</h3>
                            <p class="name"><?php echo $name; ?></p>
                        </div>
                        <div class="projectStatusSteps__status">
                            <p class="current">Status: <span>Planowany</span></p>
                            <p class="date">Data zakończenia: <span><?php echo $date; ?></span></p>
                        </div>
                    </div>
                <?php endwhile; ?>
                <div class="projectSimpleStatus projectSimpleStatus--mobile" style="display: none;">
                    <div class="projectSimpleStatus__bar">
                        <div class="projectSimpleStatus__status"></div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <section class="projectSimpleStatus projectSimpleStatus--two container">
        <div class="projectStatusTile projectStatusTile--maxLeft projectStatusTile--toTop">
            <div class="projectStatusTile__database">
                <?php
                $post_id = get_the_ID();
                $total = 0;
                $blogusers = get_users('blog_id=2');
                foreach ($blogusers as $user) :
                    $user_id = 'user_' . esc_html($user->ID);
                ?>
                    <?php if (have_rows('user_investment', $user_id)) : ?>
                        <?php while (have_rows('user_investment', $user_id)) : the_row();
                            $investments = get_sub_field('user_investment_name');
                            $investmentID = $investments['selected_posts'][0];
                            $value = get_sub_field('user_investment_value');
                        ?>
                            <?php if ($investmentID == $post_id) : ?>
                                <!-- <li><?php echo $investmentID; ?></li> -->
                                <span class="value" style="display: none;"><?php echo $value; ?></span>
                                <span class="investor" style="display: none;">1</span>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="projectStatusTile__info">
                <p><span class="targetPercent">0</span>% zrealizowanego celu</p>
                <p class="status"><span class="total">0</span> / <span class="target"><?php the_field('tile_info_price'); ?></span> PLN</p>
            </div>
            <div class="projectStatusTile__investors">
                <img src="/wp-content/themes/waterbridge-prod/images/icons/investments_ico.svg"/>
                <p class="investors_count"><span class="investors">0</span> inwestorów</p>
            </div>
        </div>
        <div class="projectStatusArrow projectStatusArrow--toTop projectStatusArrow--maxLeft"><img src="/wp-content/themes/waterbridge-prod/images/icons/statusBar_arrow.svg"/></div>
        <div class="projectSimpleStatus__bar">
            <div class="projectSimpleStatus__status"></div>
        </div>
    </section>
    <section class="projectExpert">
        <div class="projectExpert__wrap">
            <h2>Opinia eksperta</h2>
            <div class="projectExpert__person">
                <img src="/wp-content/themes/waterbridge-prod/images/icons/person_expert.svg"/>
                <p class="name">Radosław Parzybroda</p>
                <p class="position">WaterBridge Expert</p>
            </div>
            <div class="projectExpert__content">
                <p class="quote">“Ceny mieszkań cały czas idą w górę, a chętnych na ich zakup wcale nie brakuje. Wręcz przeciwnie. Inwestycje w nieruchomości stały się najpopularniejszym sposobem lokowania pieniędzy w Polsce”</p>
                <h3>Masz pytania do naszego eksperta?</h3>
                <?php switch_to_blog(1); ?>
                <a href="<?php echo home_url('/kontakt'); ?>" class="btn"><span>Skontaktuj się z nami</span></a>
                <?php switch_to_blog(2); ?>
            </div>
        </div>
    </section>
    <?php if( have_rows('project_docs_list') ): ?>
    <section class="projectDocs">
        <div class="projectDocs__wrap">
            <h2><?php the_field('project_docs_title'); ?></h2>
            <div class="projectDocs__list">
                <?php while( have_rows('project_docs_list') ): the_row(); 
                    $name = get_sub_field('project_docs_list_name');
                    $file = get_sub_field('project_docs_list_file');
                ?>
                <div class="projectDocs__element">
                    <p class="name"><?php echo $name; ?></p>
                    <a href="<?php echo $file; ?>" class="btn"><span>Pobierz</span></a>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Invest form -->
    <?php include get_template_directory() . '/template-parts/_investForm.php'; ?>
</main>

<?php
get_footer();
