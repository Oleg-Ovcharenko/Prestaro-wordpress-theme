<?php get_header();?>
    <div id="post" class="container mg_post">
        <?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div id="subjects">
            <a href="<?php echo home_url(); ?>">Главная</a>
            <span>&gt;</span>
            <a href="<?php get_permalink();?>"><?php the_title();?></a>
        </div><!-- subjects -->
        <div id="post_img">
            <div class="row">
                <div class="col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10" id="post_title">
                    <a id="post_date" href="#"><?php the_date();?></a>
                    <h1 id="post_title_img"><?php the_title();?></h1>
                    <p><?php echo (get_post_meta($post->ID, 'more_title', true)); ?></p>
                    <div class="info_post">
                        <?php setPostViews(get_the_ID()); ?>
                        <a href="<?php the_permalink() ?>"><i class="fa fa-eye"></i><?php echo getPostViews(get_the_ID()); ?></a>
                        <a href="<?php the_permalink() ?>#comments""><i class="fa fa-comment-o"></i><?php comments_number('0', '1', '%');?></a>
                    </div><!-- info_post -->
                    <?php wpfp_link() ?>
                </div><!-- post_title -->
            </div><!-- row -->
            <!--<img src="img/post_image.jpg" alt="post_img" class="post_img_transperent">-->
                <?php the_post_thumbnail( 'page-size', 'class=post_img_transperent' ); ?>
        </div><!-- post_img -->
        <div class="col-md-offset-2 col-md-8">
            <div class="row">
                <div class="post_social col-md-8 col-sm-12 col-xs-12 likes-block">
                    <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="big" data-yashareQuickServices="vkontakte,facebook,twitter" data-yashareTheme="counter"></div>
                </div><!-- post_social -->
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="assessment">
                        <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
                    </div><!-- assessment -->
                </div><!-- col-md-4 -->
            </div><!-- row -->
            <div id="post_all_information">
                <?php the_content();?>
            </div><!-- post_all_information -->
            <div class="row post_bottom_soc">
                <div class="post_social col-md-8 likes-block">
                    <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="big" data-yashareQuickServices="vkontakte,facebook,twitter" data-yashareTheme="counter"></div>
                </div><!-- post_social -->
                <div class="col-md-4">
                    <?php wpfp_link() ?>
                </div><!-- col-md-4 -->
            </div><!-- row -->
            <div id="related_articles">
                <h2>Похожие статьи</h2>
                <?php
                $categories = get_the_category($post->ID);
                if ($categories) {
                    $category_ids = array();
                    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                    $args=array(
                        'category__in' => $category_ids,
                        'post__not_in' => array($post->ID),
                        'showposts'=>2,
                        'orderby'=>rand,
                        'caller_get_posts'=>1);
                    $my_query = new wp_query($args);
                    if( $my_query->have_posts() ) {
                        echo '<div class="row">';
                        while ($my_query->have_posts()) {
                            $my_query->the_post();
                            ?>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'similar-size' ); ?></a>
                                <a href="<?php the_permalink() ?>"><?php the_title();?></a>
                            </div><!-- col-md-6 col-sm-6 col-xs-6 -->

                        <?php
                        }
                        echo '</div>';
                    }
                    wp_reset_query();
                    }
                    ?>
            </div><!-- related_articles -->
            <div id="comments">
                <h2>Коментарии<span><?php plural_form(get_comments_number(), array('новый','новых','новых'));?> </span></h2>
                <?php comments_template();?>
            </div><!-- comments -->
        </div><!-- col-md-offset-2 col-md-8 -->
        <?php endwhile; ?>
        <?php else: ?>
            <p>Что-то пошло не так.</p>
        <?php endif; ?>
        <?php wp_reset_query();?>
    </div><!-- post -->
<?php get_footer();?>