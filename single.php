
<?php
/**
 * Single Blog Post
 *
 * @package Keelson
 */

get_header();
?>

<main id="main" class="site-main single-post-page">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <?php
            $current_post_id = get_the_ID();
            $categories      = get_the_category( $current_post_id );
            $category_ids    = wp_get_post_categories( $current_post_id );
            ?>

            <!-- ARTICLE -->
            <section class="sec single-article-section">
                <div class="wrap">

                    <article <?php post_class( 'article' ); ?>>

                        <!-- META -->
                        <div class="meta">

                            <?php if ( ! empty( $categories ) ) : ?>
                                <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
                                    <?php echo esc_html( $categories[0]->name ); ?>
                                </a>
                            <?php endif; ?>

                            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                <?php echo esc_html( get_the_date() ); ?>
                            </time>

                            <span>
                                <?php echo esc_html( get_the_author() ); ?>
                            </span>

                        </div>

                        <!-- TITLE -->
                        <h1 class="article-title">
                            <?php the_title(); ?>
                        </h1>

                        <!-- EXCERPT -->
                        <?php if ( has_excerpt() ) : ?>
                            <p class="lede narrow article-excerpt">
                                <?php echo esc_html( get_the_excerpt() ); ?>
                            </p>
                        <?php endif; ?>

                        <!-- FEATURED IMAGE -->
                        <?php if ( has_post_thumbnail() ) : ?>
                            <figure class="featured-image">
                                <?php
                                the_post_thumbnail(
                                    'keelson-blog-featured',
                                    array(
                                        'loading'  => 'eager',
                                        'decoding' => 'async',
                                    )
                                );
                                ?>
                            </figure>
                        <?php endif; ?>

                        <!-- AUTHOR -->
                        <div class="by">

                            <div class="mono">
                                <?php
                                echo get_avatar(
                                    get_the_author_meta( 'ID' ),
                                    64,
                                    '',
                                    get_the_author(),
                                    array(
                                        'class' => 'author-avatar',
                                    )
                                );
                                ?>
                            </div>

                            <div>
                                <b><?php echo esc_html( get_the_author() ); ?></b>
                                <br>

                                <span class="muted small">
                                    <?php
                                    $author_description = get_the_author_meta( 'description' );

                                    if ( $author_description ) {
                                        echo esc_html( $author_description );
                                    } else {
                                        esc_html_e(
                                            'Keelson Marine Engineering',
                                            'keelson'
                                        );
                                    }
                                    ?>
                                </span>
                            </div>

                        </div>

                        <!-- POST CONTENT -->
                        <div class="prose">
                            <?php the_content(); ?>

                            <?php
                            wp_link_pages(
                                array(
                                    'before'      => '<nav class="page-links" aria-label="' .
                                        esc_attr__( 'Post pages', 'keelson' ) . '">',
                                    'after'       => '</nav>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                )
                            );
                            ?>
                        </div>

                        <!-- PREVIOUS / NEXT POSTS -->
                        <nav class="pn" aria-label="<?php esc_attr_e( 'More articles', 'keelson' ); ?>">

                            <div class="previous-post">
                                <?php
                                previous_post_link(
                                    '%link',
                                    '&larr; Older: %title'
                                );
                                ?>
                            </div>

                            <div class="next-post">
                                <?php
                                next_post_link(
                                    '%link',
                                    'Newer: %title &rarr;'
                                );
                                ?>
                            </div>

                        </nav>

                    </article>

                </div>
            </section>

            <!-- RELATED POSTS -->
            <?php
            $related_args = array(
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'posts_per_page'      => 3,
                'post__not_in'        => array( $current_post_id ),
                'orderby'             => 'date',
                'order'               => 'DESC',
                'ignore_sticky_posts' => true,
                'no_found_rows'       => true,
            );

            if ( ! empty( $category_ids ) ) {
                $related_args['category__in'] = $category_ids;
            }

            $related_query = new WP_Query( $related_args );

            // Fall back to recent posts if no related posts exist.
            if ( ! $related_query->have_posts() && ! empty( $category_ids ) ) {
                wp_reset_postdata();

                unset( $related_args['category__in'] );

                $related_query = new WP_Query( $related_args );
            }
            ?>

            <?php if ( $related_query->have_posts() ) : ?>

                <section class="sec tint related">
                    <div class="wrap">

                        <h2>Keep reading</h2>

                        <div class="posts related-posts">

                            <?php while ( $related_query->have_posts() ) : ?>
                                <?php
                                $related_query->the_post();

                                get_template_part(
                                    'template-parts/content/blog-card'
                                );
                                ?>
                            <?php endwhile; ?>

                        </div>

                    </div>
                </section>

            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

        <?php endwhile; ?>

    <?php else : ?>

        <!-- ARTICLE NOT FOUND -->
        <section class="sec">
            <div class="wrap">

                <h1><?php esc_html_e( 'Article not found', 'keelson' ); ?></h1>

                <p>
                    <?php
                    esc_html_e(
                        'Sorry, the article you are looking for could not be found.',
                        'keelson'
                    );
                    ?>
                </p>

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn">
                    <?php esc_html_e( 'Back to Home →', 'keelson' ); ?>
                </a>

            </div>
        </section>

    <?php endif; ?>

</main>

<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer(); ?>
