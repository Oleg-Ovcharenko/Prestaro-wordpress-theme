<?php
_deprecated_file( sprintf( __( 'Theme without %1$s' ), basename(__FILE__) ), '3.0', null, sprintf( __('Please include a %1$s template in your theme.'), basename(__FILE__) ) );

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.'); ?></p>
    <?php
    return;
}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

    <div class="commentlist">
        <?php wp_list_comments( array(
            'short_ping'  => true,
            'avatar_size' => 60,
            'reply_text'  => '<i class="fa fa-comments-o"></i> Ответить',
            'max_depth'   => 3,
            'style'       => 'li',
            'per_page'    => 0,
        ));?>
    </div>

<?php else : // this is displayed if there are no comments so far ?>

    <?php if ( comments_open() ) : ?>
        <!-- If comments are open, but there are no comments. -->

    <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <p class="nocomments"><?php _e('Comments are closed.'); ?></p>

    <?php endif; ?>
<?php endif; ?>

<?php if ( comments_open() ) : ?>

    <div id="respond">

        <h3><?php comment_form_title( __('Leave a Reply'), __('Leave a Reply to %s' ) ); ?></h3>

        <!--<div id="cancel-comment-reply">
            <small><?php /*cancel_comment_reply_link() */?></small>
        </div>-->

        <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
            <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() )); ?></p>
        <?php else : ?>

            <form action="<?php echo site_url(); ?>/wp-comments-post.php" method="post" id="commentform">

                <?php if ( is_user_logged_in() ) : ?>

                    <p class="esc"><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.'), get_edit_user_link(), $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php esc_attr_e('Log out of this account'); ?>"><?php _e('Log out &raquo;'); ?></a></p>

                <?php else : ?>

                    <p><input type="text" placeholder="Имя Фамилия" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /></p>

                    <p><input type="text" placeholder="Ваш email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /></p>

                    <p><input type="text" placeholder="Cсылка на вас" name="url" id="url" value="<?php echo  esc_attr($comment_author_url); ?>" size="22" tabindex="3" /></p>

                <?php endif; ?>

                <!--<p><small><?php printf(__('<strong>XHTML:</strong> You can use these tags: <code>%s</code>'), allowed_tags()); ?></small></p>-->

                <p><textarea name="comment" id="comment"></textarea></p>

                <p><input name="submit" type="submit" id="submit" tabindex="5" value="" />
                    <?php comment_id_fields(); ?>
                </p>
                <?php do_action('comment_form', $post->ID); ?>
                <div class="clear"></div>
            </form>
        <?php endif; // If registration required and not logged in ?>
    </div>
<?php endif; // if you delete this the sky will fall on your head ?>
