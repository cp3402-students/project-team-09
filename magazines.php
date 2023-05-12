<?php
/**
 * The template for displaying magazines
 *
 * Template Name: magazines template
 *
 * @packageTsvCountryMusic
 */

get_header();
?>

	<main id="primary" class="site-main">
		<ul>
			<?php
			echo "<div id='test'>teset";
			echo get_post_meta( get_the_ID(), 'chosen_category', true );
			echo "</div>";
			$magazine_posts = new WP_Query( array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'category_name'  => 'magazine',
				'posts_per_page' => - 1
			) );

			while ( $magazine_posts->have_posts() ) :
				$magazine_posts->the_post();
				$thumbnail = get_the_post_thumbnail_url( get_the_ID() );
				?>
				<div class="magazine-post-list">
					<!-- title -->
					<div class="magazine-post-list-title">
						<h1>
							<a href="<?php echo get_permalink() ?>">
								<?php echo get_the_title( get_the_ID() ) ?>
							</a>
						</h1>
					</div>
					<?php if ( isset( $thumbnail ) ) : ?>
						<!-- featured image -->
						<div class="magazine-post-list-featured-image">
							<img src="<?php echo $thumbnail ?>"/>
						</div>
					<?php endif; ?>
					<?php if ( has_excerpt() ) : ?>
						<!-- excerpt -->
						<div class="magazine-post-list-excerpt">
							<p><?php the_excerpt() ?></p>
						</div>
					<?php endif; ?>

				</div>
			<?php
			endwhile; // End of the loop.
			?>
		</ul>
	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
