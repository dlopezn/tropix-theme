<?php
/**
 * The template part for displaying single posts
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="onepagepro-single-article onepagepro-blog-quote-format" >
	<?php 
		// post title
		$post_option = onepagepro_get_post_option(get_the_ID());
		if( empty($post_option['blog-title-style']) || $post_option['blog-title-style'] == 'default' ){
			$title_style = onepagepro_get_option('general', 'default-blog-title-style', 'small');
		}else{	
			$title_style = $post_option['blog-title-style'];
		}
		if( $title_style == 'none' ){
			get_template_part('content/content-single', 'title');
		}

		// post content
		global $pages;

		if( !preg_match('#^\[gdlr_core_quote[\s\S]+\[/gdlr_core_quote\]#', $pages[0], $match) ){ 
			preg_match('#^<blockquote[\s\S]+</blockquote>#', $pages[0], $match);
		}

		if( !empty($match[0]) ){
			$blockquote = $match[0];
			$author = substr($pages[0], strlen($match[0]));
		}else{
			$blockquote = '';
			$author = $pages[0];
		}

		echo '<div class="onepagepro-single-article-content" >';
		$thumbnail_id = get_post_thumbnail_id();
		if( !empty($thumbnail_id) ){
			$quote_background = wp_get_attachment_url(get_post_thumbnail_id());
			echo '<div class="onepagepro-blog-quote-background" ' . gdlr_core_esc_style(array(
				'background-image' => $quote_background
			)) . ' ></div>';
		}

		echo '<div class="onepagepro-blog-quote gdlr-core-quote-font" >&#8220;</div>';
		echo '<div class="onepagepro-blog-content-wrap" >';
		if( !empty($blockquote) ){
			echo '<div class="onepagepro-blog-quote-content gdlr-core-info-font">' . gdlr_core_content_filter($blockquote, true) . '</div>';
		}
		if( !empty($author) ){
			echo '<div class="onepagepro-blog-quote-author gdlr-core-info-font" >' . gdlr_core_escape_content(gdlr_core_text_filter($author)) . '</div>';
		}
		echo '</div>';
		echo '</div>';
	?>
	</div><!-- onepagepro-single-article -->
</article><!-- post-id -->