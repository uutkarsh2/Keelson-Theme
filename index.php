<?php
/**
 * Main Template
 *
 * @package Keelson
 */

get_header();
?>

<main id="main" class="site-main index-page">

	<section class="sec">

		<div class="wrap">

			<?php if ( have_posts() ) : ?>

				<div class="posts">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						get_template_part(
							'template-parts/content/blog-card'
						);
						?>

					<?php endwhile; ?>

				</div>


				<!-- Pagination -->
				<nav
					class="pagination"
					aria-label="<?php esc_attr_e( 'Content pagination', 'keelson' ); ?>"
				>

					<?php
					the_posts_pagination(
						array(
							'mid_size'           => 2,
							'prev_text'          => esc_html__( '← Previous', 'keelson' ),
							'next_text'          => esc_html__( 'Next →', 'keelson' ),
							'screen_reader_text' => esc_html__( 'Content navigation', 'keelson' ),
						)
					);
					?>

				</nav>

			<?php else : ?>

				<div class="no-results">

					<h1>
						<?php esc_html_e( 'No content found.', 'keelson' ); ?>
					</h1>

					<p>
						<?php
						esc_html_e(
							'There is currently no content available.',
							'keelson'
						);
						?>
					</p>

					<a
						href="<?php echo esc_url( home_url( '/' ) ); ?>"
						class="btn"
					>
						<?php esc_html_e( 'Back to homepage', 'keelson' ); ?>
					</a>

				</div>

			<?php endif; ?>

		</div>

	</section>

</main>

<?php get_footer(); ?>