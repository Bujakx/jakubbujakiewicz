<?php get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <header class="page-header">
            <h1 class="page-title">
                <?php printf(esc_html__('Wyniki wyszukiwania dla: %s', 'jakubbujakiewicz'), '<span>' . get_search_query() . '</span>'); ?>
            </h1>
        </header>

        <?php if (have_posts()) : ?>
            <div class="posts-grid">
                <?php
                while (have_posts()) : the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="entry-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <header class="entry-header">
                            <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>
                            
                            <div class="entry-meta">
                                <span class="posted-on">
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </time>
                                </span>
                            </div>
                        </header>

                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>

                        <footer class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                Czytaj więcej
                            </a>
                        </footer>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => __('&laquo; Poprzednia', 'jakubbujakiewicz'),
                'next_text' => __('Następna &raquo;', 'jakubbujakiewicz'),
            ));
            ?>

        <?php else : ?>
            <div class="no-results">
                <p>Nie znaleziono żadnych wyników dla Twojego zapytania. Spróbuj ponownie z innymi słowami kluczowymi:</p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>