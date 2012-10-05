<?php
/**
 * Boilerplate functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, boilerplate_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'boilerplate_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/**
 * wpi_stylesheet_dir_uri
 * overwrite theme stylesheet directory uri
 * filter stylesheet_directory_uri
 * @see get_stylesheet_directory_uri()
 */
function wpi_stylesheet_dir_uri($stylesheet_dir_uri, $theme_name){

	$subdir = '/sass';
	return $stylesheet_dir_uri.$subdir;

}
add_filter('stylesheet_directory_uri','wpi_stylesheet_dir_uri',10,2);

/** Tell WordPress to run boilerplate_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'boilerplate_setup' );

if ( ! function_exists( 'boilerplate_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function boilerplate_setup() {
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'boilerplate' ),
	));
}
endif;

/**
 * Sets the post excerpt length to 40 characters.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function boilerplate_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'boilerplate_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function boilerplate_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'boilerplate' ) . '</a>';
}

/**
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function boilerplate_auto_excerpt_more( $more ) {
	return ' &hellip;' . boilerplate_continue_reading_link();
}
add_filter( 'excerpt_more', 'boilerplate_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function boilerplate_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= boilerplate_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'boilerplate_custom_excerpt_more' );

/*	Add Boilerplate Admin */
require_once(TEMPLATEPATH . '/boilerplate-admin/admin-menu.php');

// remove junk from head
// Thanks to Chris & Jeff – http://digwp.com/2010/03/wordpress-functions-php-template-custom-functions/
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);


// change Search Form input type from "text" to "search" and add placeholder text
	function boilerplate_search_form ( $form ) {
		$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
		<div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
		<input type="search" placeholder="Search for..." value="' . get_search_query() . '" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
		</div>
		</form>';
		return $form;
	}
	add_filter( 'get_search_form', 'boilerplate_search_form' );

// added per WP upload process request
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */

function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	
	<div class="row" <?php comment_class(); ?>>
	  <div class="span12" id="comment-<?php comment_ID(); ?>">
	    <div class="row">
	      <div class="span8">
	        <h4><strong>
	        	<?php
	        			/* translators: 1: comment author, 2: date and time */
	        			printf( __( '%1$s %2$s', 'twentyeleven' ),
	        				sprintf( '<span class="fn badge">%s</span>', get_comment_author_link() ),
	        				sprintf( '<a href="%1$s"><time class="badge" pubdate datetime="%2$s">%3$s</time></a>',
	        					esc_url( get_comment_link( $comment->comment_ID ) ),
	        					get_comment_time( 'c' ),
	        					/* translators: 1: date, 2: time */
	        					sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
	        				)
	        			);
	        		?>

	        </strong></h4>
	      </div>
	    </div>
	    <div class="row">
	      <div class="span2">
	        <a class="">
	            <?php
	            	$avatar_size = 68;
	            	if ( '0' != $comment->comment_parent )
	            		$avatar_size = 39;
	            
	            	echo get_avatar( $comment, $avatar_size );
	            ?>
	        </a>
	      </div>
	      <div class="span6">      
	        <?php if ( $comment->comment_approved == '0' ) : ?>
	        	<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
	        	<br />
	        <?php endif; ?>		

	        <div class="comment-content"><?php comment_text(); ?></div>	
	         
	        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	        <?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link label label-warning">', '</span>' ); ?>           
	      </div>
	    </div>

	  </div>
	</div>
	<div class="row">
		<div class="span10">
			<hr>
		</div>
	</div>
	
	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()


// Menu output mods (http://320press.com/wpbs/)
class description_walker extends Walker_Nav_Menu
{
  function start_el(&$output, $item, $depth, $args)
  {
	global $wp_query;
	$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	$class_names = $value = '';
	
	// If the item has children, add the dropdown class for bootstrap
	if ( $args->has_children ) {
		$class_names = "dropdown ";
	}
	
	$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	
	$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	$class_names = ' class="'. esc_attr( $class_names ) . '"';
       
       	$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

       	$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
       	$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
       	$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
       	$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
       	// if the item has children add these two attributes to the anchor tag
       	if ( $args->has_children ) {
		$attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
	}

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $args->link_after;
        // if the item has children add the caret just before closing the anchor tag
        if ( $args->has_children ) {
        	$item_output .= '<b class="caret"></b></a>';
        }
        else{
        	$item_output .= '</a>';
        }
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
        
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }
        
  	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
  	    {
  	        $id_field = $this->db_fields['id'];
  	        if ( is_object( $args[0] ) ) {
  	            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
  	        }
  	        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  	    }
           
}

// Add Twitter Bootstrap's standard 'active' class name to the active nav link item (http://320press.com/wpbs/)

add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );
function add_active_class($classes, $item) {
	if($item->menu_item_parent == 0 && in_array('current-menu-item', $classes)) {
        $classes[] = "active";
	}
    return $classes;
}

// Here ends the navbar stuff

include_once 'custom-post-types/cpts.php';

/* Custom Meta Boxes */

include_once 'metaboxes/setup.php';


?>
