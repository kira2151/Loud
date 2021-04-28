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
    <section id="primary" class="content-area-single-vrt">
        <main id=liste class="site-main">

            <article class="vrt">
                <img src="" alt="" class="coverbillede">
                <div class="tilbage_til_oversigtDiv">
                    <button class="tilbage_til_oversigt">Tilbage</button>
                </div>
                <h5 class="title"></h5>
                <p class="beskrivelse"></p>
                <div class="filtreringsDiv">
                    <button class="filtreringsKnap">Filtrér</button>
                </div>
            </article>
        </main>

        <script>
            let vrt;
            const dbUrl = "http://kiraberthelsen.com/Loud/wp-json/wp/v2/vrt/" + <?php echo get_the_ID() ?>;



            async function getJson() {
                const data = await fetch(dbUrl);
                vrt = await data.json();
                visVaerter();
            }

            function visVaerter() {
                document.querySelector(".title").textContent = vrt.title.rendered;
                document.querySelector(".coverbillede").src = vrt.billeder.guid;
                document.querySelector(".beskrivelse").textContent = vrt.beskrivelse;
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
