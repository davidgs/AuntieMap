<?php
/**
 * The template for displaying all pages
 *
 * @package AuntieMap
 * @since 1.0.0
 */

get_header(); ?>

<div class="container">
    <div class="page-layout">
        <main class="page-content">
            <?php while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('page-article'); ?>>

                    <header class="page-header">
                        <h1 class="page-title"><?php the_title(); ?></h1>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="page-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <div class="page-content-area">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'auntie-map'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <?php if (comments_open() || get_comments_number()) : ?>
                        <div class="page-comments">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>

                </article>

            <?php endwhile; ?>
        </main>

        <?php if (is_active_sidebar('sidebar-1')) : ?>
            <aside class="page-sidebar" role="complementary">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </aside>
        <?php endif; ?>
    </div>
</div>

<style>
/* Page template styles */
.page-layout {
    display: flex;
    gap: 2rem;
    margin: 2rem 0;
}

.page-content {
    flex: 1;
}

.page-article {
    background: var(--white);
    padding: 2rem;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.page-header {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--light-purple);
}

.page-title {
    color: var(--dark-purple);
    margin-bottom: 1rem;
}

.page-thumbnail {
    margin-top: 1rem;
}

.page-thumbnail img {
    width: 100%;
    height: auto;
    border-radius: 0.5rem;
}

.page-content-area {
    line-height: 1.8;
}

.page-content-area h2,
.page-content-area h3,
.page-content-area h4,
.page-content-area h5,
.page-content-area h6 {
    color: var(--dark-purple);
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.page-content-area p {
    margin-bottom: 1.5rem;
}

.page-content-area ul,
.page-content-area ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.page-content-area li {
    margin-bottom: 0.5rem;
}

.page-content-area blockquote {
    background: var(--light-purple);
    border-left: 4px solid var(--primary-purple);
    padding: 1rem 1.5rem;
    margin: 2rem 0;
    border-radius: 0 0.5rem 0.5rem 0;
    font-style: italic;
}

.page-content-area table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
}

.page-content-area th,
.page-content-area td {
    padding: 0.75rem;
    border: 1px solid var(--border-gray);
    text-align: left;
}

.page-content-area th {
    background: var(--light-purple);
    color: var(--dark-purple);
    font-weight: 600;
}

.page-links {
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-gray);
}

.page-links a {
    display: inline-block;
    padding: 0.5rem 1rem;
    margin-right: 0.5rem;
    background: var(--primary-purple);
    color: var(--white);
    text-decoration: none;
    border-radius: 0.25rem;
    transition: background-color 0.3s ease;
}

.page-links a:hover {
    background: var(--dark-purple);
}

.page-sidebar {
    flex: 0 0 300px;
}

.page-comments {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid var(--light-purple);
}

/* Recovery-specific page styles */
.recovery-milestone-page .milestone-tracker {
    background: linear-gradient(135deg, var(--primary-purple), var(--secondary-purple));
    color: var(--white);
    padding: 2rem;
    border-radius: 1rem;
    text-align: center;
    margin: 2rem 0;
}

.recovery-milestone-page .milestone-number {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.recovery-resources-page .resource-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.recovery-resources-page .resource-card {
    background: var(--white);
    border: 2px solid var(--light-purple);
    padding: 1.5rem;
    border-radius: 0.75rem;
    text-align: center;
}

.recovery-resources-page .resource-card h3 {
    color: var(--primary-purple);
    margin-bottom: 1rem;
}

.recovery-resources-page .resource-link {
    display: inline-block;
    margin-top: 1rem;
    padding: 0.75rem 1.5rem;
    background: var(--primary-purple);
    color: var(--white);
    text-decoration: none;
    border-radius: 0.5rem;
    transition: background-color 0.3s ease;
}

.recovery-resources-page .resource-link:hover {
    background: var(--dark-purple);
}

/* About page styles */
.about-page .team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.about-page .team-member {
    text-align: center;
    background: var(--white);
    padding: 1.5rem;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.about-page .team-member img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 1rem;
}

/* Contact page styles */
.contact-page .contact-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.contact-page .contact-item {
    background: var(--light-purple);
    padding: 1.5rem;
    border-radius: 0.75rem;
    text-align: center;
}

.contact-page .contact-item h3 {
    color: var(--dark-purple);
    margin-bottom: 1rem;
}

.contact-page .emergency-notice {
    background: linear-gradient(135deg, var(--error-red), #DC2626);
    color: var(--white);
    padding: 2rem;
    border-radius: 1rem;
    text-align: center;
    margin: 2rem 0;
}

.contact-page .emergency-notice h3 {
    color: var(--white);
    margin-bottom: 1rem;
}

/* Responsive design */
@media (max-width: 768px) {
    .page-layout {
        flex-direction: column;
    }

    .page-sidebar {
        flex: none;
    }

    .page-article {
        padding: 1.5rem;
    }

    .recovery-milestone-page .milestone-number {
        font-size: 2rem;
    }
}
</style>

<?php get_footer(); ?>
