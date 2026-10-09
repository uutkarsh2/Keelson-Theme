<?php
/**
 * How We Work Block
 */

$heading = get_field('how_we_work_heading');
$description = get_field('how_we_work_description');
$button_text = get_field('how_we_work_button_text');
$button_link = get_field('how_we_work_button_link');

$items = array();

for ($i = 1; $i <= 4; $i++) {
    $items[] = array(
        'heading' => get_field('how_we_work_' . $i . '_heading'),
        'description' => get_field('how_we_work_' . $i . '_description'),
    );
}
?>

<section class="sec tint how-we-work" id = "faq-section" >

    <div class="wrap">

        <div class="split">

            <!-- LEFT SIDE -->

            <div>

                <?php if ($heading) : ?>
                    <h2><?php echo esc_html($heading); ?></h2>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <p class="lede">
                        <?php echo esc_html($description); ?>
                    </p>
                <?php endif; ?>

                <?php if ($button_text && $button_link) : ?>
                    <p>
                        <a class="btn" href="<?php echo esc_url($button_link); ?>">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    </p>
                <?php endif; ?>

            </div>


            <!-- RIGHT SIDE: ACCORDION -->

            <div class="rows services-list">

                <?php foreach ($items as $item) : ?>

                    <?php
                    if (empty($item['heading']) && empty($item['description'])) {
                        continue;
                    }
                    ?>

                    <details class="service-item">

                        <summary>
                            <span>
                                <?php echo esc_html($item['heading']); ?>
                            </span>

                            <span aria-hidden="true"></span>
                        </summary>

                        <div class="service-content">

                            <?php if ($item['description']) : ?>
                                <p>
                                    <?php echo esc_html($item['description']); ?>
                                </p>
                            <?php endif; ?>

                        </div>

                    </details>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</section>