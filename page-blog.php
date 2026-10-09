
<?php
/**
 * Template Name: Blog
 *
 * @package Keelson
 */

get_header();

$blog_page_url = get_permalink( get_queried_object_id() );

$selected_category = '';

if ( isset( $_GET['category'] ) && is_string( $_GET['category'] ) ) {
    $selected_category = sanitize_title(
        wp_unslash( $_GET['category'] )
    );
}

$categories = get_categories(
    array(
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'ASC',
    )
);

$paged = max(
    1,
    absint( get_query_var( 'paged' ) ),
    absint( get_query_var( 'page' ) )
);

$blog_args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 9,
    'paged'               => $paged,
    'orderby'             => 'date',
    'order'               => 'DESC',
    'ignore_sticky_posts' => true,
);

if ( $selected_category !== '' ) {
    $category_object = get_category_by_slug( $selected_category );

    if ( $category_object && ! is_wp_error( $category_object ) ) {
        $blog_args['cat'] = (int) $category_object->term_id;
    } else {
        // Invalid category slug: return no posts.
        $blog_args['post__in'] = array( 0 );
    }
}

$blog_query = new WP_Query( $blog_args );
?>

<main id="main" class="site-main blog-page">

    <!-- BLOG HERO -->
    <section class="ph">

        <svg
            class="ct"
            data-seed="7"
            data-h="360"
            data-cell="14"
            aria-hidden="true"
        ></svg>

        <div class="wrap">

            <h1>Blog</h1>

            <p class="lede narrow">
                Notes from the engineers on what worked,
                what did not and what we would do again.
            </p>

        </div>

    </section>

    <!-- BLOG POSTS -->
    <section class="sec blog-list-section">

        <div class="wrap">

            <!-- CATEGORY FILTER -->
            <nav
                class="chips blog-category-filters"
                aria-label="Filter blog posts by category"
            >

                <a
                    href="<?php echo esc_url( $blog_page_url ); ?>"
                    class="blog-filter <?php echo $selected_category === '' ? 'active' : ''; ?>"
                    <?php echo $selected_category === '' ? 'aria-current="page"' : ''; ?>
                >
                    All
                </a>

                <?php foreach ( $categories as $category ) : ?>

                    <a
                        href="<?php echo esc_url(
                            add_query_arg(
                                'category',
                                $category->slug,
                                $blog_page_url
                            )
                        ); ?>"
                        class="blog-filter <?php echo $selected_category === $category->slug ? 'active' : ''; ?>"
                        <?php echo $selected_category === $category->slug ? 'aria-current="page"' : ''; ?>
                    >
                        <?php echo esc_html( $category->name ); ?>
                    </a>

                <?php endforeach; ?>

            </nav>

            <!-- POSTS GRID -->
            <?php if ( $blog_query->have_posts() ) : ?>

                <div class="posts blog-posts">

                    <?php while ( $blog_query->have_posts() ) : ?>
                        <?php
                        $blog_query->the_post();

                        $post_categories = get_the_category();

                        $category_name = ! empty( $post_categories )
                            ? $post_categories[0]->name
                            : 'Article';

                        $word_count = str_word_count(
                            wp_strip_all_tags( get_the_content() )
                        );

                        $reading_minutes = max(
                            1,
                            (int) ceil( $word_count / 200 )
                        );
                        ?>

                        <article <?php post_class( 'post blog-post-card' ); ?>>

                            <!-- FEATURED IMAGE -->
                            <?php if ( has_post_thumbnail() ) : ?>

                                <a
                                    class="post-image"
                                    href="<?php the_permalink(); ?>"
                                    aria-label="<?php echo esc_attr( get_the_title() ); ?>"
                                >
                                    <?php
                                    the_post_thumbnail(
                                        'large',
                                        array(
                                            'class'   => 'pic',
                                            'loading' => 'lazy',
                                            'decoding' => 'async',
                                        )
                                    );
                                    ?>
                                </a>

                            <?php endif; ?>

                            <!-- POST META -->
                            <div class="meta">

                                <?php if ( ! empty( $post_categories ) ) : ?>
                                    <a
                                        href="<?php echo esc_url( get_category_link( $post_categories[0]->term_id ) ); ?>"
                                    >
                                        <?php echo esc_html( $category_name ); ?>
                                    </a>
                                <?php else : ?>
                                    <span><?php echo esc_html( $category_name ); ?></span>
                                <?php endif; ?>

                                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                    <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
                                </time>

                                <span>
                                    <?php echo esc_html( $reading_minutes . ' min read' ); ?>
                                </span>

                            </div>

                            <!-- TITLE -->
                            <h2>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <!-- EXCERPT -->
                            <p>
                                <?php
                                $excerpt = get_the_excerpt();

                                if ( ! $excerpt ) {
                                    $excerpt = get_the_content();
                                }

                                echo esc_html(
                                    wp_trim_words(
                                        wp_strip_all_tags( $excerpt ),
                                        24,
                                        '…'
                                    )
                                );
                                ?>
                            </p>

                            <!-- READ MORE -->
                            <a
                                class="post-read"
                                href="<?php the_permalink(); ?>"
                            >
                                Read article →
                            </a>

                        </article>

                    <?php endwhile; ?>

                </div>

                <!-- PAGINATION -->
                <?php if ( $blog_query->max_num_pages > 1 ) : ?>

                    <nav
                        class="blog-pagination"
                        aria-label="Blog pagination"
                    >
                        <?php
                        echo wp_kses_post(
                            paginate_links(
                                array(
                                    'total'     => $blog_query->max_num_pages,
                                    'current'   => $paged,
                                    'mid_size'  => 2,
                                    'prev_text' => '← Previous',
                                    'next_text' => 'Next →',
                                    'add_args'  => $selected_category !== ''
                                        ? array( 'category' => $selected_category )
                                        : false,
                                )
                            )
                        );
                        ?>
                    </nav>

                <?php endif; ?>

            <?php else : ?>

                <!-- EMPTY STATE -->
                <div class="no-posts">

                    <h2>No articles found</h2>

                    <p>
                        <?php if ( $selected_category !== '' ) : ?>
                            There are no published articles in this category.
                        <?php else : ?>
                            There are no published blog posts yet.
                        <?php endif; ?>
                    </p>

                    <?php if ( $selected_category !== '' ) : ?>
                        <a class="btn" href="<?php echo esc_url( $blog_page_url ); ?>">
                            View all articles →
                        </a>
                    <?php endif; ?>

                </div>

            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

        </div>

    </section>

    <?php get_template_part( 'template-parts/cta' ); ?>

</main>

<?php get_footer(); ?>
