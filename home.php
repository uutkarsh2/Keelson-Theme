<?php
/**
 * Blog Archive
 *
 * @package Keelson
 */

get_header();
?>

<main id="main" class="site-main blog-page">

	<!-- =========================================================
	     BLOG HERO
	========================================================= -->

	<section class="ph blog-hero">

		<!-- Dynamic SVG contour background -->
		<svg
			class="ct blog-contour"
			data-seed="7"
			data-h="360"
			data-cell="14"
			aria-hidden="true"
		></svg>

		<div class="wrap blog-hero-content">

			<h1>
				<?php esc_html_e( 'Blog', 'keelson' ); ?>
			</h1>

			<p class="lede narrow">
				<?php
				esc_html_e(
					'Articles from Keelson engineers on coastal design, survey and inspection.',
					'keelson'
				);
				?>
			</p>

		</div>

	</section>


	<!-- =========================================================
	     BLOG POSTS
	========================================================= -->

	<section class="sec blog-list-section">

		<div class="wrap">


			<!-- CATEGORY FILTER -->

			<nav
				class="categories blog-categories"
				aria-label="<?php esc_attr_e( 'Blog categories', 'keelson' ); ?>"
			>

				<?php
				$blog_url = get_permalink( get_option( 'page_for_posts' ) );

				if ( ! $blog_url ) {
					$blog_url = home_url( '/' );
				}

				$categories = get_categories(
					array(
						'taxonomy'   => 'category',
						'hide_empty' => true,
						'orderby'    => 'name',
						'order'      => 'ASC',
					)
				);
				?>

				<a
					href="<?php echo esc_url( $blog_url ); ?>"
					class="blog-category-link <?php echo is_home() ? 'active' : ''; ?>"
					<?php echo is_home() ? 'aria-current="page"' : ''; ?>
				>
					<?php esc_html_e( 'All', 'keelson' ); ?>
				</a>


				<?php if ( ! empty( $categories ) ) : ?>

					<?php foreach ( $categories as $category ) : ?>

						<a
							href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"
							class="blog-category-link"
						>
							<?php echo esc_html( $category->name ); ?>
						</a>

					<?php endforeach; ?>

				<?php endif; ?>

			</nav>


			<!-- POSTS -->

			<?php if ( have_posts() ) : ?>

				<div class="posts blog-posts">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						get_template_part(
							'template-parts/content/blog-card'
						);
						?>

					<?php endwhile; ?>

				</div>


				<!-- PAGINATION -->

				<nav
					class="pagination"
					aria-label="<?php esc_attr_e( 'Blog pagination', 'keelson' ); ?>"
				>

					<?php
					the_posts_pagination(
						array(
							'mid_size'           => 2,
							'prev_text'          => esc_html__( '← Previous', 'keelson' ),
							'next_text'          => esc_html__( 'Next →', 'keelson' ),
							'screen_reader_text' => esc_html__( 'Blog navigation', 'keelson' ),
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
							'There are currently no published articles.',
							'keelson'
						);
						?>
					</p>

				</div>

			<?php endif; ?>

		</div>

	</section>
   <?php get_template_part('template-parts/cta'); ?>
</main>

<?php get_footer(); ?>