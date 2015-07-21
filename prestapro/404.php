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
        <p class="error">По вашему запросу ничего не найдено. Перейти на <a href="<?php echo home_url(); ?>">главную</a></p>
    </div><!-- contant -->
<?php get_footer();?>