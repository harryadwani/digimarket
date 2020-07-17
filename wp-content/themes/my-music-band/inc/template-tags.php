<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package My Music Band
 */

if ( ! function_exists( 'my_music_band_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function my_music_band_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		$post_id = get_queried_object_id();
		$post_author_id = get_post_field( 'post_author', $post_id );

		$byline = '<span class="author vcard"><span class="screen-reader-text">Byline</span><a class="url fn n" href="' . esc_url( get_author_posts_url( $post_author_id ) ) . '">' . esc_html( get_the_author_meta( 'nickname', $post_author_id ) ) . '</a></span>';

		echo '<span class="posted-on">' . '<span class="screen-reader-text">' . esc_html__( 'Posted-on', 'my-music-band' ) . '</span>' . $posted_on . '</span>';

		echo '<span class="byline">' . '<span class="screen-reader-text">' . esc_html__( 'By line', 'my-music-band' ) . '</span>' . $byline . '</span>';
	}
endif;

if ( ! function_exists( 'my_music_band_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function my_music_band_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ' ', 'my-music-band' ) );

			if ( $categories_list  ) {
				echo '<span class="cat-links">' . '<span class="screen-reader-text">' . __( 'Categories', 'my-music-band' ) . '</span>' . $categories_list . '</span>';
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'my-music-band' ) );

			if ( $tags_list  ) {
				echo '<span class="tags-links">' . '<span class="screen-reader-text">' . __( 'Tags', 'my-music-band' ) . ',' . '</span>' . $tags_list . '</span>';
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'my-music-band' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'my-music-band' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'my_music_band_author_bio' ) ) :
	/**
	 * Prints HTML with meta information for the author bio.
	 */
	function my_music_band_author_bio() {
		if ( '' !== get_the_author_meta( 'description' ) ) {
			get_template_part( 'template-parts/biography' );
		}
	}
endif;

if ( ! function_exists( 'my_music_band_cat_list' ) ) :
	/**
	 * Prints HTML with meta information for the categories
	 */
	function my_music_band_cat_list() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the / */
			$categories_list = get_the_category_list( esc_html__( ' / ', 'my-music-band' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', esc_html__(  'Cat Links', 'my-music-band' ), $categories_list ); // WPCS: XSS OK.
			}
		} elseif( 'jetpack-portfolio' == get_post_type() ) {
			/* translators: used between list items, there is a space after the / */
			$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', esc_html__( ' / ', 'my-music-band' ) );

			if ( ! is_wp_error( $categories_list ) ) {
				printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', esc_html__(  'Cat Links', 'my-music-band' ), $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'my_music_band_entry_category_date' ) ) :
/**
 * Prints HTML with category and tags for current post.
 *
 * Create your own my_music_band_entry_category_date() function to override in a child theme.
 *
 * @since My Music Band 0.1

 */
function my_music_band_entry_category_date() {
	$meta = '<div class="entry-meta">';

	$portfolio_categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '<span class="portfolio-entry-meta entry-meta">', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'my-music-band' ), '</span>' );

	if ( 'jetpack-portfolio' === get_post_type() ) {
		$meta .= sprintf( '<span class="cat-links">%1$s%2$s</span>',
			sprintf( _x( '<span class="screen-reader-text">Categories: </span>', 'Used before category names.', 'my-music-band' ) ),
			$portfolio_categories_list
		);

		$meta .= '<span class="sep">' . _x( ' &ndash; ', 'Post meta separator', 'my-music-band' ) . '</span>';
	}

	$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'my-music-band' ) );
	if ( $categories_list && my_music_band_categorized_blog() ) {
		$meta .= sprintf( '<span class="cat-links">%1$s%2$s</span>',
			sprintf( _x( '<span class="screen-reader-text">Categories: </span>', 'Used before category names.', 'my-music-band' ) ),
			$categories_list
		);

		$meta .= '<span class="sep">' . _x( ' &ndash; ', 'Post meta separator', 'my-music-band' ) . '</span>';
	}

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$meta .= sprintf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
		sprintf( __( '<span class="date-label">Posted on </span>', 'my-music-band' ) ),
		esc_url( get_permalink() ),
		$time_string
	);

	$meta .= '</div><!-- .entry-meta -->';

	return $meta;

}
endif;

if ( ! function_exists( 'my_music_band_categorized_blog' ) ) :
	/**
	 * Determines whether blog/site has more than one category.
	 *
	 * Create your own my_music_band_categorized_blog() function to override in a child theme.
	 *
	 * @since My Music Band 0.1

	 *
	 * @return bool True if there is more than one category, false otherwise.
	 */
	function my_music_band_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'my_music_band_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'my_music_band_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so my_music_band_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so my_music_band_categorized_blog should return false.
			return false;
		}
	}
endif;

/**
 * Footer Text
 *
 * @get footer text from theme options and display them accordingly
 * @display footer_text
 * @action my_music_band_footer
 *
 * @since My Music Band 0.1
 */
if ( ! function_exists( 'my_music_band_footer_content' ) ):
function my_music_band_footer_content() {
	$theme_data = wp_get_theme();

	$footer_content = sprintf( _x( 'Copyright &copy; %1$s %2$s %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'my-music-band' ), esc_attr( date_i18n( __( 'Y', 'my-music-band' ) ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>', function_exists( 'get_the_privacy_policy_link' ) ? get_the_privacy_policy_link( '| ') : '' ) . '<span class="sep"> | </span>' . $theme_data->get( 'Name' ) . '&nbsp;' . esc_html__( 'by', 'my-music-band' ) . '&nbsp;<a target="_blank" href="' . $theme_data->get( 'AuthorURI' ) . '">' . esc_html( $theme_data->get( 'Author' ) ) . '</a>';

	echo '<div class="site-info">' . $footer_content . '</div><!-- .site-info -->';
}
endif;
add_action( 'my_music_band_credits', 'my_music_band_footer_content', 10 );

if ( ! function_exists( 'my_music_band_single_image' ) ) :
	/**
	 * Display Single Page/Post Image
	 */
	function my_music_band_single_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if ( $post) {
	 		if ( is_attachment() ) {
				$parent = $post->post_parent;
				$metabox_feat_img = get_post_meta( $parent,'my-music-band-featured-image', true );
			} else {
				$metabox_feat_img = get_post_meta( $page_id,'my-music-band-featured-image', true );
			}
		}

		if ( empty( $metabox_feat_img ) || ( !is_page() && !is_single() ) ) {
			$metabox_feat_img = 'default';
		}

		$featured_image = 'disabled';

		if ( ( 'disabled' == $metabox_feat_img  || ! has_post_thumbnail() || ( 'default' == $metabox_feat_img && 'disabled' == $featured_image ) ) ) {
			echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
			return false;
		}
		else {
			$class = '';

			if ( 'default' == $metabox_feat_img ) {
				$class = $featured_image;
			}
			else {
				$class = 'from-metabox ' . $metabox_feat_img;
				$featured_image = $metabox_feat_img;
			}

			?>
			<figure class="entry-image <?php echo esc_attr( $class ); ?>">
                <?php the_post_thumbnail( $featured_image ); ?>
	        </figure>
	   	<?php
		}
	}
endif; // my_music_band_single_image.

if ( ! function_exists( 'my_music_band_archive_image' ) ) :
	/**
	 * Display Post Archive Image
	 */
	function my_music_band_archive_image() {
		if ( ! has_post_thumbnail() ) {
			// Bail if there is no featured image.
			return;
		}

		$thumbnail = 'post-thumbnail';
		$archive_layout = 'excerpt-image-top';

		if ( 'full-content' === $archive_layout ) {
			// Bail if full content is selected.
			return;
		}

		if ( 'excerpt-image-top' === $archive_layout || 'full-content-image-top' === $archive_layout ) {
			$thumbnail = 'my-music-band-archive-top';
		}
		?>
			<div class="post-thumbnail archive-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $thumbnail ); ?>
				</a>
			</div><!-- .post-thumbnail -->
		<?php
	}
endif; // my_music_band_archive_image.

if ( ! function_exists( 'my_music_band_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	function my_music_band_comment( $comment, $args, $depth ) {
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php esc_html_e( 'Pingback:', 'my-music-band' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'my-music-band' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div><!-- .comment-author -->

				<div class="comment-container">
					<header class="comment-meta">
						<?php printf( __( '%s <span class="says screen-reader-text">says:</span>', 'my-music-band' ), sprintf( '<cite class="fn author-name">%s</cite>', get_comment_author_link() ) ); ?>

						<a class="comment-permalink entry-meta" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>"><?php printf( esc_html__( '%s ago', 'my-music-band' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time></a>
					<?php edit_comment_link( esc_html__( 'Edit', 'my-music-band' ), '<span class="edit-link">', '</span>' ); ?>
					</header><!-- .comment-meta -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'my-music-band' ); ?></p>
					<?php endif; ?>

					<div class="comment-content">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

					<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="reply">',
							'after'     => '</span>',
						) ) );
					?>
				</div><!-- .comment-content -->

			</article><!-- .comment-body -->
		<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>

		<?php
		endif;
	}
endif; // ends check for my_music_band_comment()
