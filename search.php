<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package caelynx
 */

get_header();
?>
	<section class="search_hero flex vc hc">
    <div class="container container-xsm flex row hc vc">
        <?php echo '<h1 class="archive_title">SEARCH RESULTS FOR: '.get_search_query().'</h1>'; ?>
		</div><!-- /.container -->
	</section><!-- /.search_hero -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main flex row" role="main">
		<?php if ( have_posts() ) : ?>
			<section class="grid story-grid">
				<div class="container container-lg">
					<div class="outer-wrapper post-wrap">
						<div class="inner-wrapper flex row vc">
						<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
								get_template_part( 'template-parts/content', 'search' );
							endwhile;
							the_posts_navigation();
						else :
							get_template_part( 'template-parts/content', 'none' );
						endif;
						?>
						</div><!-- /.inner-wrapper-->
					</div><!-- /.outer-wrapper-->
				</div><!-- /.container-->
			</section><!-- /.story-grid -->

		</main><!-- #main -->
	</div><!-- #primary -->
	<script>
		jQuery(document).ready(function($){
			function equalHeight() {
				$('div.inner-wrapper').each(function(){  
					var highestBox = 0;
					$('.eqheight', this).each(function(){
						if($(this).height() > highestBox) {
						highestBox = $(this).height(); 
						}
					});  
					$('.eqheight',this).height(highestBox);
				}); 
			}
			equalHeight();
		});
	</script>

<?php
get_footer();
