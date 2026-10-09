<?php
/**
 * Blog Card
 *
 * @package Keelson
 */
?>

<article class="post">


	<?php if ( has_post_thumbnail() ) : ?>

		<a href="<?php the_permalink(); ?>">

			<?php
			the_post_thumbnail(
				'keelson-blog-card',
				array(
					'loading' => 'lazy',
				)
			);
			?>

		</a>

	<?php endif; ?>


	<div class="meta">

		<?php
		$categories = get_the_category();

		if ( ! empty( $categories ) ) :
			?>

			<span>
				<?php echo esc_html( $categories[0]->name ); ?>
			</span>

		<?php endif; ?>


		<span>
			<?php echo esc_html( get_the_date() ); ?>
		</span>

	</div>


	<h2>

		<a href="<?php the_permalink(); ?>">
			<?php the_title(); ?>
		</a>

	</h2>


	<p>
		<?php echo esc_html( wp_trim_words( get_the_excerpt(), 25 ) ); ?>
	</p>


	<a href="<?php the_permalink(); ?>">
		Read article →
	</a>

</article>