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
    <section id="primary" class="content-area-single-podcast">
        <main id=liste class="site-main">

            <article class="podcast">
                <img src="" alt="" class="coverbillede">
                <div class="tilbage_til_oversigtDiv">
                    <button class="tilbage_til_oversigt">Tilbage</button>
                </div>
                <h5 class="podcast_navn"></h5>
                <p class="lang_beskrivelse"></p>
                <p class="vaerter">Vært/værter: </p>
                <p class="producenter">Producent/producenter:</p>
                <div class="filtreringsDiv">
                    <button class="filtreringsKnap">Filtrér</button>
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
                document.querySelector(".podcast_navn").textContent = podcast.title.rendered;
                document.querySelector(".coverbillede").src = podcast.billeder.guid;
                document.querySelector(".lang_beskrivelse").textContent = podcast.lang_beskrivelse;
                document.querySelector(".vaerter").textContent += ` ${podcast.vaerter}`;
                document.querySelector(".producenter").textContent += ` ${podcast.producenter}`;
                document.querySelector(".tilbage_til_oversigt").addEventListener("click", tilbageTilPodcastOversigt);
            }

            function tilbageTilPodcastOversigt() {
                history.back();
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
