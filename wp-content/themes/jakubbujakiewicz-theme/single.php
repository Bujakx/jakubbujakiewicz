<?php get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <?php
        while (have_posts()) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    
                    <div class="entry-meta">
                        <span class="posted-on">
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo esc_html(get_the_date()); ?>
                            </time>
                        </span>
                        <span class="byline">
                            przez <?php the_author(); ?>
                        </span>
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
                        'before' => '<div class="page-links">' . esc_html__('Strony:', 'jakubbujakiewicz'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    $categories_list = get_the_category_list(esc_html__(', ', 'jakubbujakiewicz'));
                    if ($categories_list) {
                        printf('<span class="cat-links">Kategorie: ' . '%1$s</span>', $categories_list);
                    }

                    $tags_list = get_the_tag_list('', esc_html__(', ', 'jakubbujakiewicz'));
                    if ($tags_list) {
                        printf('<span class="tags-links">Tagi: ' . '%1$s</span>', $tags_list);
                    }
                    ?>
                </footer>
            </article>

            <?php
            // Comments template
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

            // Navigation to next/previous post
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Poprzedni:', 'jakubbujakiewicz') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Następny:', 'jakubbujakiewicz') . '</span> <span class="nav-title">%title</span>',
            ));

        endwhile;
        ?>
    </div>
</main>

<?php get_footer(); ?>