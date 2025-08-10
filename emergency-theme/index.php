<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="container">
        <h1>Site Temporarily Under Maintenance</h1>
        <p>We're working to restore your site. Please check back shortly.</p>

        <?php if (have_posts()) : ?>
            <h2>Recent Posts</h2>
            <?php while (have_posts()) : the_post(); ?>
                <article>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php the_excerpt(); ?>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>

        <p><a href="<?php echo admin_url(); ?>" class="button">Admin Login</a></p>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
