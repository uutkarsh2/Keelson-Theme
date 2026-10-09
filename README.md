# Keelson-Theme
# Keelson Marine Engineering — WordPress Theme

A custom WordPress theme developed by converting the original Keelson HTML design into a dynamic, responsive, and maintainable WordPress website using PHP, Advanced Custom Fields (ACF), Gutenberg, and native WordPress functionality.

## 1. Project Overview

The purpose of this project is to convert the provided Keelson HTML template into a functional WordPress theme while preserving its original design, layout, responsive behavior, and interactions.

### Key Features

- Custom WordPress theme based on the original Keelson HTML design.
- Responsive layouts for desktop, tablet, and mobile devices.
- Dynamic homepage sections using Advanced Custom Fields.
- Native WordPress posts, categories, excerpts, and featured images.
- Blog listing and single blog post templates.
- Search functionality using WordPress search.
- Contact page prepared for Contact Form 7 integration.
- Reusable PHP template parts.
- Custom CSS and JavaScript assets.
- ACF JSON support for exporting and importing field configurations.
- SEO compatibility with Yoast SEO.

## 2. Technology Stack

- **CMS:** WordPress
- **Backend:** PHP
- **Frontend:** HTML5, CSS3, JavaScript
- **Custom Fields:** Advanced Custom Fields (ACF Pro)
- **Content Editor:** WordPress Gutenberg
- **Contact Forms:** Contact Form 7
- **SEO:** Yoast SEO
- **Version Control:** Git and GitHub

### Tested Versions

| Software | Version |
|---|---|
| WordPress | Verify installed version before submission |
| PHP | Verify active PHP version before submission |
| MySQL/MariaDB | Use the version supported by your WordPress environment |
| ACF Pro | Installed version |
| Contact Form 7 | Installed version |
| Yoast SEO | Installed version |

The exact versions should be confirmed from the local WordPress environment and Plugins page before final submission.

## 3. Required Plugins

Install and activate the following plugins:

1. **Advanced Custom Fields Pro (ACF Pro)** — manages structured fields for editable homepage content and other custom sections.
2. **Contact Form 7** — provides contact form functionality, validation, and submission handling.
3. **Yoast SEO** — supports SEO titles, meta descriptions, and other SEO configuration.

Gutenberg is included in WordPress and does not require a separate page-builder plugin.

**Note:** Do not use Elementor or another third-party page builder for this project.

## 4. Theme Installation

### Step 1: Install WordPress

Set up a local WordPress installation using a local development environment such as LocalWP, XAMPP, or another compatible environment.

### Step 2: Copy the Theme

Copy the `Keelson` theme folder into:

```text
wp-content/themes/Keelson/
```

Alternatively, compress the theme folder into a ZIP file and install it through:

**WordPress Dashboard → Appearance → Themes → Add New Theme → Upload Theme**

### Step 3: Activate the Theme

Navigate to:

**WordPress Dashboard → Appearance → Themes**

Locate the Keelson theme and click **Activate**.

### Step 4: Install Required Plugins

Go to **Plugins → Add New Plugin**, install the required plugins, and activate them. ACF Pro must be installed using a valid license or an authorized installation package.

## 5. ACF JSON Import and Configuration

The theme supports ACF JSON synchronization through its `acf-json` directory, provided the corresponding configuration files are included.

### Import or Synchronize Field Groups

1. Install and activate ACF Pro.
2. Copy the provided ACF JSON files into the theme's `acf-json` directory.
3. Open **Custom Fields → Tools** or the available ACF field group synchronization screen, depending on the installed version.
4. Import or synchronize the field groups when prompted.
5. Edit the relevant pages and verify that the configured custom fields appear.

### Managing Dynamic Content

Use the available ACF fields to manage structured content such as homepage hero content, service sections, and other configured page sections.

The exact fields depend on the field groups included with the theme. If the `acf-json` directory is empty or the JSON files are missing, the field groups must be exported from the existing ACF configuration or recreated before the theme can be fully configured.

## 6. Database and Initial Setup

WordPress stores pages, posts, categories, menus, and other content in its database.

For a fresh installation:

1. Create or configure a WordPress database.
2. Complete the WordPress installation.
3. Activate the Keelson theme.
4. Install and activate the required plugins.
5. Synchronize the ACF field groups.
6. Create the required pages, including Home, About, Blog, and Contact.
7. Add blog posts, categories, excerpts, and featured images.
8. Configure the navigation menus and homepage settings.

If a database export is provided with the project, import it into a compatible local database and update the local WordPress configuration as necessary.

**Important:** Never commit database passwords, `wp-config.php` credentials, API keys, or other secrets to the public repository.

## 7. Permalink Configuration

Configure WordPress permalinks to provide readable URLs.

1. Open **Settings → Permalinks**.
2. Select **Post name**.
3. Click **Save Changes**.

Example:

```text
https://example.com/blog/sample-article/
```

If a page or post returns a 404 error after changing permalink settings, save the permalink configuration again and verify that the relevant page, post, or archive exists.

## 8. Menu Configuration

Configure the navigation menus through:

**WordPress Dashboard → Appearance → Menus**

If the installed WordPress version uses the Site Editor for menu management, configure the navigation through the corresponding editor interface.

1. Create a primary navigation menu.
2. Add the required pages, such as Home, About, Blog, and Contact.
3. Assign the menu to the theme's registered primary menu location.
4. Save the menu and verify desktop and mobile navigation.

The theme should use WordPress menu APIs rather than hardcoded navigation URLs.

## 9. Homepage Configuration

1. Create a WordPress page named **Home**.
2. Open **Settings → Reading**.
3. Select **A static page** under the homepage display settings.
4. Set the homepage to **Home**.
5. Save the changes.

The custom `front-page.php` template is used by WordPress for the front page when available.

### Updating Homepage Content

Edit the relevant homepage page and update its configured ACF fields. Use the WordPress editor where Gutenberg content is supported.

The homepage should allow administrators to update configured content without editing PHP template files.

## 10. ACF vs. Gutenberg: Implementation Decisions

ACF and Gutenberg serve different purposes in this project.

### Advanced Custom Fields

ACF is used for structured, predictable content that follows a defined design layout.

Examples include:

- Hero heading and description.
- Hero buttons and links.
- Service section content.
- Repeated, predefined homepage content groups where configured.
- Other structured content fields included in the theme.

This approach keeps the design consistent and allows administrators to update content through dedicated fields.

### Gutenberg

Gutenberg is WordPress's native block editor. It is appropriate for editorial content that benefits from flexible block-based editing.

Examples include:

- Blog post content.
- Standard page content.
- Headings, paragraphs, lists, and images.
- Additional editorial content where supported by the templates.

### Why Both Are Used

ACF provides structured fields for predefined sections, while Gutenberg provides flexibility for long-form and editorial content.

This hybrid approach supports maintainability, content management, and reuse without introducing an external page builder.

## 11. Blog and Search Functionality

The theme uses native WordPress content management for blog posts and categories.

Blog content can include:

- Post title.
- Excerpt.
- Featured image.
- Author and publication date.
- Categories.
- Full post content.

The theme includes templates intended for blog listing, individual posts, search results, and archive pages.

The built-in WordPress search should be used to display relevant posts and pages, including an appropriate empty state when no results are found.

Category filtering, pagination or Load More, related posts, and previous/next navigation should be verified in the running website before submission.

## 12. Contact Page

The Contact page is intended to use Contact Form 7 for actual form processing.

To configure it:

1. Install and activate Contact Form 7.
2. Create a contact form from the WordPress dashboard.
3. Configure the recipient email address and mail settings.
4. Embed the generated form shortcode in the Contact page.
5. Verify required-field validation, successful submissions, and error messages.
6. Test email delivery in the local or staging environment.

A visual form or JavaScript interaction alone does not confirm that form submissions are being processed or that emails are delivered.

## 13. Theme Structure

The theme may include the following files and directories, depending on the final submitted version:

```text
Keelson/
├── style.css
├── functions.php
├── header.php
├── footer.php
├── index.php
├── front-page.php
├── page.php
├── page-about.php
├── page-contact.php
├── single.php
├── archive.php
├── search.php
├── 404.php
├── acf-json/
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
└── template-parts/
```

The theme uses PHP templates for rendering pages, WordPress APIs for content retrieval, and separate CSS and JavaScript files for presentation and interactions.

Only files that are actually present in the final repository should be considered part of the submitted theme.

## 14. Recommended Production Improvements

Before production deployment, consider:

- Verify responsive behavior across desktop, tablet, and mobile layouts.
- Test compatibility with current supported WordPress and PHP versions.
- Confirm Contact Form 7 email delivery and spam protection.
- Validate category filtering and pagination to prevent duplicate posts.
- Optimize image sizes and lazy loading where appropriate.
- Review keyboard accessibility, focus states, and form labels.
- Check SEO metadata and semantic HTML.
- Test search, 404 pages, and missing featured images.
- Review PHP escaping, sanitization, and validation.
- Remove unused assets and debug code.

## 15. Version Control

The project is maintained using Git and GitHub.

Repository: https://github.com/uutkarsh2/Keelson-Theme

Example commands for updating the repository:

```bash
git add .
git commit -m "Update Keelson WordPress theme"
git push
```

Do not include secrets, private credentials, unnecessary local WordPress files, or database passwords in the repository.

## 16. Final Notes

This project demonstrates the conversion of a static HTML design into a custom WordPress theme using PHP templates, native WordPress content, ACF fields, Gutenberg, and plugin-based functionality.

Before final submission, verify the installed software versions, required plugins, ACF field configuration, responsive layouts, blog functionality, contact form submission, navigation, and search behavior in the running WordPress website.
