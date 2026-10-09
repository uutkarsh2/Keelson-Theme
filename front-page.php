<?php
/**
 * Template Name: Home
 *
 * @package Keelson
 */

get_header();

/**
 * Safely convert an ACF value to text.
 */
function keelson_text($value) {

    if (is_array($value)) {

        if (isset($value['title'])) {
            return (string) $value['title'];
        }

        if (isset($value['label'])) {
            return (string) $value['label'];
        }

        if (isset($value['value'])) {
            return (string) $value['value'];
        }

        return '';
    }

    if ($value === null) {
        return '';
    }

    return (string) $value;
}


/**
 * Safely get URL from an ACF URL/Link field.
 */
function keelson_url($value) {

    if (is_array($value)) {

        if (isset($value['url'])) {
            return (string) $value['url'];
        }

        return '';
    }

    if ($value === null) {
        return '';
    }

    return (string) $value;
}
?>

<main id="main">

    <!-- =========================================================
         HERO
    ========================================================== -->

    <section class="hero">

        <svg
            class="ct"
            data-seed="4"
            data-h="760"
            data-cell="16"
            aria-hidden="true"
        ></svg>

        <div class="wrap hero-content">

            <h1>
                <?php
                echo 
                     get_field('hero_title');
                    
                ?>
            </h1>

            <p class="lede">
                <?php
                echo get_field('hero_description');
                ?>
            </p>

            <div class="btns">

                <?php
                $button_1_text = get_field('button_1_text_');
                $button_1_link = get_field('button_1_link');

                if ($button_1_text && $button_1_link) :
                ?>

                    <a
                        href="<?php echo esc_url(
                            keelson_url($button_1_link)
                        ); ?>"
                        class="btn"
                    >
                        <?php
                        echo $button_1_text;
                        ?>
                    </a>

                <?php endif; ?>


                <?php
                $button_2_text = get_field('button_2_text');
                $button_2_link = get_field('button_2_link');

                if ($button_2_text && $button_2_link) :
                ?>

                    <a
                        href="<?php echo 
                            $button_2_link;
                        ?>"
                        class="btn ghost"
                    >
                        <?php
                        echo 
                           $button_2_text;
                        
                        ?>
                    </a>
                    <div class="chart-hint">
    Move across the chart to raise the seabed.
</div>

                <?php endif; ?>

            </div>

        </div>

    </section>


    <!-- =========================================================
         RECENT WORK
    ========================================================== -->

    <?php

    $recent_heading = get_field('recent_heading');
    $recent_description = get_field('recent_description');

    ?>

    <section class="sec">

        <div class="wrap">

            <div class="split">

                <!-- LEFT -->

                <div>

                    <?php if ($recent_heading) : ?>

                        <h2>
                            <?php
                            echo $recent_heading;
                            
                            ?>
                        </h2>

                    <?php endif; ?>


                    <?php if ($recent_description) : ?>

                        <p class="lede">
                            <?php
                            echo $recent_description;
                            
                            ?>
                        </p>

                    <?php endif; ?>

                </div>


                <!-- RIGHT -->

                <div class="rows work">

                    <?php

                    for ($i = 1; $i <= 5; $i++) :

                        $project_title = get_field(
                            'project_' . $i . '_title'
                        );

                        $project_location = get_field(
                            'project_' . $i . '_location'
                        );

                        $project_description = get_field(
                            'project_' . $i . '_description'
                        );

                        $project_year = get_field(
                            'project_' . $i . '_year'
                        );


                        if (
                            !$project_title &&
                            !$project_location &&
                            !$project_description &&
                            !$project_year
                        ) {
                            continue;
                        }

                    ?>

                        <article class="row">

                            <h3>

                                <?php if ($project_title) : ?>

                                    <?php
                                    echo $project_title ;
                                    
                                    ?>

                                <?php endif; ?>

                            </h3>


                            <?php if ($project_location) : ?>

                                <span class="project-location">

                                    <?php
                                    echo $project_location
                                    
                                    ?>

                                </span>

                            <?php endif; ?>


                            <?php if ($project_description) : ?>

                                <p>

                                    <?php
                                    echo 
                                            $project_description;
                                        
                                    ?>

                                </p>

                            <?php endif; ?>


                            <?php if ($project_year) : ?>

                                <span class="project-year">

                                    <?php
                                    echo $project_year ;
                                    
                                    ?>

                                </span>

                            <?php endif; ?>

                        </article>

                    <?php endfor; ?>

                </div>

            </div>

        </div>

    </section>

<!-- =========================================================
     SERVICES
     Dynamic ACF Group Fields
========================================================== -->

<?php
// Main Services section fields
$services_heading = get_field('what_we_do_heading');
$services_description = get_field('what_we_do_description');

$project_button_text = get_field('ask_project_button');
$project_button_url = get_field('ask_project_button_');

// Get all 6 service groups
$service_groups = array();

for ($i = 1; $i <= 6; $i++) {
    $group = get_field('service_' . $i);

    if (is_array($group) && !empty($group)) {
        $service_groups[$i] = $group;
    }
}
?>

<section class="sec tint" id="service-section">
    <div class="wrap">

        <div class="split">

            <!-- Left Side: Services Introduction -->
            <div>
                <h2>
                    <?php
                    echo esc_html(
                        $services_heading ?: 'What we do'
                    );
                    ?>
                </h2>

                <?php if ($services_description) : ?>
                    <p class="lede">
                        <?php echo esc_html($services_description); ?>
                    </p>
                <?php endif; ?>

                <?php if ($project_button_text) : ?>
                    <p>
                        <a href="<?php
                            echo esc_url(
                                $project_button_url ?: home_url('/contact/')
                            );
                        ?>">
                            <?php echo esc_html($project_button_text); ?>
                        </a>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Right Side: All Services -->
            <div class="rows services-list">

                <?php foreach ($service_groups as $service_number => $service) :

                    // Each group's heading and description are numbered
                    $heading = $service['service_' . $service_number . '_heading'] ?? '';
                    $description = $service['service_' . $service_number . '_description'] ?? '';

                    // Common subfield names inside each Group
                    $receive_heading = $service['what_you_receive_heading'] ?? '';
                    $receive_content = $service['what_you_receive'] ?? '';

                    $duration_heading = $service['how_long_heading'] ?? '';
                    $duration_description = $service['how_long_description'] ?? '';

                    $button_text = $service['ask_about_service_button'] ?? '';
                    $button_url = $service['ask_about_service_button_url'] ?? '';

                    // Skip empty services
                    if (!$heading && !$description) {
                        continue;
                    }
                ?>

                    <details class="service-item">

                        <summary>
                            <span>
                                <?php echo esc_html($heading); ?>
                            </span>
                            <span aria-hidden="true"></span>
                        </summary>

                        <div class="service-content">

                            <?php if ($description) : ?>
                                <p>
                                    <?php echo esc_html($description); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($receive_heading || $receive_content) : ?>
                                <div class="service-receive">

                                    <?php if ($receive_heading) : ?>
                                        <h4>
                                            <?php echo esc_html($receive_heading); ?>
                                        </h4>
                                    <?php endif; ?>

                                    <?php if ($receive_content) : ?>
                                        <div>
                                            <?php echo wp_kses_post($receive_content); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>

                            <?php if ($duration_heading || $duration_description) : ?>
                                <div class="service-duration">

                                    <?php if ($duration_heading) : ?>
                                        <h4>
                                            <?php echo esc_html($duration_heading); ?>
                                        </h4>
                                    <?php endif; ?>

                                    <?php if ($duration_description) : ?>
                                        <p>
                                            <?php echo esc_html($duration_description); ?>
                                        </p>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>

                            <?php if ($button_text) : ?>
                                <p class="service-cta">
                                    <a
                                        class="btn"
                                        href="<?php
                                            echo esc_url(
                                                $button_url ?: home_url('/contact/')
                                            );
                                        ?>"
                                    >
                                        <?php echo esc_html($button_text); ?>
                                    </a>
                                </p>
                            <?php endif; ?>

                        </div>

                    </details>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>

    <!-- =========================================================
         LATEST ARTICLES
    ========================================================== -->

    <section class="sec blog-home">

        <div class="wrap">

            <div class="blog-intro">

                <h2>
                    From the blog
                </h2>

                <p>
                    What we have learned on recent projects, written by
                    the engineers who did the work.
                </p>

            </div>


            <div class="blog-grid">

                <?php

                $latest_posts = new WP_Query(
                    array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                        'post_status'    => 'publish',
                    )
                );


                if ($latest_posts->have_posts()) :

                    while ($latest_posts->have_posts()) :

                        $latest_posts->the_post();

                ?>

                        <article class="blog-card">


                            <?php if (has_post_thumbnail()) : ?>

                                <a
                                    href="<?php the_permalink(); ?>"
                                    class="blog-card-image"
                                >

                                    <?php

                                    the_post_thumbnail(
                                        'keelson-card',
                                        array(
                                            'loading' => 'lazy',
                                        )
                                    );

                                    ?>

                                </a>

                            <?php endif; ?>


                            <div class="blog-card-meta">

                                <?php

                                $categories = get_the_category();

                                if (!empty($categories)) :

                                ?>

                                    <span>

                                        <?php
                                        echo 
                                            $categories[0]->name ;
                                        
                                        ?>

                                    </span>

                                <?php endif; ?>


                                <span>

                                    <?php
                                    echo 
                                        get_the_date('j M Y') ;
                                    
                                    ?>

                                </span>


                                <span>

                                    <?php

                                    $word_count = str_word_count(
                                        wp_strip_all_tags(
                                            get_the_content()
                                        )
                                    );

                                    $reading_time = max(
                                        1,
                                        ceil($word_count / 200)
                                    );

                                    ?>

                                    <?php
                                    echo 
                                        $reading_time ;
                                    
                                    ?>

                                    min read

                                </span>

                            </div>


                            <h3>

                                <a href="<?php the_permalink(); ?>">

                                    <?php the_title(); ?>

                                </a>

                            </h3>


                            <div class="blog-card-excerpt">

                                <?php if (has_excerpt()) : ?>

                                    <?php
                                    echo 
                                        get_the_excerpt() ;
                                    
                                    ?>

                                <?php else : ?>

                                    <?php
                                    echo 
                                        wp_trim_words(
                                            get_the_content(),
                                            25
                                        );
                                    
                                    ?>

                                <?php endif; ?>

                            </div>


                        </article>


                <?php

                    endwhile;

                    wp_reset_postdata();

                endif;

                ?>

            </div>


            <div class="blog-all">

                <a
                    class="btn ghost"
                    href="<?php echo esc_url(
                        home_url('/blog/')
                    ); ?>"
                >
                    All articles
                </a>

            </div>

        </div>

    </section>


    <!-- =========================================================
         CTA
    ========================================================== -->

    <?php get_template_part('template-parts/cta'); ?>

</main>


<?php get_footer(); ?>