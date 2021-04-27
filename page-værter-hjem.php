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


    <?php astra_primary_content_top(); ?>

    <?php astra_content_page_loop(); ?>

    <!------ HERE STARTER MIN KODE ---->

    <template>
        <article>
            <div>
                <img src="" alt="" class="billeder">
                <h4 class="title"></h4>
            </div>
        </article>
    </template>

    <section id="primary" class="content-area">

        <main id="main" class="site-main">

            <section class="værtcontainer">
            </section>
        </main>

        <script>
            let værter;
            const dbUrl = "http://kiraberthelsen.com/Loud/wp-json/wp/v2/vrt?per_page=100";


            async function getJson() {
                const data = await fetch(dbUrl);
                værter = await data.json();
                console.log(værter)
                visVærter();
            }

            //funktion der viser podcasts i liste view
            function visVærter() {
                let temp = document.querySelector("template");
                let container = document.querySelector(".værtcontainer")
                værter.forEach(vrt => {
                    let klon = temp.cloneNode(true).content;
                    klon.querySelector(".title").textContent = vrt.title.rendered;
                    klon.querySelector(".billeder").src = vrt.billeder.guid;
                    klon.querySelector("article").addEventListener("click", () => {
                        location.href = vrt.link;
                    })
                    container.appendChild(klon);
                })
            }

            getJson();

        </script>
    </section>
    <!-----#primary ---->


    <!------ HERE SLUTTER MIN KODE ---->

    <?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->


<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
