<?php
/**
 * Template Name: Left Sidebar Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AWD_Digital
 */

get_header(); 
?>

   <main id="primary" class="site-main">
	   <div class="container">
			<div class="row">
				<div class="col-md-3 order-sm-1">
					<?php get_sidebar(); ?><button class="btn btn-primary">Hello</button>
				</div>
				<div class="col-md-9">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div>
			</div>
	   </div>

   </main><!-- #main -->

<?php
get_footer();
