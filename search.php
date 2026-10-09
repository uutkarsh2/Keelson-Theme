<?php
/**
 * Search Results
 *
 * @package Keelson
 */

get_header();
?>

<main id="main">

    <!-- =====================================================
         SEARCH HEADER
    ====================================================== -->

    <section class="ph">

        <svg
            class="ct"
            data-seed="3"
            data-h="360"
            data-cell="14"
            aria-hidden="true"
            focusable="false"
        ></svg>

        <div class="wrap">

            <h1>
                Search results
            </h1>

            <?php if ( get_search_query() ) : ?>

                <p class="lede narrow">
                    Results for
                    “<?php echo esc_html( get_search_query() ); ?>”
                </p>

            <?php else : ?>

                <p class="lede narrow">
                    Find services, articles, people and answers.
                </p>

            <?php endif; ?>

        </div>

    </section>


    <!-- =====================================================
         SEARCH RESULTS
    ====================================================== -->

    <section class="sec">

        <div class="wrap narrow">

            <?php if ( have_posts() ) : ?>

                <div class="search-results">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <article class="search-result">

                            <!-- Post type + date -->

                            <div class="meta">

                                <span>
                                    <?php
                                    echo esc_html(
                                        get_post_type()
                                    );
                                    ?>
                                </span>

                                <span>
                                    <?php
                                    echo esc_html(
                                        get_the_date()
                                    );
                                    ?>
                                </span>

                            </div>


                            <!-- Title -->

                            <h2>

                                <a
                                    href="<?php the_permalink(); ?>"
                                >
                                    <?php the_title(); ?>
                                </a>

                            </h2>


                            <!-- Excerpt -->

                            <?php if ( has_excerpt() ) : ?>

                                <p>
                                    <?php
                                    echo esc_html(
                                        get_the_excerpt()
                                    );
                                    ?>
                                </p>

                            <?php else : ?>

                                <p>
                                    <?php
                                    echo esc_html(
                                        wp_trim_words(
                                            get_the_content(),
                                            30
                                        )
                                    );
                                    ?>
                                </p>

                            <?php endif; ?>


                            <!-- Read more -->

                            <a
                                class="search-result-link"
                                href="<?php the_permalink(); ?>"
                            >
                                Read more →
                            </a>

                        </article>

                    <?php endwhile; ?>

                </div>


                <!-- =================================================
                     PAGINATION
                ================================================== -->

                <div class="search-pagination">

                    <?php

                    the_posts_pagination(
                        array(
                            'mid_size'  => 1,
                            'prev_text' => '← Previous',
                            'next_text' => 'Next →',
                        )
                    );

                    ?>

                </div>


            <?php else : ?>


                <!-- =================================================
                     NO RESULTS
                ================================================== -->

                <div class="search-no-results">

                    <h2>
                        No results found
                    </h2>

                    <p>
                        Sorry, we couldn't find anything matching
                        “<?php echo esc_html( get_search_query() ); ?>”.
                    </p>

                    <p>
                        Try another search term.
                    </p>

                    <p>

                        <a
                            class="btn"
                            href="<?php echo esc_url( home_url( '/search/' ) ); ?>"
                        >
                            Search again
                        </a>

                    </p>

                </div>


            <?php endif; ?>

        </div>

    </section>

</main>

<?php get_footer(); ?>