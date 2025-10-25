<?php
/**
 * Template Name: Pełna szerokość
 * Template Post Type: page
 * 
 * Szablon strony bez paska bocznego
 */

get_header(); ?>

<main class="site-main full-width-page">
    <div class="content-area-full">
        <?php
        while (have_posts()) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-thumbnail-full">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content-full">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>