<?php
/**
 * Template Name: About
 */

get_header();
?>

<main id="main" class="site-main about-page">

    <!-- ABOUT HERO -->

    <?php
    $about_heading     = get_field('about_heading');
    $about_description = get_field('about_description');
    ?>

    <section class="ph">

        <svg
            class="ct"
            data-seed="2"
            data-h="360"
            data-cell="14"
            aria-hidden="true">
        </svg>

        <div class="wrap">

            <?php if ($about_heading) : ?>
                <h1><?php echo esc_html($about_heading); ?></h1>
            <?php endif; ?>

            <?php if ($about_description) : ?>
                <p class="lede narrow">
                    <?php echo esc_html($about_description); ?>
                </p>
            <?php endif; ?>

        </div>

    </section>


    <!-- OUR STORY -->

    <?php
    $our_story_heading     = get_field('our_story_heading');
    $our_story_description = get_field('our_story_description');
    ?>

    <section class="sec about-story">

        <div class="wrap">

            <div class="split">

                <div>

                    <?php if ($our_story_heading) : ?>
                        <h2><?php echo esc_html($our_story_heading); ?></h2>
                    <?php endif; ?>

                </div>

                <div class="prose">

                    <?php if ($our_story_description) : ?>
                        <?php echo wpautop(wp_kses_post($our_story_description)); ?>
                    <?php endif; ?>

                </div>

            </div>

        </div>

    </section>


    <!-- HOW WE WORK - GUTENBERG ACF BLOCK -->

    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>


    <!-- TIMELINE -->

    <?php
    $timeline_heading = get_field('timeline_heading');

    $timeline_items = array(
        array(
            'year'        => get_field('timeline_1_heading'),
            'description' => get_field('timeline_1_description'),
        ),
        array(
            'year'        => get_field('timeline_2_heading'),
            'description' => get_field('timeline_2_description'),
        ),
        array(
            'year'        => get_field('timeline_3_heading'),
            'description' => get_field('timeline_3_description'),
        ),
        array(
            'year'        => get_field('timeline_4_heading'),
            'description' => get_field('timeline_4_description'),
        ),
        array(
            'year'        => get_field('timeline_5_heading'),
            'description' => get_field('timeline_5_description'),
        ),
    );
    ?>

    <section class="sec">

        <div class="wrap">

            <div class="split">

                <div>
                    <h2>
                        <?php echo esc_html($timeline_heading ?: 'Timeline'); ?>
                    </h2>
                </div>

                <ol class="rows" style="list-style:none;padding:0;margin:0;">

                    <?php foreach ($timeline_items as $item) : ?>

                        <?php
                        if (empty($item['year']) && empty($item['description'])) {
                            continue;
                        }
                        ?>

                        <li class="row">

                            <?php if ($item['year'] !== '' && $item['year'] !== null) : ?>
                                <h3><?php echo esc_html($item['year']); ?></h3>
                            <?php endif; ?>

                            <?php if ($item['description']) : ?>
                                <p><?php echo esc_html($item['description']); ?></p>
                            <?php endif; ?>

                        </li>

                    <?php endforeach; ?>

                </ol>

            </div>

        </div>

    </section>


    <!-- TEAM -->

    <?php
    $team_heading     = get_field('team_heading');
    $team_description = get_field('team_description');
    ?>

    <section class="sec tint" id="team-section">

        <div class="wrap">

            <div class="split" style="margin-bottom:40px;">

                <div>

                    <?php if ($team_heading) : ?>
                        <h2><?php echo esc_html($team_heading); ?></h2>
                    <?php endif; ?>

                </div>

                <div>

                    <?php if ($team_description) : ?>
                        <p class="narrow">
                            <?php echo esc_html($team_description); ?>
                        </p>
                    <?php endif; ?>

                </div>

            </div>


            <!-- TEAM MEMBERS -->

            <div class="people">

                <?php
                $team_members = array();

                for ($i = 1; $i <= 8; $i++) {

                    $member = get_field('team_member_' . $i);

                    if (is_array($member) && !empty($member['name'])) {
                        $team_members[] = $member;
                    }
                }

                foreach ($team_members as $member) :

                    $name        = $member['name'] ?? '';
                    $role        = $member['role'] ?? '';
                    $photo       = $member['photo'] ?? '';
                    $description = $member['description'] ?? '';

                    if (!$name) {
                        continue;
                    }
                ?>

                    <article class="person">

                        <?php if ($photo) : ?>

                            <div class="person-photo">

                                <?php
                                if (is_array($photo) && !empty($photo['ID'])) {

                                    echo wp_get_attachment_image(
                                        (int) $photo['ID'],
                                        'medium',
                                        false,
                                        array(
                                            'alt'     => !empty($photo['alt']) ? $photo['alt'] : $name,
                                            'loading' => 'lazy',
                                        )
                                    );

                                } elseif (is_numeric($photo)) {

                                    echo wp_get_attachment_image(
                                        (int) $photo,
                                        'medium',
                                        false,
                                        array(
                                            'alt'     => $name,
                                            'loading' => 'lazy',
                                        )
                                    );

                                } elseif (is_array($photo) && !empty($photo['url'])) {
                                ?>

                                    <img
                                        src="<?php echo esc_url($photo['url']); ?>"
                                        alt="<?php echo esc_attr($photo['alt'] ?? $name); ?>"
                                        loading="lazy">

                                <?php
                                } elseif (is_string($photo)) {
                                ?>

                                    <img
                                        src="<?php echo esc_url($photo); ?>"
                                        alt="<?php echo esc_attr($name); ?>"
                                        loading="lazy">

                                <?php } ?>

                            </div>

                        <?php endif; ?>


                        <h3><?php echo esc_html($name); ?></h3>

                        <?php if ($role) : ?>
                            <p class="role"><?php echo esc_html($role); ?></p>
                        <?php endif; ?>

                        <?php if ($description) : ?>
                            <p><?php echo esc_html($description); ?></p>
                        <?php endif; ?>

                    </article>

                <?php endforeach; ?>

            </div>


            <!-- CAREER -->

            <p style="margin-top:56px;">

                Want to join us?

                Send a CV and a note about the project
                you are proudest of to

                <a href="mailto:careers@keelson.example">
                    careers@keelson.example
                </a>.

            </p>

        </div>

    </section>


    <!-- CTA -->

    <?php get_template_part('template-parts/cta'); ?>

</main>

<?php get_footer(); ?>