<?php get_header();?>
    <div class="container subscribe_slider" id="category">
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div id="subscribe">
                    <h1>Подписаться</h1>
                    <p>На обновления и новые <br> статьи</p>
                    <form action="#">
                        <input id="mail" type="text" placeholder="E-mail">
                        <input id="subscr_btn" type="submit">
                    </form>
                </div><!-- subscribe -->
                <?php if(!dynamic_sidebar('category_vidget')): ?>
                    <p>Виджет социальных сетей не задан. Обратитесь к файлу ReadMe при установке темы.</p>
                <?php endif; ?>
            </div><!-- subscribe -->
            <div class="col-md-9 col-sm-8 col-xs-12 posts_category">
                <div class="row" id="content">
                            <?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="col-md-12" id="post">
                        <div class="post">
                            <div class="miniature">
                                <?php wpfp_link() ?>
                                <div class="info_post">
                                    <a href="<?php the_permalink() ?>"><i class="fa fa-eye"></i><?php echo getPostViews(get_the_ID()); ?></a>
                                    <a href="<?php the_permalink() ?>#comments""><i class="fa fa-comment-o"></i><?php comments_number('0', '1', '%');?></a>
                                </div>
                                <?php echo the_post_thumbnail( 'category-size', 'class=transperent' ); ?>
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
                        <p class="error">Увас нет не одного поста. Перейти на <a href="<?php echo home_url(); ?>">главную</a></p>
                    </div><!-- container -->
                <?php endif; ?>
                <?php wp_reset_query();?>
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
            </div><!-- col-md-9 -->
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
    </div><!-- container -->
<?php get_footer();?>