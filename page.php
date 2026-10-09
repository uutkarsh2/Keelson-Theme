<?php
/**
 * Keelson - Default Page Template
 *
 * @package Keelson
 */

get_header();
?>

<main id="main" class="site-main default-page">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<!-- Page Header -->
			<section class="ph page-hero">

				<div class="wrap">

					<div class="kicker">
						<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
					</div>

					<h1>
						<?php the_title(); ?>
					</h1>

				</div>

			</section>


			<!-- Page Content -->
			<section class="sec page-content-section">

				<div class="wrap">

					<div class="article-layout">

						<article class="prose">

							<?php
							the_content();
							?>

							<?php
							wp_link_pages(
								array(
									'before' => '<nav class="page-links" aria-label="' .
										esc_attr__( 'Page navigation', 'keelson' ) .
										'">',
									'after'  => '</nav>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
								)
							);
							?>

						</article>

					</div>

				</div>

			</section>

		<?php endwhile; ?>

	<?php else : ?>

		<!-- No Content -->
		<section class="sec">

			<div class="wrap">

				<h1>
					<?php esc_html_e( 'Page not found', 'keelson' ); ?>
				</h1>

				<p>
					<?php
					esc_html_e(
						'Sorry, the requested page could not be found.',
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

		</section>

	<?php endif; ?>

</main>

<?php get_footer(); ?>