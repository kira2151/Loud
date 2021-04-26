<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<div id="primary" <?php astra_primary_class(); ?>>

    <!------ HERE STARTER MIN KODE ---->
    <section id="primary" class="content-area">
        <main id=liste class="site-main">

            <article class="podcast">
                <h4 class="title"></h4>
                <img src="" alt="" class="billeder">
                <div>
                    <p class="lang_beskrivelse"></p>
                    <p class="genre"></p>
                </div>
            </article>
        </main>

        <script>
            let podcast;
            const dbUrl = "http://kiraberthelsen.com/Loud/wp-json/wp/v2/podcast/" + <?php echo get_the_ID() ?>;



            async function getJson() {
                const data = await fetch(dbUrl);
                podcast = await data.json();
                visPodcasts();
            }

            function visPodcasts() {
                document.querySelector(".title").textContent = podcast.title.rendered;
                document.querySelector(".billeder").src = podcast.billeder.guid;
                document.querySelector(".lang_beskrivelse").textContent = podcast.lang_beskrivelse;
                document.querySelector(".genre").textContent = podcast.genre;
            }

            getJson();

        </script>
    </section>


    <!------ HERE SLUTTER MIN KODE ---->

    <?php astra_primary_content_top(); ?>

    <?php astra_content_page_loop(); ?>

    <?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
