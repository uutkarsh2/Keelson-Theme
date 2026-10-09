
<?php
/**
 * Search Page
 *
 * @package Keelson
 */

get_header();

$search_query = trim( get_search_query() );
$is_search_submitted = isset( $_GET['s'] );
$has_search_query = ( $is_search_submitted && $search_query !== '' );
?>

<main id="main">

    <!-- SEARCH HEADER -->
    <section class="ph">

        <svg
            class="ct"
            data-seed="3"
            data-h="360"
            data-cell="14"
            aria-hidden="true"
        ></svg>

        <div class="wrap">

            <h1>Search</h1>

            <p class="lede narrow">
                Find services, articles, people and answers.
            </p>

        </div>

    </section>

    <!-- SEARCH FORM -->
    <section class="sec">

        <div class="wrap narrow">

            <form
                class="big-search"
                role="search"
                method="get"
                action="<?php echo esc_url( get_permalink( get_queried_object_id() ) ); ?>"
            >

                <label class="sr" for="q">
                    Search
                </label>

                <input
                    id="q"
                    name="s"
                    type="search"
                    placeholder="Try dredging"
                    value="<?php echo esc_attr( $search_query ); ?>"
                >

                <button class="btn" type="submit">
                    Search
                </button>

            </form>

            <?php if ( $is_search_submitted && $search_query === '' ) : ?>

                <p class="search-empty-message" role="status">
                    Please enter a search term to find articles and pages.
                </p>

            <?php endif; ?>

        </div>

    </section>

    <!-- SEARCH RESULTS -->
    <?php if ( $has_search_query ) : ?>

        <section class="sec search-results-section">

            <div class="wrap">

                <h2 class="search-results-heading">
                    Search results for:
                    "<?php echo esc_html( $search_query ); ?>"
                </h2>

                <?php
                $search_results = new WP_Query(
                    array(
                        's'              => $search_query,
                        'post_type'      => array( 'post', 'page' ),
                        'post_status'    => 'publish',
                        'posts_per_page' => 10,
                        'paged'          => max(
                            1,
                            absint( get_query_var( 'paged' ) )
                        ),
                    )
                );
                ?>

                <?php if ( $search_results->have_posts() ) : ?>

                    <div class="search-results-grid">

                        <?php while ( $search_results->have_posts() ) : ?>
                            <?php $search_results->the_post(); ?>

                            <article <?php post_class( 'search-result-card' ); ?>>

                                <?php if ( has_post_thumbnail() ) : ?>

                                    <a
                                        class="search-result-image"
                                        href="<?php the_permalink(); ?>"
                                        aria-label="<?php echo esc_attr( get_the_title() ); ?>"
                                    >
                                        <?php
                                        the_post_thumbnail(
                                            'medium_large',
                                            array(
                                                'loading' => 'lazy',
                                                'alt'     => esc_attr( get_the_title() ),
                                            )
                                        );
                                        ?>
                                    </a>

                                <?php endif; ?>

                                <div class="search-result-content">

                                    <p class="search-result-meta">
                                        <?php echo esc_html( get_the_date() ); ?>
                                        <span aria-hidden="true"> · </span>
                                        <?php echo esc_html( get_post_type() === 'page' ? 'Page' : 'Article' ); ?>
                                    </p>

                                    <h3>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <p>
                                        <?php
                                        echo esc_html(
                                            wp_trim_words(
                                                get_the_excerpt(),
                                                28
                                            )
                                        );
                                        ?>
                                    </p>

                                    <a
                                        class="search-result-link"
                                        href="<?php the_permalink(); ?>"
                                    >
                                        Read more →
                                    </a>

                                </div>

                            </article>

                        <?php endwhile; ?>

                    </div>

                    <!-- PAGINATION -->
                    <?php
                    $total_pages = $search_results->max_num_pages;

                    if ( $total_pages > 1 ) :
                    ?>
                        <nav class="search-pagination" aria-label="Search result pages">

                            <?php
                            echo wp_kses_post(
                                paginate_links(
                                    array(
                                        'total'     => $total_pages,
                                        'current'   => max(
                                            1,
                                            absint( get_query_var( 'paged' ) )
                                        ),
                                        'format'    => '?s=' . rawurlencode( $search_query ) . '&paged=%#%',
                                        'prev_text' => '← Previous',
                                        'next_text' => 'Next →',
                                    )
                                )
                            );
                            ?>

                        </nav>
                    <?php endif; ?>

                <?php else : ?>

                    <div class="search-no-results" role="status">

                        <h3>No results found</h3>

                        <p>
                            We couldn't find anything matching
                            "<?php echo esc_html( $search_query ); ?>".
                            Try another keyword.
                        </p>

                    </div>

                <?php endif; ?>

                <?php wp_reset_postdata(); ?>

            </div>

        </section>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
