<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentyeleven_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?>
	<div id="comments" class="row">
	<div class="span12">
		<?php if ( post_password_required() ) : ?>
			<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyeleven' ); ?></p>
	</div>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<div class="row">
			<div class="span12">
				<h5 id="comments-title">
					<?php
						printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'twentyeleven' ),
							number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
					?>
				</h5>
			</div>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<div class="row">
			<div class="span12">
				<nav id="comment-nav-above">
					<h1 class="assistive-text"><?php _e( 'Comment navigation', 'twentyeleven' ); ?></h1>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentyeleven' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyeleven' ) ); ?></div>
				</nav>
			</div>
		</div>
		<?php endif; // check for comment navigation ?>

		<div class="row">
			<div class="span12">
				<ol class="commentlist">
					<?php
						/* Loop through and list the comments. Tell wp_list_comments()
						 * to use twentyeleven_comment() to format the comments.
						 * If you want to overload this in a child theme then you can
						 * define twentyeleven_comment() and that will be used instead.
						 * See twentyeleven_comment() in twentyeleven/functions.php for more.
						 */
						wp_list_comments( array( 'callback' => 'twentyeleven_comment' ) );
					?>
				</ol>
			</div>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<div class="row">
			<div class="span12">
				<nav id="comment-nav-below">
					<h1 class="assistive-text"><?php _e( 'Comment navigation', 'twentyeleven' ); ?></h1>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentyeleven' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyeleven' ) ); ?></div>
				</nav>
			</div>
		</div>
		<?php endif; // check for comment navigation ?>

	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'twentyeleven' ); ?></p>
	<?php endif; ?>
	

	<div class="row">
		<div class="span12">
			<section id="respond" class="respond-form">
			
				<h3 id="comment-form-title"><?php comment_form_title( __("Leave a Reply","bonestheme"), __("Leave a Reply to","bonestheme") . ' %s' ); ?></h3>
			
				<ul>
					<?php cancel_comment_reply_link( __("Cancel","bonestheme") ); ?>
				</ul>
			
				<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			  	<div class="help">
			  		<p><?php _e("You must be","bonestheme"); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e("logged in","bonestheme"); ?></a> <?php _e("to post a comment","bonestheme"); ?>.</p>
			  	</div>
				<?php else : ?>
			
				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="form-vertical" id="commentform">
			
				<?php if ( is_user_logged_in() ) : ?>
			
				<ul>
					<p class="comments-logged-in-as"><?php _e("Logged in as","bonestheme"); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e("Log out of this account","bonestheme"); ?>"><?php _e("Log out","bonestheme"); ?> &raquo;</a></p>
				</ul>
			
				<?php else : ?>
				
				<ul id="comment-form-elements">
					
					<p>
						<div class="control-group">
						  <label for="author"><?php _e("Name","bonestheme"); ?> <?php if ($req) echo "(required)"; ?></label>
						  <div class="input-prepend">
						  	<span class="add-on"><i class="icon-user"></i></span><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="<?php _e("Your Name","bonestheme"); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
						  </div>
					  	</div>
					</p>
					
					<p>
						<div class="control-group">
						  <label for="email"><?php _e("Mail","bonestheme"); ?> <?php if ($req) echo "(required)"; ?></label>
						  <div class="input-prepend">
						  	<span class="add-on"><i class="icon-envelope"></i></span><input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="<?php _e("Your Email","bonestheme"); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
						  	<span class="help-inline">(<?php _e("will not be published","bonestheme"); ?>)</span>
						  </div>
					  	</div>
					</p>
					
					<p>
						<div class="control-group">
						  <label for="url"><?php _e("Website","bonestheme"); ?></label>
						  <div class="input-prepend">
						  <span class="add-on"><i class="icon-home"></i></span><input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="<?php _e("Your Website","bonestheme"); ?>" tabindex="3" />
						  </div>
					  	</div>
					</p>
					
				</ul>
			
				<?php endif; ?>
				
				<ul>
					<div>
						<div class="input">
							<textarea name="comment" id="comment" rows="5" class="span10" placeholder="<?php _e("Your Comment Here…","bonestheme"); ?>" tabindex="4"></textarea>
						</div>
					</div>
				</ul>
				
				<div class="form-actions">
				  <input class="btn btn-mustard" name="submit" type="submit" id="submit" tabindex="5" value="<?php _e("Submit Comment","bonestheme"); ?>" />
				  <?php comment_id_fields(); ?>
				</div>
				
				<?php 
					//comment_form();
					do_action('comment_form()', $post->ID); 
			
				?>
				
				</form>
				
				<?php endif; // If registration required and not logged in ?>
			</section>
		</div>
	</div>


</div><!-- #comments -->
