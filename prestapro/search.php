<?php get_header();?>
    <div class="container subscribe_slider">
        <div class="row">
            <div class="col-md-9">
                <?php $slider = new WP_Query(array('post_type' => 'slider', 'posts_per_page' => -1, 'order' => 'ASC')); ?>
                <?php if( $slider->have_posts() ) :?>
                    <div class="flexslider">
                        <ul class="slides">
                            <?php while ( $slider->have_posts() ) : $slider->the_post(); ?>
                                <li>
                                    <div class="info_slide">
                                        <h2><?php the_title(); ?></h2>
                                        <a href="<?php the_permalink() ?>">читать</a>
                                    </div>
                                    <?php echo the_post_thumbnail( 'slider-size', 'class=transperent' ); ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div><!-- flexslider -->
                <?php else: ?>
                    <p>Нет не одного слайда.</p>
                <?php endif;?>
                <?php wp_reset_query();?>
            </div><!-- col-md-9 -->
            <div class="col-md-3">
                <div id="subscribe">
                    <h1>Подписаться</h1>
                    <p>На обновления и новые <br> статьи</p>
                    <form action="#">
                        <input id="mail" type="text" placeholder="E-mail">
                        <input id="subscr_btn" type="submit">
                    </form>
                </div><!-- subscribe -->
            </div><!-- subscribe -->
        </div><!-- row -->
    </div><!-- container -->
    <div class="container contant">
        <div class="row" id="content">
            <?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="col-md-4 col-sm-6" id="post">
                    <div class="post">
                        <div class="miniature">
                            <?php wpfp_link() ?>
                            <div class="info_post">
                                <a href="#"><i class="fa fa-eye"></i>170</a>
                                <a href="#"><i class="fa fa-comment-o"></i>770</a>
                            </div>
                            <?php echo the_post_thumbnail( 'index-page-size', 'class=transperent' ); ?>
                        </div>
                        <a href="<?php the_permalink();?>" class="title_post"><?php the_title(); ?></a>
                        <?php the_excerpt()?>
                        <div class="categories post_links">
                            <?php the_category(' '); ?>
                        </div><!-- categories -->
                        <div class="tag_links post_links">
                            <?php the_tags(' ', ' ', ' ');?>
                        </div><!-- tag_links -->
                        <div class="clear"></div>
                    </div><!-- post -->
                </div><!-- col-md-4 -->
            <?php endwhile; ?>
            <?php else: ?>
                <div class="container">
                    <p class="error">По вашему запросу ничего не найдено. Перейти на <a href="<?php echo home_url(); ?>">главную</a></p>
                </div><!-- container -->
            <?php endif; ?>
        </div><!-- row -->
    </div><!-- contant -->
<?php get_footer();?>