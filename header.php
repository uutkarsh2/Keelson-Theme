<?php
/**
 * Keelson - Header
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>


<a
    class="screen-reader-text"
    href="#main"
>
    Skip to content
</a>


<header class="site-header">

    <div class="wrap nav">

        <!-- Logo -->
        <div class="brand">

            <a href="<?php echo esc_url(home_url('/')); ?>">

                <?php if (has_custom_logo()) : ?>

                    <?php
                    the_custom_logo();
                    ?>

                <?php else : ?>

                    <span class="brand-name">
                        <?php bloginfo('name'); ?>
                    </span>

                    <span class="brand-tagline">
                        Marine engineering
                    </span>

                <?php endif; ?>

            </a>

        </div>


        <!-- Mobile Menu Button -->
        <button
            class="menu-toggle"
            type="button"
            aria-controls="primary-menu"
            aria-expanded="false"
        >

            <span></span>
            <span></span>
            <span></span>

            <span class="screen-reader-text">
                Menu
            </span>

        </button>


        <!-- Navigation -->
        <nav
            class="main-navigation"
            aria-label="<?php esc_attr_e('Primary Navigation', 'keelson'); ?>"
        >

            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-links',
                    'container'      => false,
                    'fallback_cb'    => false,
                )
            );
            ?>

        </nav>


        <!-- Search -->
        <div class="header-search">

            <form
                role="search"
                method="get"
                class="search-form"
                action="<?php echo esc_url(home_url('/')); ?>"
            >

                <label>

                    <span class="screen-reader-text">
                        Search for:
                    </span>

                    <input
                        type="search"
                        name="s"
                        placeholder="Search the site"
                        value="<?php echo esc_attr(get_search_query()); ?>"
                    >

                </label>

            </form>

        </div>

    </div>

</header>