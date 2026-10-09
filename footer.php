<?php
/**
 * Keelson Footer
 */

// Get contact details from ACF Options
$email = function_exists('get_field')
    ? get_field('email', 'option')
    : '';

$phone = function_exists('get_field')
    ? get_field('phone', 'option')
    : '';

// Homepage URL
$home_url = home_url('/');
?>

<footer class="foot">

    <div class="wrap">

        <div class="cols">

            <!-- Company -->
            <div class="footer-company">

                <h4>
                    <?php bloginfo('name'); ?>
                </h4>

                <p>
                    Coastal, port and marine engineering since 1994.
                </p>

            </div>


            <!-- Company Navigation -->
            <div class="footer-navigation">

                <h4>
                    <?php esc_html_e('Company', 'keelson'); ?>
                </h4>

                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container'      => 'nav',
                    'container_aria_label' => __('Footer navigation', 'keelson'),
                    'menu_class'     => '',
                    'fallback_cb'    => false,
                ));
                ?>

            </div>


            <!-- Services -->
            <div class="footer-services">

                <h4>
                    <?php esc_html_e('Services', 'keelson'); ?>
                </h4>

                <ul>
                    <li>
                        <a href="<?php echo esc_url($home_url . '#service-1'); ?>">
                            Coastal and port design
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url($home_url . '#service-2'); ?>">
                            Survey and dredging
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url($home_url . '#service-3'); ?>">
                            Structure inspection
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url($home_url . '#service-4'); ?>">
                            Flood and sea-level risk
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url($home_url . '#service-5'); ?>">
                            Environmental permitting
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url($home_url . '#service-6'); ?>">
                            Project delivery
                        </a>
                    </li>
                </ul>

            </div>


            <!-- Contact -->
            <div class="footer-contact">

                <h4>
                    <?php esc_html_e('Contact', 'keelson'); ?>
                </h4>

                <ul>

                    <li>
                        Harbourside House
                    </li>

                    <li>
                        12 Quay Street, Bristol BS1 4RT
                    </li>

                    <?php if ($phone) : ?>
                        <li>
                            <a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9+]/', '', $phone)); ?>">
                                <?php echo esc_html($phone); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($email) : ?>
                        <li>
                            <a href="<?php echo esc_url('mailto:' . sanitize_email($email)); ?>">
                                <?php echo esc_html($email); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>

            </div>

        </div>


        <!-- Copyright -->
        <div class="legal">

            <p>
                &copy; <?php echo esc_html(wp_date('Y')); ?>
                <?php bloginfo('name'); ?>.
                Registered in England and Wales.
            </p>

        </div>

    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>