<?php
/**
 * Archive Template
 *
 * @package Keelson
 */

get_header();
?>

<main id="main" class="site-main archive-page">

	<!-- Archive Hero -->
	<section class="ph archive-hero">
		<div class="wrap">

			<h1>
				<?php
				the_archive_title();
				?>
			</h1>

			<?php
			the_archive_description(
				'<div class="lede narrow">',
				'</div>'
			);
			?>

		</div>
	</section>


	<!-- Archive Posts -->
	<section class="sec archive-list-section">
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
					aria-label="<?php esc_attr_e( 'Archive pagination', 'keelson' ); ?>"
				>

					<?php
					the_posts_pagination(
						array(
							'mid_size'           => 2,
							'prev_text'          => esc_html__( '← Previous', 'keelson' ),
							'next_text'          => esc_html__( 'Next →', 'keelson' ),
							'screen_reader_text' => esc_html__( 'Archive navigation', 'keelson' ),
						)
					);
					?>

				</nav>

			<?php else : ?>

				<div class="no-posts">

					<h2>
						<?php esc_html_e( 'No articles found.', 'keelson' ); ?>
					</h2>

					<p>
						<?php
						esc_html_e(
							'There are currently no articles in this archive.',
							'keelson'
						);
						?>
					</p>

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php esc_html_e( 'Back to Blog →', 'keelson' ); ?>
					</a>

				</div>

			<?php endif; ?>

		</div>
	</section>

</main>

<?php get_footer(); ?>