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
                                <a href="<?php the_permalink() ?>#comments""><i class="fa fa-comment-o"></i><?php comments_number('0', '1', '%');?></a>
                            </div><!-- info_post -->
                            <?php echo the_post_thumbnail( 'index-page-size', 'class=transperent' ); ?>
                        </div><!-- miniature -->
                        <a href="<?php the_permalink();?>" class="title_post"><?php the_title(); ?></a>
                        <?php the_excerpt()?>
                        <div class="categories post_links">
                            <?php the_category(' '); ?>
                        </div><!-- categories -->
                        <div class="tag_links post_links">
                            <?php the_tags(' ', ' ', ' ');?>
                        </div><!-- tag_links -->
                        <div class="clear"></div><!-- clear -->
                    </div><!-- post -->
                </div><!-- col-md-4 -->
            <?php endwhile; ?>
            <?php else: ?>
                <p>У вас нет ни одного поста.</p>
            <?php endif; ?>
        </div><!-- row -->
        <div class="pagination">
            <?php
            $big = 999999999; // need an unlikely integer

            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages
            ) );
            ?>
        </div><!-- pagination -->
    </div><!-- contant -->
<?php get_footer();?>