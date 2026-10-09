
<?php
/**
 * 404 - Page Not Found
 *
 * @package Keelson
 */

get_header();
?>

<main id="main" class="error-404-page">

    <section class="error-404-section">
        <div class="error-404-container">

            <p class="error-404-label">PAGE NOT FOUND</p>

            <h1>404</h1>

            <h2>Looks like you've drifted off course.</h2>

            <p class="error-404-description">
                The page you're looking for may have moved, been removed,
                or never existed. Let's get you back on the right course.
            </p>

            <div class="error-404-actions">
                <a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>">
                    Back to homepage
                </a>

                <a class="btn btn-secondary" href="<?php echo esc_url(home_url('/contact/')); ?>">
                    Contact us
                </a>
            </div>

            <div class="error-404-search">
                <p>Looking for something specific?</p>

                <?php get_search_form(); ?>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
