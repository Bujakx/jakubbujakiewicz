<?php get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        <div class="entry-meta">
                            <span class="posted-on"><?php echo get_the_date(); ?></span>
                            <span class="byline"> <?php _e('by', 'jakubbujakiewicz'); ?> <?php the_author(); ?></span>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="entry-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Pages:', 'jakubbujakiewicz'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <p><?php _e('Sorry, no posts matched your criteria.', 'jakubbujakiewicz'); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>