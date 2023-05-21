<?php
/**
 * The template for displaying magazines
 *
 * Template Name: post-lister template
 *
 * @packageTsvCountryMusic
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="post-list-container">
			<?php
			// Optional links to add post form
			if ( current_user_can( 'administrator' ) ) {
				?>
				<div class="post-list-add-container">
					<?php the_content(); ?>
				</div>
				<?php
			}
			?>
			<ul>
				<?php
				$category = get_post_meta( get_the_ID(), 'chosen_category', true );
				if ( $category == '' ) {
					?>
					<div class="post-lister-list">
						Error: No category set in post-lister template category meta
					</div>
					<?php
				} else {
					$category_posts = new WP_Query( array(
						'post_type'      => 'post',
						'post_status'    => array( 'publish', 'future' ),
						'category_name'  => $category,
						'posts_per_page' => - 1
					) );

					while ( $category_posts->have_posts() ) :
						$category_posts->the_post();
						$thumbnail = get_the_post_thumbnail_url( get_the_ID() );
						?>
						<div class="post-lister-list">
							<!-- title -->
							<div class="post-lister-list-title">
								<h1>
									<a href="<?php echo get_permalink() ?>">
										<?php echo get_the_title( get_the_ID() ) ?>
									</a>
								</h1>
							</div>
							<!-- date -->
							<div class="post-date">
								<?php the_date() ?>
							</div>
							<?php if ( isset( $thumbnail ) ) : ?>
								<!-- featured image -->
								<div class="poster-list-featured-image">
									<img src="<?php echo $thumbnail ?>"/>
								</div>
							<?php endif; ?>
							<?php if ( has_excerpt() ) : ?>
								<!-- excerpt -->
								<div class="poster-list-excerpt">
									<p><?php the_excerpt() ?></p>
								</div>
							<?php endif; ?>
							<div class="poster-list-read-more">
								<a href="<?php echo get_permalink() ?>">
									--Read more--
								</a>
							</div>
						</div>
					<?php
					endwhile; // End of the loop.
				}
				?>
			</ul>
		</div>
	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
