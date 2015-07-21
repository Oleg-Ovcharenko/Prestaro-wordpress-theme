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
                <div id="comments">
                    <h2>Коментарии<span><?php plural_form(get_comments_number(), array('новый','новых','новых'));?> </span></h2>
                    <?php comments_template();?>
                </div><!-- comments -->
            </div><!-- col-md-offset-2 col-md-8 -->
        <?php endwhile; ?>
        <?php else: ?>
            <p>Ошибка.</p>
        <?php endif; ?>
    </div><!-- post -->
<?php get_footer();?>