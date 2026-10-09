<?php
/**
 * Reusable Global CTA
 * CTA content is taken from the Home / Front Page.
 */

// Get the Home / Front Page ID
$home_id = get_option('page_on_front');

// Get CTA fields from the Home page
$cta_heading = get_field('cta_heading', $home_id);
$cta_description = get_field('cta_description', $home_id);

$cta_button_1_text = get_field('cta_button_1_text', $home_id);
$cta_button_1_link = get_field('cta_button_1_link', $home_id);

$cta_button_2_text = get_field('cta_button_2_text', $home_id);
$cta_button_2_link = get_field('cta_button_2_link', $home_id);
?>

<section class="sec home-cta">

    <!-- Contour background -->
    <svg
        class="ct"
        data-seed="11"
        data-h="500"
        data-cell="18"
        aria-hidden="true">
    </svg>

    <div class="wrap">
        <div class="cta-inner">

            <?php if ($cta_heading) : ?>
                <h2>
                    <?php echo esc_html($cta_heading); ?>
                </h2>
            <?php endif; ?>

            <?php if ($cta_description) : ?>
                <p class="lede">
                    <?php echo esc_html($cta_description); ?>
                </p>
            <?php endif; ?>

            <?php if (
                ($cta_button_1_text && $cta_button_1_link) ||
                ($cta_button_2_text && $cta_button_2_link)
            ) : ?>

                <div class="btns">

                    <?php if ($cta_button_1_text && $cta_button_1_link) : ?>
                        <a
                            class="btn"
                            href="<?php echo esc_url($cta_button_1_link); ?>"
                        >
                            <?php echo esc_html($cta_button_1_text); ?>
                        </a>
                    <?php endif; ?>

                    <?php if ($cta_button_2_text && $cta_button_2_link) : ?>
                        <a
                            class="btn"
                            href="<?php echo esc_url($cta_button_2_link); ?>"
                        >
                            <?php echo esc_html($cta_button_2_text); ?>
                        </a>
                    <?php endif; ?>

                </div>

            <?php endif; ?>

        </div>
    </div>

</section>