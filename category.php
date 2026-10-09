
<?php
/**
 * Category Archive Template
 *
 * @package Keelson
 */

get_header();

$current_category = get_queried_object();
?>

<main id="main" class="site-main category-archive-page">

    <!-- CATEGORY HEADER -->
    <section class="ph category-hero">

        <svg
            class="ct"
            data-seed="3"
            data-h="360"
            data-cell="14"
            aria-hidden="true"
        ></svg>

        <div class="wrap">

            <p class="category-eyebrow">FROM THE JOURNAL</p>

            <h1>
                <?php echo esc_html( single_cat_title( '', false ) ); ?>
            </h1>

            <?php if ( category_description() ) : ?>
                <div class="lede narrow category-description">
                    <?php echo wp_kses_post( category_description() ); ?>
                </div>
            <?php else : ?>
                <p class="lede narrow">
                    Explore articles, insights and updates from Keelson.
                </p>
            <?php endif; ?>

        </div>

    </section>

    <!-- CATEGORY NAVIGATION -->
    <section class="category-navigation-section">
        <div class="wrap">

            <nav class="category-navigation" aria-label="Blog categories">

                <a
                    href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"
                    class="category-nav-link"
                >
                    All
                </a>

                <?php
                $categories = get_categories(
                    array(
                        'hide_empty' => true,
                        'orderby'    => 'name',
                        'order'      => 'ASC',
                    )
                );

                foreach ( $categories as $category ) :
                    $is_current = (
                        isset( $current_category->term_id ) &&
                        (int) $current_category->term_id === (int) $category->term_id
                    );
                ?>

                    <a
                        href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"
                        class="category-nav-link <?php echo $is_current ? 'is-active' : ''; ?>"
                        <?php echo $is_current ? 'aria-current="page"' : ''; ?>
                    >
                        <?php echo esc_html( $category->name ); ?>
                    </a>

                <?php endforeach; ?>

            </nav>

        </div>
    </section>

    <!-- CATEGORY POSTS -->
    <section class="sec category-posts-section">

        <div class="wrap">

            <?php if ( have_posts() ) : ?>

                <div class="posts category-posts">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php
                        $post_categories = get_the_category();
                        $reading_minutes = max(
                            1,
                            (int) ceil(
                                str_word_count(
                                    wp_strip_all_tags( get_the_content() )
                                ) / 200
                            )
                        );
                        ?>

                        <article <?php post_class( 'category-post-card' ); ?>>

                            <!-- FEATURED IMAGE -->
                            <?php if ( has_post_thumbnail() ) : ?>

                                <a
                                    class="category-post-image"
                                    href="<?php the_permalink(); ?>"
                                    aria-label="<?php echo esc_attr( get_the_title() ); ?>"
                                >
                                    <?php
                                    the_post_thumbnail(
                                        'medium_large',
                                        array(
                                            'loading'  => 'lazy',
                                            'decoding' => 'async',
                                        )
                                    );
                                    ?>
                                </a>

                            <?php endif; ?>

                            <!-- POST DETAILS -->
                            <div class="category-post-content">

                                <div class="category-post-meta">

                                    <?php if ( ! empty( $post_categories ) ) : ?>
                                        <a
                                            href="<?php echo esc_url( get_category_link( $post_categories[0]->term_id ) ); ?>"
                                            class="category-post-category"
                                        >
                                            <?php echo esc_html( $post_categories[0]->name ); ?>
                                        </a>
                                    <?php endif; ?>

                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                        <?php echo esc_html( get_the_date( 'j M Y' ) ); ?>
                                    </time>

                                    <span>
                                        <?php echo esc_html( $reading_minutes . ' min read' ); ?>
                                    </span>

                                </div>

                                <h2 class="category-post-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <p class="category-post-excerpt">
                                    <?php
                                    $excerpt = get_the_excerpt();

                                    if ( ! $excerpt ) {
                                        $excerpt = get_the_content();
                                    }

                                    echo esc_html(
                                        wp_trim_words( $excerpt, 35, '…' )
                                    );
                                    ?>
                                </p>

                                <a
                                    class="category-read-more"
                                    href="<?php the_permalink(); ?>"
                                >
                                    Read article →
                                </a>

                            </div>

                        </article>

                    <?php endwhile; ?>

                </div>

                <!-- PAGINATION -->
                <?php
                $pagination = paginate_links(
                    array(
                        'type'      => 'list',
                        'prev_text' => '← Previous',
                        'next_text' => 'Next →',
                    )
                );

                if ( $pagination ) :
                ?>
                    <nav class="category-pagination" aria-label="Category pages">
                        <?php echo wp_kses_post( $pagination ); ?>
                    </nav>
                <?php endif; ?>

            <?php else : ?>

                <!-- EMPTY STATE -->
                <div class="category-empty-state">

                    <h2>No articles found</h2>

                    <p>
                        There are no published articles in this category yet.
                        Explore the journal to find other articles.
                    </p>

                    <a
                        class="btn"
                        href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"
                    >
                        Browse all articles →
                    </a>

                </div>

            <?php endif; ?>

        </div>

    </section>

</main>

<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer(); ?>
