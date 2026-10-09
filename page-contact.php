<?php
/**
 * Contact Page
 *
 * @package Keelson
 */

get_header();

$office_address = get_field('office_address');
?>

<main id="main">

    <!-- PAGE HEADER -->

    <section class="ph">

        <svg
            class="ct"
            data-seed="10"
            data-h="360"
            data-cell="14"
            aria-hidden="true">
        </svg>

        <div class="wrap">

            <h1>Contact us</h1>

            <p class="lede narrow">
                Tell us what you are dealing with.
                An engineer reads every message and replies
                within two working days.
            </p>

        </div>

    </section>


    <!-- OFFICES + CONTACT FORM -->

    <section class="sec">

        <div class="wrap split">

            <!-- OFFICES -->

            <div class="office-info">

                <h2>Offices</h2>

                <?php if ($office_address) : ?>

                    <div class="office-address prose">
                        <?php echo wp_kses_post($office_address); ?>
                    </div>

                <?php endif; ?>

            </div>


            <!-- CONTACT FORM 7 -->

            <div class="contact-form">

                <?php
                echo do_shortcode(
                    '[contact-form-7 id="5ef7444" title="Contact form 1"]'
                );
                ?>

            </div>

        </div>

    </section>


    <!-- FAQ / GUTENBERG BLOCK -->

    <section class="contact-faq">

        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>

    </section>

</main>

<?php get_footer(); ?>