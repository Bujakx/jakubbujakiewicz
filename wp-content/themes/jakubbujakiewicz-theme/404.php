<?php get_header(); ?>

<main class="site-main">
    <div class="content-area error-404-content">
        <header class="page-header">
            <h1 class="page-title">Ups! Strona nie została znaleziona</h1>
        </header>

        <div class="page-content">
            <p>Wygląda na to, że strona, której szukasz, nie istnieje. Spróbuj wyszukać coś innego:</p>

            <?php get_search_form(); ?>

            <div class="error-404-links" style="margin-top: 2rem;">
                <h3>Przydatne linki:</h3>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Strona główna</a></li>
                    <li><a href="<?php echo esc_url(home_url('/uslugi/')); ?>">Usługi</a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></li>
                    <li><a href="<?php echo esc_url(home_url('/o-mnie/')); ?>">O mnie</a></li>
                    <li><a href="<?php echo esc_url(home_url('/kontakt/')); ?>">Kontakt</a></li>
                </ul>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>